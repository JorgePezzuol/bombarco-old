<?php
Yii::import('application.vendor.api-cielo.*');
require_once 'autoload.php';
use Cielo\API30\Merchant;
use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\Request\CieloRequestException;

class BombarcoshopController extends GxController {

	public function filters() {
		return array(
			'accessControl', 
		);
	}

	public function accessRules() {
		return array(
			array('allow', 
					'actions'=>array('admin','delete','create','update','uploadFoto'),
									                'expression'=> function() {
                    if(Yii::app()->user->isAtendimento() || Yii::app()->user->isAdmin()) {
                        return true;
                    }
                    return false;
                }
			),
			array('allow',
                'actions' => array('view', 'validarCupom', 'pagamentoCartao', 'pagamentoCartaoPasseio', 'downloadEbook', 'cadastrarEmail', 'testee'),
                'users' => array('*'),
            ),
			array('deny', 
				'users'=>array('*'),
			)
		);
	}

	public function actionAdmin() {


		$model = new BombarcoshopTransacoes('search');

        $model->unsetAttributes();

        if (isset($_GET['BombarcoshopTransacoes']))
            $model->setAttributes($_GET['BombarcoshopTransacoes']);

        $this->render('admin', array(
            'model' => $model,
        ));
	}

	public function actionCreate() {

		$model = new BombarcoshopForm();

		if(isset($_POST["BombarcoshopForm"])) {
			$model->setAttributes($_POST["BombarcoshopForm"]);
			$model->id = $_POST["id_produto"];
			if($model->save() != false) {
				Yii::app()->user->setFlash('success','Sucesso ao salvar o produto. Código: <strong>'.$model->codigo.'</strong>');
			}
			else {
				Yii::app()->user->setFlash('danger','Erro ao salvar o produto. Certifique-se se já não existe um produto com esse nome.');
			}
		}

		$this->render('create', array('model'=>$model));
	}

	public function actionView() {

		$this->layout = "//admin";

		$slug = $_GET["slug"];

		$produto = Bombarcoshop::model()->find("slug=:slug", array(":slug"=>$slug));

		if($produto != null) {

			if($slug == "nomarcombombarco") {

				$qtdeVendas = BombarcoshopTransacoes::model()->findAll("id_produto=:id_produto", array(":id_produto"=>4));

				if(count($qtdeVendas) >= 4) {

					$this->redirect("http://nomarcom.bombarco.com.br/contato");
					exit;
				}
			}

			$this->render($slug, array("produto"=>$produto));

		}	
	}

	public function actionCadastrarEmail() {


		if(isset($_POST)) {

			$nome = $_POST["nome"];
			$email = $_POST["email"];
			$link = $_POST["link"];

			$sql = "INSERT INTO bombarcoshop_emails (nome, email, link) VALUES ('".$nome."', '".$email."', '".$link."')";
			Yii::app()->db->createCommand($sql)->query();
			echo 1;
			exit;
		}

		echo 0;
	}

