<?php

class GuiaCapitaoController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('index','view', 'create', 'boleto'),
				'users'=>array('*'),
				),
			array('allow', 
				'actions'=>array('minicreate','update'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('admin','delete'),
				'users'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	
	public function actionBoleto() {


 //$validacao = Transacoes::validarTransacao(Yii::app()->getRequest()->getPost('tid'));
        $validacao = Transacoes::validarTransacao("23462211");
        $return = array('error' => 0, 'msg' => null);

        // Se houver erro na trasacão
        // Retorna o erro
        if ($validacao['error'] != 0) {
            $return['error'] = $validacao['error'];
            $return['msg'] = $validacao['msg'];
            //$return['tid'] = Yii::app()->getRequest()->getPost('tid');
            $return['tid'] = "23462211";
            

            echo json_encode($return);
            exit();
        }

        // Seta a variavel como objeto transacao
        $transacao = $validacao['transacao'];

        Yii::import('application.extensions.yii-azpay.*');
        $az_pay = new YiiAzPay(Anuncio::$_az_pay['ID'], Anuncio::$_az_pay['KEY']);

        // Se a transacao já estiver finalizada
        // Executa a consulta dela no AZPay
        // E só atualiza os dados
        if ($transacao->status == Anuncio::$_status_transacao['PAGA'] && !empty($transacao->tid_externo)) {
            $az_pay->report($transacao->tid_externo);
        } else {

            $az_pay->config_order['reference'] = $transacao->tid;
            $az_pay->config_order['totalAmount'] = $transacao->valor;

            $az_pay->config_boleto['acquirer'] = '20';
            $az_pay->config_boleto['amount'] = $transacao->valor;
            $az_pay->config_boleto['expire'] = date('Y-m-d', strtotime('today + 5 day'));
            $az_pay->config_boleto['nrDocument'] = str_pad($transacao->id, 8, STR_PAD_LEFT);

            $az_pay->config_billing['customerIdentity'] = Usuarios::getUsuarioLogado()->cpf;
            $az_pay->config_billing['name'] = Usuarios::getUsuarioLogado()->nome;
            $az_pay->config_billing['address'] = 'Rua Desembargador Francisco Ferreira, 181';
            $az_pay->config_billing['address2'] = 'Rua Otto Unger, 182';
            $az_pay->config_billing['city'] = 'Mogi das Cruzes';
            $az_pay->config_billing['state'] = 'SP';
            $az_pay->config_billing['postalCode'] = '08790-320';
            $az_pay->config_billing['country'] = 'BR';
            $az_pay->config_billing['phone'] = Usuarios::getUsuarioLogado()->celular != null ? Usuarios::getUsuarioLogado()->celular : "";
            $az_pay->config_billing['email'] = Usuarios::getUsuarioLogado()->email != null ? Usuarios::getUsuarioLogado()->email : "";
            
            $az_pay->boleto();
        }

        // Se houver erro ao executar o CURL
        // ou não retornar 200
        if ($az_pay->error == true)
            throw new Exception("Erro ao executar transacão", 5);

try {

    $res = $az_pay->response();

        var_dump($res);
        
} catch (Exception $e) {

    var_dump($e->getMessage());
}

exit;
        

        try {

            if ($res->status != Transacoes::$_msg_response['GENERATED'])
                throw new Exception("Boleto não gerado: {$res->result->error->code} - " . str_replace(array('<![CDATA[', ']]>'), '', $res->result->error->details));

            $transaction = Yii::app()->db->beginTransaction();

            $xml = $res->transactionId;
            $out = array();
             foreach ( (array) $xml as $index => $node )
                $out[$index] = ( is_object ( $node ) ) ? xml2array ( $node ) : $node;

            $transactionId = $out[0];

            // LOG
            $log = new Logs;
            $log->chave = 'AZ Pay Log';
            $log->id_item = $transacao->id;
            $log->valor = json_encode($res);
            $log->data = new CDbExpression('NOW()');
            if (!$log->save())
                throw new Exception('Erro ao gerar Log', 1);



            // atualizar transação com data de confirmação, tid externo, etc
            //$transacao = Transacoes::model()->find('tid=:tid', array(':tid' => Yii::app()->getRequest()->getPost('tid')));
            $transacao->tid_externo = $transactionId;
            $transacao->status = Anuncio::$_status_transacao['PAGA'];
            $transacao->data_confirmacao = date('Y-m-d H:i:s');
            $transacao->formapagamento = 'boleto';
            $transacao->detalhes = json_encode($res);
            if (!$transacao->saveAttributes(array('tid_externo', 'status', 'data_confirmacao', 'formapagamento', 'detalhes')))
                throw new Exception('Erro ao atualizar Transação', 1);

            // carregar usuario logado
            $usuario_logado = Usuarios::model()->findByPk(Yii::app()->user->getId());

            // após atualizar a transação, vamos ativar as ordens de pedido que compõem a mesma
            foreach ($transacao->ordens as $ordem) {

                // id da ordem corrente para utilizar nos updates
                $id = (int) $ordem->id_item;

                // atualizar ordem para status de paga
                $ordem->status = Anuncio::$_status_ordem['PAGA'];
                $ordem->saveAttributes(array('status'));

                // verificar o tipo da ordem
                if ($ordem->ordemTipos->alias == 'plano_anuncio') {

                    // carregar o planoUsuarios pelo ID que está no id_item da ordem
                    $plano_usuario = PlanoUsuarios::model()->findByPk($id);

                    // tipo de ordem é de plano de anuncio (mudar status pra 1 de todas as embarcações do plano)
                    $duracao = $plano_usuario->planos->duracaomeses;
                    $plano_usuario->inicio = date('Y-m-d H:i:s');
                    $plano_usuario->fim = date('Y-m-d H:i:s', strtotime('today + ' . $duracao . ' month'));
                    $plano_usuario->status = Anuncio::$_status_plano['PAGO'];
                    if(!$plano_usuario->update())
                        throw new Exception('Erro ao atualizar Plano', 1);

                    // loop para embarcação
                    foreach ($plano_usuario->embarcacoes as $embarc) {
                        $embarc->status = Anuncio::$_status['ATIVA'];
                        if(!$embarc->update())
                            throw new Exception('Erro ao ativar anúncios', 1);

                        // ativar imagens não turbo da embarcação
                        foreach ($embarc->embarcacaoImagens as $embarcImagem) {
                            if ($embarcImagem->turbo == Anuncio::$_img_turbo['NAO_TURBO']) {
                                $embarcImagem->status = Anuncio::$_status['ATIVA'];
                                if(!$embarcImagem->update())
                                    throw new Exception('Erro ao ativar imagens do anúncio', 1);
                            }
                        }

                    }

                // ordem tipo renovação de plano
                } elseif ($ordem->ordemTipos->alias == 'renovar_plano') {

                    // dar o status de ativo para o registro que guarda a relação do plano atual
                    // e o plano que será renovado
                    $plano_usuario_renovado = PlanosUsuariosRenovados::model()->findByPk($id);
                    if (!empty($plano_usuario_renovado)) {

                        $plano_usuario_renovado->status = 2;
                        if(!$plano_usuario_renovado->saveAttributes(array('status')))
                            throw new Exception('Erro ao renovar Plano', 1);

                    } else { // Caso não exista um De-Para dos planos, busca o plano na tabela padrão

                        $plano_usuario = PlanoUsuarios::model()->findByPk($id);
                        if (empty($plano_usuario))
                            throw new Exception('Plano não existe', 1);

                        $plano_usuario->status = 2;
                        if(!$plano_usuario->saveAttributes(array('status')))
                            throw new Exception('Erro ao renovar Plano', 1);
                    }


                // ordem tipo plano de empresa
                } elseif ($ordem->ordemTipos->alias == 'plano_empresa') {


                    // carregar o planoUsuarios pelo ID que está no id_item da ordem
                    $plano_usuario = PlanoUsuarios::model()->findByPk($id);

                    // ativar plano
                    $duracao = $plano_usuario->planos->duracaomeses;
                    $plano_usuario->inicio = date('Y-m-d H:i:s');
                    $plano_usuario->fim = date('Y-m-d H:i:s', strtotime('today + ' . $duracao . ' month'));
                    $plano_usuario->status = Anuncio::$_status_plano['PAGO'];
                    if(!$plano_usuario->update())
                        throw new Exception('Erro ao ativar Plano Empresa', 1);

                    // ativar empresa
                    $usuario_logado->empresases->status = Anuncio::$_status['ATIVA'];
                    if(!$usuario_logado->empresases->update())
                        throw new Exception('Erro ao ativar Empresa', 1);


                // ordem tipo rec adicional embarcacao
                } elseif ($ordem->ordemTipos->alias == 'adicional_embarcacao') {


                    $embarcRecAdicionais = EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()->find('id=:id', array(':id' => $id));
                    $embarcRecAdicionais->status = Anuncio::$_status['ATIVA'];
                    if(!$embarcRecAdicionais->update())
                        throw new Exception('Erro ao ativar Turbinada', 1);

                    if ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'fotos') {

                        foreach ($embarcRecAdicionais->embarcacoes->embarcacaoImagens as $embarcImg) {
                            if ($embarcImg->turbo == Anuncio::$_img_turbo['TURBO']) {
                                $embarcImg->status = Anuncio::$_status['ATIVA'];
                                if(!$embarcImg->update())
                                    throw new Exception('Erro ao ativar Imagens turbinadas', 1);
                            }
                        }

                    } elseif ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'destaque_busca') {

                        //$embarcRecAdicionais = EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()->find('id=:id', array(':id' => $id));
                        $embarcRecAdicionais->embarcacoes->destaque = Anuncio::$_status_destaque_embarcacao['PAGO'];
                        if(!$embarcRecAdicionais->embarcacoes->update())
                            throw new Exception('Erro ao ativar Destaque na Busca', 1);

                    } elseif ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'cpm') {

                        // atualizar cpm na tabela de embarcacao impressoes
                        /*$idEmbarcImpressoes = $embarcRecAdicionais->embarcacoes->embarcacaoImpressoes[0]->id;
                        if(!EmbarcacaoImpressoes::model()->updateByPk($idEmbarcImpressoes, array('status' => Anuncio::$_status['ATIVA'])) )
                            throw new Exception('Erro ao ativar Impressões', 1);*/

                         // atualizar cpm na tabela de embarcacao impressoes
                        $idEmbarcImpressoes = $embarcRecAdicionais->embarcacoes->embarcacaoImpressoes[0]->id;
                        $embarcImpressao = EmbarcacaoImpressoes::model()->findByPk($idEmbarcImpressoes);
                        $embarcImpressao->status = Anuncio::$_status['ATIVA'];

                        if(!$embarcImpressao->update())
                            throw new Exception('Erro ao ativar Impressões', 1);
                    }


                // ordem tipo rec adicional empresa
                } elseif ($ordem->ordemTipos->alias == 'adicional_empresa') {

                    $empresaRecAdicionais = EmpresasHasEmpresaRecursosAdicionais::model()->find('id=:id', array(':id' => $id));
                    $empresaRecAdicionais->status = Anuncio::$_status['ATIVA'];
                    if(!$empresaRecAdicionais->update())
                        throw new Exception('Erro ao ativar Turbinadas de Empresa', 1);

                    // verificar se é um rec adicional de imagem (caso for, temos q ativar as imagens)
                    if ($empresaRecAdicionais->empresaRecursosAdicionais->flag == 'fotos') {

                        // obter empresa
                        $empresa = Usuarios::getEmpresa();

                        // loop para ativar as fotos da empresa
                        foreach ($empresa->empresaImagens as $imagem) {
                            $imagem->status = Anuncio::$_status['ATIVA'];
                            if(!$imagem->update())
                                throw new Exception('Erro ao ativar imagens da Empresa', 1);
                        }

                    } else if ($empresaRecAdicionais->empresaRecursosAdicionais->flag == 'cpm') {

                        // atualizar cpm na tabela de empresas impressoes
                        $idEmpresaImpressoes = $empresaRecAdicionais->empresas->empresasImpressoes[0]->id;
                        if( !EmpresasImpressoes::model()->updateByPk($idEmpresaImpressoes, array('status' => Anuncio::$_status['ATIVA'])) )
                            throw new Exception('Erro ao ativar impressões de Empresa', 1);

                    }

                }

            }

            // enviar email avisando o cliente q o pagamento foi realizado com sucesso
            $message = new YiiMailMessage;
            $message->view = "mail_boleto";
            $message->subject = 'BomBarco - Plano Contratado!';
            $message->setBody(
                array(
                    'email' => Usuarios::getUsuarioLogado()->email,
                    'urlBoleto' => strval($res->processor->Boleto->details->urlBoleto),
                ), 'text/html');
            $message->addTo(Usuarios::getUsuarioLogado()->email);
            $message->from = Yii::app()->params['bombarcoAtendimento'];

            // enviar email para o email cadastrado na embarcação, para informar que o anuncio foi validado ok
            if (!Yii::app()->mail->send($message))
                throw new Exception("Erro ao enviar o email", 5);

            // commitar os demais saves/updates
            $transaction->commit();

            $return['urlBoleto'] = strval($res->processor->Boleto->details->urlBoleto);

        } catch (Exception $e) {
            $return['error'] = ($e->getCode() == 0) ? 1 : $e->getCode();
            $return['msg'] = $e->getMessage();

            // salvar log de erro
            $logErro = new Logs;
            $logErro->id_item = $transacao->id;
            $logErro->chave = 'Erro AZPay';
            $logErro->valor = $e->getMessage();
            $logErro->save();
        }

        echo json_encode($return);
        exit();
	}


	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'GuiaCapitao');


		if (isset($_POST['GuiaCapitao'])) {
			$model->setAttributes($_POST['GuiaCapitao']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'GuiaCapitao')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('GuiaCapitao');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new GuiaCapitao('search');
		$model->unsetAttributes();

		if (isset($_GET['GuiaCapitao']))
			$model->setAttributes($_GET['GuiaCapitao']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}