	public function actionPagamentoCartao() {

		$retorno = array();
		$retorno["ok"] = 0;
		$retorno["tid_interno"] = 0;

		// ver se n alterou o valor 
		/*if(!Bombarcoshop::validarValor(Yii::app()->getRequest()->getPost('id_produto'), Yii::app()->getRequest()->getPost('valor'))) {
			echo json_encode($retorno, true); 
			exit;
		}*/

		// Configure o ambiente
        $environment = $environment = Environment::production();
        //$environment = $environment = Environment::sandbox();

        // Configure seu merchant
        //$merchant = new Merchant('58804762-4929-42b6-846a-4063981e03ce', 'GDWXDOLQDUNSGHVLBRJTAILQRLZVKJAXWCDBICGU');
        $merchant = new Merchant('fbf440a7-a143-4eb9-91d7-8c56d6ba5e64', 'UQpF3lAPVdsaiUkRAZGnD22kQgmPfrIYHsRtRMr9');

        // Crie uma instância de Sale informando o ID do pagamento
        $id_pagamento = BombarcoshopTransacoes::gerarTidInterno(8);
        $sale = new Sale($id_pagamento);
        $valor = number_format(Yii::app()->getRequest()->getPost('valor'), 2,'','');

        // Crie uma instância de Payment informando o valor do pagamento
        $payment = $sale->payment($valor);


        // Crie uma instância de Credit Card utilizando os dados de teste
        // esses dados estão disponíveis no manual de integração
        $cvv = Yii::app()->getRequest()->getPost('card_cvv');
        $bandeira = Yii::app()->getRequest()->getPost('card_flag');
        $data_validade = Yii::app()->getRequest()->getPost('card_validate_month') . "/". Yii::app()->getRequest()->getPost('card_validate_year');
        $numero_cartao = Yii::app()->getRequest()->getPost('card_number');
        $nome_cartao = Yii::app()->getRequest()->getPost('card_name');

        $payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
                ->creditCard($cvv, $bandeira)
                ->setExpirationDate($data_validade)
                ->setCardNumber($numero_cartao)
                ->setHolder($nome_cartao);

        try {

        	// Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
            $sale = (new CieloEcommerce($merchant, $environment))->createSale($sale);

            // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
            // dados retornados pela Cielo
            $paymentId = $sale->getPayment()->getPaymentId();
            $paymentTid = $sale->getPayment()->getTid();

            // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
            $sale = (new CieloEcommerce($merchant, $environment))->captureSale($paymentId, $valor, 0);

            $bbshoptransacao = new BombarcoshopTransacoes();
            $bbshoptransacao->nome = Yii::app()->getRequest()->getPost('nome');
            $bbshoptransacao->email = Yii::app()->getRequest()->getPost('email');
            $bbshoptransacao->id_produto = Yii::app()->getRequest()->getPost('id_produto');
            $bbshoptransacao->tid_externo = $paymentTid;
            $bbshoptransacao->tid_interno = $id_pagamento;

            if($bbshoptransacao->save()) {

            	$nome = Yii::app()->getRequest()->getQuery('nome');
				$email = Yii::app()->getRequest()->getQuery('e');
				$tid = Yii::app()->getRequest()->getQuery('d');

				// manda p email
		        $parser = new CHtmlPurifier();
		        $message = new YiiMailMessage;
		        $message->view = "mail_ebook";
		        $message->subject = 'E-book - Bombarco';
		        $message->setBody(array('nome' => $parser->purify(Yii::app()->getRequest()->getPost('nome'))), 'text/html');
		        $message->addTo($parser->purify(Yii::app()->getRequest()->getPost('email')));
		        $message->from = Yii::app()->params['bombarcoAtendimento'];

		        if (Yii::app()->mail->send($message)) {

		            $retorno["tid_interno"] = $bbshoptransacao->tid_interno;
            		$retorno["ok"] = 1;
		        }
            }

        } catch(CieloRequestException $e) {

        	$return['error'] = $e->getCieloError()->getCode();
            $return['msg'] = $e->getCieloError()->getMessage();
        	echo json_encode($retorno, true);
        	exit;
        }

        echo json_encode($retorno, true);
        exit;
	}

	public function actionPagamentoCartaoPasseio() {

		$retorno = array();
		$retorno["ok"] = 0;
		$retorno["tid_interno"] = 0;

		$passeio = Bombarcoshop::model()->findByPk(Yii::app()->getRequest()->getPost('id_produto'));
		$valor = $passeio->valor;
		$valor_parcelado = $passeio->valor_parcelado;
		$isParcelado = Yii::app()->getRequest()->getPost('parcelado'); 	// 1 => parcelou
																					// 0 => não parcelou
		if($isParcelado == 1) {
			$valor = number_format($valor_parcelado, 2,'','');
		}
		else {
			$valor = number_format($valor, 2,'','');
		}

		// Configure o ambiente
        $environment = $environment = Environment::production();
        //$environment = $environment = Environment::sandbox();

        // Configure seu merchant
        //$merchant = new Merchant('58804762-4929-42b6-846a-4063981e03ce', 'GDWXDOLQDUNSGHVLBRJTAILQRLZVKJAXWCDBICGU');
        $merchant = new Merchant('fbf440a7-a143-4eb9-91d7-8c56d6ba5e64', 'UQpF3lAPVdsaiUkRAZGnD22kQgmPfrIYHsRtRMr9');

        // Crie uma instância de Sale informando o ID do pagamento
        $id_pagamento = BombarcoshopTransacoes::gerarTidInterno(8);
        $sale = new Sale($id_pagamento);

        // Crie uma instância de Payment informando o valor do pagamento
        $payment = $sale->payment($valor);

        if($isParcelado == 1) {
			$payment->setInstallments(2);
		}        

        // Crie uma instância de Credit Card utilizando os dados de teste
        // esses dados estão disponíveis no manual de integração
        $cvv = Yii::app()->getRequest()->getPost('card_cvv');
        $bandeira = Yii::app()->getRequest()->getPost('card_flag');
        $data_validade = Yii::app()->getRequest()->getPost('card_validate_month') . "/". Yii::app()->getRequest()->getPost('card_validate_year');
        $numero_cartao = Yii::app()->getRequest()->getPost('card_number');
        $nome_cartao = Yii::app()->getRequest()->getPost('card_name');

        $payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
                ->creditCard($cvv, $bandeira)
                ->setExpirationDate($data_validade)
                ->setCardNumber($numero_cartao)
                ->setHolder($nome_cartao);

        try {

        	// Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
            $sale = (new CieloEcommerce($merchant, $environment))->createSale($sale);

            // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
            // dados retornados pela Cielo
            $paymentId = $sale->getPayment()->getPaymentId();
            $paymentTid = $sale->getPayment()->getTid();

            // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
            $sale = (new CieloEcommerce($merchant, $environment))->captureSale($paymentId, $valor, 0);

            $bbshoptransacao = new BombarcoshopTransacoes();
            $bbshoptransacao->nome = Yii::app()->getRequest()->getPost('card_name');
            $bbshoptransacao->email = Yii::app()->getRequest()->getPost('email');
            $bbshoptransacao->id_produto = Yii::app()->getRequest()->getPost('id_produto');
            $bbshoptransacao->tid_externo = $paymentTid;
            $bbshoptransacao->tid_interno = $id_pagamento;

            if($bbshoptransacao->save()) {

				// manda p email

		        $parser = new CHtmlPurifier();
		        $message = new YiiMailMessage;
		        $message->view = "mail_nomarcombombarco";
		        $message->subject = '[No Mar com Bombarco] Parabéns, você é um tripulante VIP!';
		        $message->setBody(array('nome' => $parser->purify(Yii::app()->getRequest()->getPost('card_name'))), 'text/html');
		        $message->addTo($parser->purify(Yii::app()->getRequest()->getPost('email')));
		        $message->from = Yii::app()->params['bombarcoAtendimento'];

		        if (Yii::app()->mail->send($message)) {

		            $retorno["tid_interno"] = $bbshoptransacao->tid_interno;
            		$retorno["ok"] = 1;
		        }


            }

        } catch(CieloRequestException $e) {

        	//$return['error'] = $e->getCieloError()->getCode();
            //$return['msg'] = $e->getCieloError()->getMessage();
        	echo json_encode($retorno, true);
        	exit;
        }

        echo json_encode($retorno, true);
        exit;
	}

	public function actionTestee() {


		        $message = new YiiMailMessage;
		        $message->view = "mail_nomarcombombarco";
		        $message->subject = '[No Mar com Bombarco] Parabéns, você é um tripulante VIP!';
		        $message->setBody(array('nome' => "testeee"), 'text/html');
		        $message->addTo("jorge_pezzuol@hotmail.com");
		        $message->from = Yii::app()->params['bombarcoAtendimento'];

		        if (Yii::app()->mail->send($message)) {

		        }
	}


	public function actionValidarCupom() {

		$id_produto = Yii::app()->getRequest()->getPost("id_produto");
		$cupom = Yii::app()->getRequest()->getPost("cupom");
		$retorno = array();

		$retorno["cupom_aprovado"] = 0;
		$retorno["desconto"] = Yii::app()->getRequest()->getPost("valor");		

		$bbshopdesconto = BombarcoshopDescontos::model()->find("codigo=:codigo AND id_produto=:id_produto", array(":codigo"=>$cupom, ":id_produto"=>$id_produto));

		if($bbshopdesconto != null) {

			$hoje = date("Y-m-d H:i:s");

			if( ($hoje >= $bbshopdesconto->data_inicio) && ($hoje <= $bbshopdesconto->data_fim) ) {
				$retorno["desconto"] = ($bbshopdesconto->porcentagem_desconto / 100) * Yii::app()->getRequest()->getPost("valor");
				$retorno["cupom_aprovado"] = 1;
			}
		}

		echo json_encode($retorno, true);
		
	}

	public function actionUploadFoto() {

		$nome_arquivo = BombarcoshopFotos::salvarImagem($_FILES["qqfile"]);

		if($nome_arquivo != null) {
			$bbshopfoto = new BombarcoshopFotos();
			$bbshopfoto->imagem = $nome_arquivo;
			$bbshopfoto->id_produto = $_POST["id_produto"];
			if(!BombarcoshopFotos::model()->exists('id_produto=:id_produto and principal = 1', array(':id_produto'=>$bbshopfoto->id_produto))) {
	            $bbshopfoto->principal = 1;
	        }
	        $sql = "SET foreign_key_checks = 0;";
            Yii::app()->db->createCommand($sql)->execute();       
            $bbshopfoto->save();
            $sql = "SET foreign_key_checks = 1;";
            Yii::app()->db->createCommand($sql)->execute(); 
	        
		}

		return json_encode(array("success"=>true));
	}

	
}