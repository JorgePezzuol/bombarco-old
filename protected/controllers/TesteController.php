<?php
Yii::import('application.vendor.api-cielo.*');
require_once 'autoload.php';
use Cielo\API30\Ecommerce\CieloEcommerce;
use Cielo\API30\Ecommerce\Environment;
use Cielo\API30\Ecommerce\Payment;
use Cielo\API30\Ecommerce\Request\CieloRequestException;
use Cielo\API30\Ecommerce\Sale;
use Cielo\API30\Merchant;

class TesteController extends GxController
{

    public function filters()
    {
        return array(
            'accessControl',
        );
    }

    public function accessRules()
    {
        return array(
            array('allow',
                'actions' => array('salvarPlanilha', 'pf', 'pj', 'index', 'anuncioPagamento', 'pagamentoBoleto', 'atualizarBoletos', 'migrarModelosZeroMilhas', 'darTurbinadas', 'cielo', 'marcasSemAnuncio', 'importTabela', 'arrumarSlugs', 'hmm', 'hmm2'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('react', 'arrumarImpressoes'),
                'users' => array('*'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }


    public function actionArrumarImpressoes() {


    	$e = EmbarcacaoImpressoes::model()->findAll("limitviews = 10");
    	foreach($e as $b) {
    		$b->limitviews = 10000;
    		$b->update();
    	}

    	$e = EmbarcacaoImpressoes::model()->findAll("limitviews = 50");
    	foreach($e as $b) {
    		$b->limitviews = 50000;
    		$b->update();
    	}

    	$e = EmbarcacaoImpressoes::model()->findAll("limitviews = 60");
    	foreach($e as $b) {
    		$b->limitviews = 60000;
    		$b->update();
    	}


        /*$content      = array(
        "en" => 'teste da carulinaaaa'
        );
        $hashes_array = array();
        array_push($hashes_array, array(
            "id" => "like-button",
            "text" => "Like",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url" => "https://yoursite.com"
        ));
        array_push($hashes_array, array(
            "id" => "like-button-2",
            "text" => "Like2",
            "icon" => "http://i.imgur.com/N8SN8ZS.png",
            "url" => "https://yoursite.com"
        ));
        $fields = array(
            'app_id' => "beb152bd-c4b9-46d4-8d1d-94cc2b5335e6",
            'include_player_ids' => array("6392d91a-b206-4b7b-a620-cd68e32c3a76","76ece62b-bcfe-468c-8a78-839aeaa8c5fa","8e0f21fa-9a5a-4ae7-a9a6-ca1f24294b86"),

            'included_segments' => array(
                'All'
            ),
            'data' => array(
                "foo" => "bar"
            ),
            'contents' => $content,
            'web_buttons' => $hashes_array
        );

        $fields = json_encode($fields);
        print("\nJSON sent:\n");
        print($fields);
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "https://onesignal.com/api/v1/notifications");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json; charset=utf-8',
            'Authorization: Basic ZTJlNzk3MGUtZGJkMC00MmU2LTkzM2ItNGRmOWVhNDBhMGM3'
        ));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, FALSE);
        curl_setopt($ch, CURLOPT_POST, TRUE);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
        
        $response = curl_exec($ch);
        var_dump($response);
        curl_close($ch);*/

        /*$token = new AppTokens();
        $token->token = $_POST["token"];
        $token->save();

        echo json_encode(array("resp"=>666));*/

    }

    public function actionSalvarPlanilha() {

        if(isset($_FILES)) {

            // salva planilha
            $info = pathinfo($_FILES['planilha']['name']);
            $ext = $info['extension']; 
            $nome_planilha = uniqid().".".$ext; 

            //$marca = preg_replace('/^\p{Z}+|\p{Z}+$/u', '', $coluna[0]);

            $target = Yii::getPathOfAlias('webroot') . '/public/tabela-bb-planilhas/'.$nome_planilha;
            move_uploaded_file($_FILES['planilha']['tmp_name'], $target);

            echo $nome_planilha;
            die;

        }
    }

    public function actionImportTabela()
    {

        //header("Content-Type: text/html; charset=utf-8");

        Yii::import('application.vendor.*');
        include 'PHPExcel-1.8/Classes/PHPExcel/IOFactory.php';

        if(!isset($_POST["nome_planilha"])) {
            exit;
        }
        else {
            $nome_planilha = $_POST["nome_planilha"];
        }

        //Use whatever path to an Excel file you need.
        //$inputFileName = Yii::getPathOfAlias('webroot') . '/public/teste.xlsx';
        $inputFileName = Yii::getPathOfAlias('webroot') . '/public/tabela-bb-planilhas/'.$nome_planilha;
        try {
            $inputFileType = PHPExcel_IOFactory::identify($inputFileName);
            $objReader = PHPExcel_IOFactory::createReader($inputFileType);
            $objPHPExcel = $objReader->load($inputFileName);
        } catch (Exception $e) {
            die('Error loading file "' . pathinfo($inputFileName, PATHINFO_BASENAME) . '": ' .
                $e->getMessage());
        }
        $sheet = $objPHPExcel->getSheet(0);
        $highestRow = $sheet->getHighestRow();
        $highestColumn = $sheet->getHighestColumn();

        $linha_anos = array();
        $nao_achou_modelo = array();
        $nao_achou_fabricante = array();

        $html = "";

        $teste = array();

        for ($row = 1; $row <= $highestRow; $row++) {

            // aqui vamos da coluna H q possui o primeiro valor ate a ultima
            $anos = $sheet->rangeToArray('H' . $row . ':' . $highestColumn . $row,
                null, true, false);

            foreach ($anos[0] as $index => $a) {
                $linha_anos[] = $a;
            }
        }

        for ($row = 2; $row <= $highestRow - 1; $row++) {

            // aqui vamos da coluna H q possui o primeiro valor ate a ultima
            $anos = $sheet->rangeToArray('H' . $row . ':' . $highestColumn . $row,
                null, true, false);

            $precos = array();
            foreach ($anos[0] as $index => $a) {
                if ($a != null && $a != "") {
                    $precos[$index]["ano"] = $linha_anos[$index];
                    $precos[$index]["valor"] = $a;
                }
            }

            $rowData = $sheet->rangeToArray('A' . $row . ':' . $highestColumn . $row,
                null, true, false);
            //Prints out data in each row.
            //Replace this with whatever you want to do with the data.
            foreach ($rowData as $index => $coluna) {
                // [0] => Marca
                // [1] => Modelo
                // [2] => Pes
                // [3] => Marca/Modelo Motor
                // [4] => Tipo motor
                // [5] => Quantidade (motor)
                // [6] => Potencia (motor)
                // [7] => Ano
                // A partir do index 7 temos os anos
                $nome_fab_n_achou_modelo = "";
                $id_fab_n_achou_modelo = "";

                // achar a marca
                $marca = preg_replace('/^\p{Z}+|\p{Z}+$/u', '', $coluna[0]);
                $criteria = new CDbCriteria;
                $criteria->select = "id, titulo, embarcacao_macros_id";
                $criteria->condition = "titulo = :match and status = :status";
                //$criteria->params = array(':match' => "%".$marca."%", ':status' => 1);
                $criteria->params = array(':match' => $marca, ':status' => 1);
                $fabs = EmbarcacaoFabricantes::model()->findAll($criteria);

                $id_fabricante = 0;
                $id_modelo = 0;

                $nome_modelo = preg_replace('/^\p{Z}+|\p{Z}+$/u', '', $coluna[1]);
                $nome_modelo = preg_replace('/\s+/', ' ', $nome_modelo);
                //$match = addcslashes($nome_modelo, '%_');

                if (count($fabs) == 0) {

                    if (!in_array($marca, $nao_achou_fabricante)) {
                        $nao_achou_fabricante[] = $marca;
                    }
                } else {

                    foreach ($fabs as $fab) {

                        $criteria = new CDbCriteria;
                        $criteria->select = "id";
                        $criteria->condition = "titulo = :match and embarcacao_fabricantes_id = :fab_id and embarcacao_macros_id = :emb_macros_id and status = :status";
                        //$criteria->params = array(':match' => "%".$nome_modelo."%", ':fab_id' => $fab->id, ':emb_macros_id' => $fab->embarcacao_macros_id, ':status' => 1);
                        $criteria->params = array(':match' => $nome_modelo, ':fab_id' => $fab->id, ':emb_macros_id' => $fab->embarcacao_macros_id, ':status' => 1);

                        $modelo = EmbarcacaoModelos::model()->find($criteria);

                        // usado p printar os ids e nomes de fabs q n foram achados nas querys
                        $nome_fab_n_achou_modelo = $fab->titulo;
                        $id_fab_n_achou_modelo .= $fab->id . ", ";

                        if ($modelo != null) {

                            $id_fabricante = $fab->id;
                            $id_modelo = $modelo->id;
                            $id_embarcacao_macros = $fab->embarcacao_macros_id;
                        }
                    }

                    if ($id_modelo == 0) {

                        // monta texto p mostrar os q n foram encontrados
                        $texto = rtrim($id_fab_n_achou_modelo, ', ') . " - " . $nome_fab_n_achou_modelo . " - <b>" . $nome_modelo . "</b>";

                        if (!in_array($texto, $nao_achou_modelo)) {
                            $nao_achou_modelo[] = $texto;
                        }
                    }

                    $tipo_motor = preg_replace('/^\p{Z}+|\p{Z}+$/u', '', $coluna[4]);
                    $criteria = new CDbCriteria;
                    $criteria->select = "id";
                    $criteria->condition = "titulo LIKE :match and status = :status";
                    $criteria->params = array(':match' => "%" . $tipo_motor . "%", ':status' => 1);
                    $tipo_motor = MotorTipos::model()->find($criteria);
                    if ($tipo_motor == null) {
                        $tipo_motor = MotorTipos::model()->findByPk(1);
                    }


                    // se fez o ajax p gravar os registros (CUIDADO!!)
                    if(isset($_POST['operacao']) && $_POST['operacao'] == "gravar-registros") {

                        if ($id_modelo != 0) {

                            foreach ($precos as $p) {

                                $binding = array();
                                $binding[":fab_id"] = $id_fabricante;
                                $binding[":mod_id"] = $id_modelo;
                                $binding[":ano"] = $p["ano"];
                                $existe = TabelaEmbarcacoes::model()->find("embarcacao_fabricantes_id=:fab_id and embarcacao_modelos_id=:mod_id and ano=:ano", $binding);

                                if ($existe == null) {

                                    $tab = new TabelaEmbarcacoes();

                                    $tab->ano = $p["ano"];
                                    $tab->valor = $p["valor"];

                                    $tab->embarcacao_fabricantes_id = $id_fabricante;
                                    $tab->embarcacao_modelos_id = $id_modelo;
                                    $tab->motor_tipos_id = $tipo_motor->id;
                                    $tab->embarcacao_macros_id = $id_embarcacao_macros;

                                    $tab->pes = $coluna[2];
                                    $tab->qtdemotores = $coluna[5];
                                    $tab->potenciamotor = $coluna[6];
                                    $tab->motorizacao = $coluna[3];

                                    $teste[] = $tab;

                                    /*if ($tab->save()) {
                                        $nome_f = EmbarcacaoFabricantes::model()->findByPk($tab->embarcacao_fabricantes_id)->titulo;
                                        $nome_m = EmbarcacaoModelos::model()->findByPk($tab->embarcacao_modelos_id)->titulo;
                                        $tipo_m = MotorTipos::model()->findByPk($tab->motor_tipos_id)->titulo;
                                        var_dump("<br/>");
                                        var_dump($tab->embarcacao_modelos_id);
                                        var_dump("Salvo, Fabricante: " . $nome_f . " Modelo: " . $nome_m . " Pes: " . $tab->pes . " Motor: " . $tab->motorizacao . " Tipo motor: " . $tipo_m . " Qtde motor: " . $tab->qtdemotores . " Ano: " . $tab->ano . " Valor: " . $tab->valor);
                                    } else {
                                        var_dump("<br/>");
                                        var_dump($tab->getErrors());
                                    }*/
                                }

                                //var_dump("<br/>");
                                //var_dump("Teste, Fabricante: ".$id_fabricante. " Modelo: ".$id_modelo." Pes: ".$tab->pes." Motor: ".$tab->motorizacao." Tipo motor: ".$tipo_motor." Qtde motor: ".$tab->qtdemotores." Ano: ".$tab->ano." Valor: ".$tab->valor);

                            } // for
                        }
                    }
                }

            }

            //print_r($teste);

            //echo '<pre>';
            //print_r($rowData);
            //echo '</pre>';
        }


        if(isset($_POST['operacao']) && $_POST['operacao'] == "gravar-registros") {

            echo CJSON::encode($teste);
            
        }
        else {

            $html = "ID do(s) fabricante(s)----Nome do fabricante----Nome do modelo que nao achou";
            $html .= "<br/><br/>";
            $html .= "Total de modelos nao encontrados: " . count($nao_achou_modelo);
            $html .= "<br/><br/>";

            foreach ($nao_achou_modelo as $r) {
                $html .= "<br/>";
                $html .= $r;
            }

            echo $html;
           
        }

         exit;



        //echo "|ID do(s) fabricante(s)|  |Nome do fabricante|  |Nome do modelo que nao achou|";
        //echo "<br/><br/>";
        //echo "Total de modelos nao encontrados: " . count($nao_achou_modelo);
        //echo "<br/><br/>";

        /*foreach ($nao_achou_modelo as $r) {
            echo "<br/>";
            echo $r;
        }*/

        

    }

    public function actionCielo()
    {

        // ...
        // Configure o ambiente
        //$environment = $environment = Environment::sandbox();
        $environment = $environment = Environment::production();

        // Configure seu merchant
        //$merchant = new Merchant('64bd4b99-1872-4a61-8a01-41f3e11701a6', 'UHOFVFNOKNNICIMLWKCNEBRGLBZAGBRTTSWRSFRY');
        $merchant = new Merchant('fbf440a7-a143-4eb9-91d7-8c56d6ba5e64', 'UQpF3lAPVdsaiUkRAZGnD22kQgmPfrIYHsRtRMr9');

        // Crie uma instância de Sale informando o ID do pagamento
        $sale = new Sale('22');

        // Crie uma instância de Customer informando o nome do cliente
        $customer = $sale->customer('Jorge Luis Pezzuol');

        // Crie uma instância de Payment informando o valor do pagamento
        $payment = $sale->payment(1);

        // Crie uma instância de Credit Card utilizando os dados de teste
        // esses dados estão disponíveis no manual de integração
        $payment->setType(Payment::PAYMENTTYPE_CREDITCARD)
            ->creditCard("103", "Master")
            ->setExpirationDate("12/2024")
            ->setCardNumber("5502098723810087")
            ->setHolder("Jorge Luis Pezzuol");

        // Crie o pagamento na Cielo
        try {
            // Configure o SDK com seu merchant e o ambiente apropriado para criar a venda
            $sale = (new CieloEcommerce($merchant, $environment))->createSale($sale);

            // Com a venda criada na Cielo, já temos o ID do pagamento, TID e demais
            // dados retornados pela Cielo
            $paymentId = $sale->getPayment()->getPaymentId();

            var_dump($paymentId);

            // Com o ID do pagamento, podemos fazer sua captura, se ela não tiver sido capturada ainda
            $sale = (new CieloEcommerce($merchant, $environment))->captureSale($paymentId, 1, 0);

            // E também podemos fazer seu cancelamento, se for o caso
            //$sale = (new CieloEcommerce($merchant, $environment))->cancelSale($paymentId, 1.00);
        } catch (CieloRequestException $e) {
            // Em caso de erros de integração, podemos tratar o erro aqui.
            // os códigos de erro estão todos disponíveis no manual de integração.
            $error = $e->getCieloError();
        }

    }

    public function actionDarTurbinadas()
    {

        $caminho = YiiBase::getPathOfAlias("webroot") . "/img/essa111.jpg";

        $message = new YiiMailMessage;
        //$message->view = "mail_contato_admin";
        $message->subject = 'REAL FAST | HACKERMAN';

        $message->setBody("a", 'text/html');
        $message->addTo("jorge_pezzuol@hotmail.com");
        $message->from = "jorge_pezzuol@hotmail.com";

        $file_path = $caminho;
        $swiftAttachment = Swift_Attachment::fromPath($file_path)->setFilename('HACKED.jpg');
        $message->attach($swiftAttachment);
        if (!Yii::app()->mail->send($message)) {
            // erro
            echo '-1';
        }

        /*$emb = Embarcacoes::model()->findAll("status = 2 AND email = 'contato@marinaportoyachts.com.br'");

    foreach($emb as $e) {
    if(!Embarcacoes::checkTurbo($e, "fotos")) {
    $embarcRecs = new EmbarcacoesHasEmbarcacaoRecursosAdicionais;
    $embarcRecs->embarcacoes_id = $e->id;
    $embarcRecs->embarcacao_recursos_adicionais_id = 2;
    $embarcRecs->status = Anuncio::$_status['ATIVA'];
    $embarcRecs->save();
    }
    if(!Embarcacoes::checkTurbo($e, "video")) {
    $embarcRecs = new EmbarcacoesHasEmbarcacaoRecursosAdicionais;
    $embarcRecs->embarcacoes_id = $e->id;
    $embarcRecs->embarcacao_recursos_adicionais_id = 3;
    $embarcRecs->status = Anuncio::$_status['ATIVA'];
    $embarcRecs->save();
    }
    if(!Embarcacoes::checkTurbo($e, "destaque_busca")) {
    $embarcRecs = new EmbarcacoesHasEmbarcacaoRecursosAdicionais;
    $embarcRecs->embarcacoes_id = $e->id;
    $embarcRecs->embarcacao_recursos_adicionais_id = 4;
    $embarcRecs->status = Anuncio::$_status['ATIVA'];
    $embarcRecs->save();
    $e->destaque = Anuncio::$_status_destaque_embarcacao['PENDENTE'];
    $e->update();
    }
    if(!Embarcacoes::checkTurbo($e, "titulo")) {
    $embarcRecs = new EmbarcacoesHasEmbarcacaoRecursosAdicionais;
    $embarcRecs->embarcacoes_id = $e->id;
    $embarcRecs->embarcacao_recursos_adicionais_id = 5;
    $embarcRecs->status = Anuncio::$_status['ATIVA'];
    $embarcRecs->save();
    }
    }*/
    }

    // ARRUMAR SLUGS SCHAEFER YACHTS
    public function actionHmm2() {


        //$sql = "select id, slug from embarcacoes where INSTR(slug, 'Ao Mar') > 0 and status = 2 order by id desc limit 20000;";
        /*$sql = "select id, slug from embarcacoes where slug like '%schaefer%' order by id desc limit 20000;";

        $lista = Yii::app()->db->createCommand($sql)->queryAll();

        //$marcas = array("Fibrafort-", "fibrafort-");
        $marcas = array("schaefer-yachts");

        foreach($lista as $reg) {
            $novo_slug = str_replace($marcas, "", strtolower($reg["slug"]));
            $novo_slug = preg_replace('#[ -]+#', '-', strtolower($novo_slug));

            $haystack = $novo_slug;
            $needle = 'phantom';

            if (strpos($haystack,$needle) !== false) {
            }
            else {
                $novo_slug = "phantom-".$novo_slug;
            }

            if(substr($novo_slug, -1) == "-") {
                $novo_slug = substr_replace($novo_slug, "", -1);
            }

            if($novo_slug[0] == "-") {
                $novo_slug[0] = "";
            }
            
            $novo_slug = str_replace("--", "-", $novo_slug);
            $novo_slug = str_replace("phantom-schaefer", "phantom", $novo_slug);
            

            if(substr_count($novo_slug, "-") == 3) {
                $pieces = explode("-", $novo_slug);

                $parte_um = $pieces[0]."-".$pieces[1];
                $parte_dois = $pieces[2]."-".$pieces[3];

                $dif = strcmp(trim($parte_um), trim($parte_dois));

                if($dif == 0) {
                    $novo_slug = $parte_um;
                }
            }


            //echo("<br/>");
            //echo($reg["id"] . " - " . $reg["slug"] . " =========> " . "<b>".$novo_slug."</b>");
            Embarcacoes::model()->updateByPk($reg["id"], array("slug"=>$novo_slug));
            
        }*/
    }

    // ARRUMAR SLUGS FIBRAFORT FOCKER
    public function actionHmm() {


        //$sql = "select id, slug from embarcacoes where INSTR(slug, 'Ao Mar') > 0 and status = 2 order by id desc limit 20000;";
        /*$sql = "select id, slug from embarcacoes where slug like '%fibrafort%' order by id desc limit 20000;";

        $lista = Yii::app()->db->createCommand($sql)->queryAll();

        //$marcas = array("Fibrafort-", "fibrafort-");
        $marcas = array("fibrafort-");

        foreach($lista as $reg) {
            $novo_slug = str_replace($marcas, "", strtolower($reg["slug"]));
            $novo_slug = preg_replace('#[ -]+#', '-', strtolower($novo_slug));

            $haystack = $novo_slug;
            $needle = 'focker';

            if (strpos($haystack,$needle) !== false) {
            }
            else {
                $novo_slug = "focker-".$novo_slug;
            }

            if(substr($novo_slug, -1) == "-") {
                $novo_slug = substr_replace($novo_slug, "", -1);
            }

            //echo("<br/>");
            //echo($reg["id"] . " - " . $reg["slug"] . " =========> " . "<b>".$novo_slug."</b>");
            Embarcacoes::model()->updateByPk($reg["id"], array("slug"=>$novo_slug));
        }*/
    }

    public function actionArrumarSlugs() {


        $sql = "select id, slug from embarcacoes where INSTR(slug, ' ') > 0 and status = 2 order by id desc limit 20000;";
        //$sql = "select id, slug from embarcacoes where INSTR(slug, ' ') > 0 and status = 2 and macros_id = 3 order by slug asc limit 20000;";
        $lista = Yii::app()->db->createCommand($sql)->queryAll();

        foreach($lista as $reg) {
            $slug = preg_replace('#[ -]+#', '-', $reg["slug"]);

            $emb = Embarcacoes::model()->find("slug=:slug", array(":slug"=>$slug));
            
            if($emb == null) {
                Embarcacoes::model()->updateByPk($reg["id"], array("slug"=>$slug));
            }
            else {

                for($i = 2; $i < 60; $i++) {
                    $novo_slug = $slug."-".$i;
                    if(Embarcacoes::model()->find("slug=:slug", array(":slug"=>$novo_slug)) != null) {
                        continue;
                    }   
                    else {
                        Embarcacoes::model()->updateByPk($reg["id"], array("slug"=>$slug));
                        break;
                    }
                }
            }
        }
    }



    public function actionMigrarModelosZeroMilhas()
    {

        ini_set('display_errors', 1);
        ini_set('display_startup_erros', 1);
        error_reporting(E_ALL);

        $sql = "select embarcacao_modelos.titulo as nome_modelo, embarcacoes.id as log, embarcacoes.descricao, embarcacoes.email, embarcacao_tipos.embarcacao_macros_id as categoria, embarcacao_tipos.titulo as tipo, empresas.razao as marca, embarcacoes.valor, embarcacao_modelos.tamanho,
        embarcacao_modelos.passageiros, embarcacao_modelos.acomodacoes, embarcacao_modelos.tamanho, embarcacao_modelos.boca,
        embarcacao_modelos.calado, embarcacao_modelos.pesocasco, embarcacao_modelos.tanquecombustivel, embarcacao_modelos.tanqueagua";
        $sql .= " from usuarios";
        $sql .= " inner join empresas on empresas.usuarios_id = usuarios.id";
        $sql .= " inner join usuarios_embarcacoes on usuarios.id = usuarios_embarcacoes.usuarios_id";
        $sql .= " inner join embarcacoes on usuarios_embarcacoes.embarcacoes_id = embarcacoes.id";
        $sql .= " inner join embarcacao_modelos on embarcacao_modelos.id = embarcacoes.embarcacao_modelos_id";
        $sql .= " inner join embarcacao_tipos on embarcacao_tipos.id = embarcacao_modelos.embarcacao_tipos_id";
        $sql .= " and empresas.macros_id = 3";
        $sql .= " and empresas.status = 2";
        $sql .= " and embarcacoes.macros_id = 3";
        $sql .= " and embarcacoes.status = 2";
        $sql .= " order by embarcacoes.id";
        $sql .= " LIMIT 0, 50";
        //$sql .= " LIMIT 100, 50";
        //$sql .= " LIMIT 200, 50";
        //$sql .= " LIMIT 300, 50";
        //$sql .= " LIMIT 400, 50";
        //$sql .= " LIMIT 500, 50";
        //$sql .= " LIMIT 600, 50";
        //$sql .= " LIMIT 700, 50";
        //$sql .= " LIMIT 800, 50";
        //$sql .= " LIMIT 900, 50";
        //$sql .= " LIMIT 1000, 50";
        //$sql .= " LIMIT 1100, 50";
        //$sql .= " LIMIT 1150, 50";

        try {

            $lista = Yii::app()->db->createCommand($sql)->queryAll();

            $dbh = new pdo('mysql:host=208.91.198.47;dbname=bombalau_zeromilhas',
                'bombalau_user',
                '#Bombarco2016',
                array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

            $dbh->query("set foreign_key_checks=0");

            foreach ($lista as $item) {

                echo "<br/>";
                var_dump("Log último ID: " . $item["log"] . " - " . $item["tipo"]);

                if ($item["email"] == null || $item["email"] == "") {
                    $email = "atendimento@bombarco.com.br";
                } else {
                    $email = $item["email"];
                }
                $capacidade_dia = (is_null($item["passageiros"])) ? 0 : $item["passageiros"];
                $capacidade_noite = (is_null($item["acomodacoes"])) ? 0 : $item["acomodacoes"];
                $boca = (is_null($item["boca"])) ? 0 : $item["boca"];
                $calado_maximo = (is_null($item["calado"])) ? 0 : $item["calado"];
                $tanque_combustivel = (is_null($item["tanquecombustivel"])) ? 0 : $item["tanquecombustivel"];
                $tanque_agua = (is_null($item["tanqueagua"])) ? 0 : $item["tanqueagua"];
                $peso = (is_null($item["pesocasco"])) ? 0 : $item["pesocasco"];
                if ($item["nome_modelo"] != "" && $item["nome_modelo"] != null) {
                    $nome_modelo = $item["nome_modelo"];
                } else {
                    $nome_modelo = "Sem nome";
                }
                $tamanho = (is_null($item["tamanho"])) ? 0 : $item["tamanho"];
                if ($item["descricao"] != "" && $item["descricao"] != null) {
                    $visao_geral = $item["descricao"];
                } else {
                    $visao_geral = "Sem descrição";
                }
                $preco = (is_null($item["valor"])) ? 0 : $item["valor"];

                $tipo = $item["tipo"];
                $marca = $item["marca"];

                $consulta = $dbh->prepare("SELECT id from marcas where nome = :marca");
                $consulta->bindParam(':marca', $marca, PDO::PARAM_STR);
                $consulta->execute();
                $linha = $consulta->fetch(PDO::FETCH_ASSOC);

                if ($linha != null) {
                    $id_marca = $linha["id"];
                } else {
                    $id_marca = 0;
                }

                $sql = 'INSERT IGNORE INTO modelos(nome, email, capacidade_dia, capacidade_noite, boca, calado_maximo, tanque_combustivel, tanque_agua, peso, tamanho, visao_geral, preco, id_marca)';
                $sql .= ' VALUES(:nome_modelo, :email, :capacidade_dia, :capacidade_noite, :boca, :calado_maximo, :tanque_combustivel, :tanque_agua, :peso, :tamanho, :visao_geral, :preco, :id_marca);';

                $stmt = $dbh->prepare($sql);
                $stmt->bindParam(":nome_modelo", $nome_modelo);
                $stmt->bindParam(":email", $email);
                $stmt->bindParam(":capacidade_dia", $capacidade_dia);
                $stmt->bindParam(":capacidade_noite", $capacidade_noite);
                $stmt->bindParam(":boca", $boca);
                $stmt->bindParam(":calado_maximo", $calado_maximo);
                $stmt->bindParam(":tanque_combustivel", $tanque_combustivel);
                $stmt->bindParam(":tanque_agua", $tanque_agua);
                $stmt->bindParam(":peso", $peso);
                $stmt->bindParam(":tamanho", $tamanho);
                $stmt->bindParam(":visao_geral", $visao_geral);
                $stmt->bindParam(":preco", $preco);
                $stmt->bindParam(":id_marca", $id_marca);

                if ($stmt->execute()) {
                    var_dump("cadastro modelo ok -" . $item["log"]);

                    $modelos_id = $dbh->lastInsertId();

                    // pegar as imagens da embarc
                    $sql_imagens = "SELECT imagem, principal FROM embarcacao_imagens";
                    $sql_imagens .= " WHERE embarcacoes_id = " . $item["log"];

                    $imagens = Yii::app()->db->createCommand($sql_imagens)->queryAll();

                    if (count($imagens) > 0) {

                        foreach ($imagens as $img) {

                            if ($img["imagem"] != "" && $img["imagem"] != null) {
                                $imagem = $img["imagem"];
                                $principal = $img["principal"];

                                /*$sql_insert_imagens = "INSERT IGNORE INTO modelos_imagens(imagem, modelos_id, principal, status)";
                                $sql_insert_imagens .= " VALUES('".$imagem."', ".$modelos_id.", ".$principal.", 1);";*/

                                $sql_insert_imagens = "INSERT IGNORE INTO modelos_imagens(imagem, modelos_id, principal, status) VALUES (:imagem, :modelos_id, :principal, :status)";

                                $status = 1;
                                $stmt_img = $dbh->prepare($sql_insert_imagens);
                                $stmt_img->bindParam(":imagem", $imagem);
                                $stmt_img->bindParam(":modelos_id", $modelos_id);
                                $stmt_img->bindParam(":principal", $principal);
                                $stmt_img->bindParam(":status", $status);

                                if ($stmt_img->execute()) {
                                    var_dump("ok salva iamgem - " . $item["log"]);
                                } else {
                                    var_dump("falha salvar imagem - " . $item["log"] . " - " . $sql_insert_imagens);

                                }
                            }
                        }
                    }

                    $m = new Migracao();
                    $m->migrarModelos($dbh, $tipo, $modelos_id, $item["categoria"], $item["log"]);
                } else {
                    var_dump("erro cadastro -" . $item["log"]);
                }

            } // foreach

            $dbh->query("set foreign_key_checks=1");

        } catch (Exception $ex) {
            var_dump($ex->getMessage());
            exit;
        }

    }

    public function actionIndex()
    {

        /*$mid = 'edccc13b-2878-4379-af68-98c6b738b1be'; //seu merchant id
        $key = 'JPPFNOFSYYPEVWOEWGDLBZUIVXOQMRTRFOIIPPKG'; //sua chave

        $cielo = new Cielo();
        var_dump($cielo);
        exit;*/

        $this->render("index");

    }

    public function actionIndexZeroMilhas()
    {

        /* isso aqui estava no zeromilhas pra migrar imagens

        ini_set('display_errors',1);
        ini_set('display_startup_erros',1);
        error_reporting(E_ALL);

        error_reporting(0);

        /*$dbh = new pdo('mysql:host=localhost;dbname=bombalau_zeromilhas',
        'bombalau_user',
        '#Bombarco2016',
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

        // rodou ultima vez 12h30, o prox é 1000, 500
        $consulta = $dbh->prepare("SELECT imagem from modelos_imagens LIMIT 3500,600");
        $consulta->execute();
        $logos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        foreach($logos as $item) {
        $logo = $item["imagem"];
        copy("http://www.bombarco.com.br/public/embarcacoes/".$logo, "fotos_modelos/".$logo);
        var_dump($logo);
        }
         */

        /*$sql = "select usuarios.email, empresas.razao, empresas.logo, empresas.destaque";
    $sql .= " from usuarios";
    $sql .= " inner join empresas on empresas.usuarios_id = usuarios.id";
    $sql .= " and empresas.macros_id = 3";
    $sql .= " and empresas.status = 2";
    $lista = Yii::app()->db->createCommand($sql)->queryAll();

    $dbh = new pdo('mysql:host=208.91.198.47;dbname=bombalau_zeromilhas',
    'bombalau_user',
    '#Bombarco2016',
    array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

    try {

    foreach($lista as $item) {

    $email = $item["email"];
    $senha = md5("123mudar");

    $sql = 'INSERT INTO usuarios (email, senha) VALUES ("'.$email.'", "'.$senha.'");';
    $stmt = $dbh->prepare($sql);
    $stmt->execute();

    $id = $dbh->lastInsertId();

    $nome = $item["razao"];
    $logo = $item["logo"];
    $destaque = $item["destaque"];

    $sql2 = 'INSERT INTO marcas (nome, logo, destaque, id_usuario, status) VALUES ("'.$nome.'", "'.$logo.'", '.$destaque.', '.$id.', 1);';
    $stmt2 = $dbh->prepare($sql2);
    $stmt2->execute();

    }

    } catch(Exception $ex) {
    var_dump($sql2);
    var_dump($ex->getMessage());
    }*/

    }

    // fim anunciar embarcação
    // redireciona para página de transações realizadas
    // $minha_conta => se for diferente de null, renderizamos a view de pagamento do minha conta,
    // caso contrário é a view de pagamento do fluxo de anúncio
    public function actionAnuncioPagamento($minha_conta = null)
    {

        /*Yii::import('application.extensions.yii-azpay.*');
        $az_pay = new YiiAzPay(Anuncio::$_az_pay['ID'], Anuncio::$_az_pay['KEY']);

        try {
        $az_pay->report("4352EECB-5019-EA73-F98A-8744B08AEFC2");
        $xml = $az_pay->response();
        var_dump($xml);
        var_dump($az_pay);
        var_dump($az_pay->execute());
        } catch(Exception $ex) {
        var_dump($ex);
        }

        exit;*/

        try {
            Embarcacoes::atualizarEmbarcacoesVencidas();
        } catch (Exception $ex) {
            var_dump($ex);
        }

        // pegar todas as ordens do usuario e redirecionar para página de pagamento
        $ordens = Usuarios::getOrdens();

        $somaOrdens = Usuarios::somarOrdens();

        if (count($ordens) > 0) {

            $view = 'anuncio_pagamento';

            if ($minha_conta != null) {
                $view = 'pagamento_minha_conta';
            }

            $this->render($view, array('ordens' => $ordens, 'somaOrdens' => $somaOrdens));

        } else {

            $this->redirect(Yii::app()->createUrl('usuarios/update', array('id' => Yii::app()->user->id)));
        }

        exit;
    }

    public function actionPagamentoBoleto()
    {

        $validacao = Transacoes::validarTransacao(Yii::app()->getRequest()->getPost('tid'));
        $return = array('error' => 0, 'msg' => null);

        // Se houver erro na trasacão
        // Retorna o erro
        if ($validacao['error'] != 0) {
            $return['error'] = $validacao['error'];
            $return['msg'] = $validacao['msg'];
            $return['tid'] = Yii::app()->getRequest()->getPost('tid');

            echo json_encode($return);
            exit();
        }

        // Seta a variavel como objeto transacao
        $transacao = $validacao['transacao'];

        Yii::import('application.extensions.yii-azpay.*');
        $az_pay = new YiiAzPay(Anuncio::$_az_pay['ID'], Anuncio::$_az_pay['KEY']);

        $az_pay->config_order['reference'] = $transacao->tid;
        $az_pay->config_order['totalAmount'] = $transacao->valor;
        $az_pay->config_boleto['acquirer'] = '20';
        $az_pay->config_boleto['amount'] = $transacao->valor;

        $nrDocument = mt_rand(0, 99999999);
        $nrDocument = str_pad($nrDocument, 6, '0', STR_PAD_LEFT); // add zeroes in front of the generated string
        $az_pay->config_boleto['nrDocument'] = $nrDocument;

        $az_pay->config_billing['customerIdentity'] = Usuarios::getUsuarioLogado()->cpf;
        $az_pay->config_billing['name'] = Usuarios::getUsuarioLogado()->nome;
        $az_pay->config_billing['address'] = 'Não informado';
        $az_pay->config_billing['address2'] = 'Não informado';
        $az_pay->config_billing['city'] = 'Mogi das Cruzes';
        $az_pay->config_billing['state'] = 'SP';
        $az_pay->config_billing['postalCode'] = '08790-170';
        $az_pay->config_billing['country'] = 'BR';
        $az_pay->config_billing['phone'] = Usuarios::getUsuarioLogado()->celular != null ? Usuarios::getUsuarioLogado()->celular : "";
        $az_pay->config_billing['email'] = Usuarios::getUsuarioLogado()->email != null ? Usuarios::getUsuarioLogado()->email : "";

        $az_pay->boleto();

        // Se houver erro ao executar o CURL
        // ou não retornar 200
        if ($az_pay->error == true) {

            $return['error'] = "1";
            $return['msg'] = "Ocorreu um erro. Favor contatar o admin do sistema.";
            $return['tid'] = Yii::app()->getRequest()->getPost('tid');
            echo json_encode($return);
            exit;
        }

        $res = $az_pay->response();

        $xml = $res->transactionId;
        $out = array();
        foreach ((array) $xml as $index => $node) {
            $out[$index] = (is_object($node)) ? xml2array($node) : $node;
        }

        $transactionId = $out[0];

        // atualizar transação com data de confirmação, tid externo, etc
        $transacao->tid_externo = $transactionId;
        $transacao->status = Anuncio::$_status_transacao['AGUARDANDO_PAGAMENTO'];
        $transacao->data_confirmacao = date('Y-m-d H:i:s');
        $transacao->formapagamento = 'boleto';
        $transacao->detalhes = json_encode($res);
        if (!$transacao->saveAttributes(array('tid_externo', 'status', 'data_confirmacao', 'formapagamento', 'detalhes'))) {

            $return['error'] = "1";
            $return['msg'] = "Ocorreu um erro. Favor contatar o admin do sistema.";
            $return['tid'] = Yii::app()->getRequest()->getPost('tid');
            echo json_encode($return);
        }

        $return['urlBoleto'] = strval($res->processor->Transfer->urlTransfer);

        echo json_encode($return);
        exit();

    } // fim metodo

    // disparado via cronjob https://cron-job.org/en/
    public function actionAtualizarBoletos()
    {

        $transacoes = Transacoes::model()->findAll("status=:status", array(":status" => Anuncio::$_status_transacao['AGUARDANDO_PAGAMENTO']));

        Yii::import('application.extensions.yii-azpay.*');
        $az_pay = new YiiAzPay(Anuncio::$_az_pay['ID'], Anuncio::$_az_pay['KEY']);

        foreach ($transacoes as $t) {

            try {

                $az_pay->report($t->tid_externo);
                $xml = $az_pay->response();
                //
                // boleto foi pago
                if ($xml->status == "8") {

                    // após atualizar a transação, vamos ativar as ordens de pedido que compõem a mesma
                    foreach ($t->ordens as $ordem) {

                        // id da ordem corrente para utilizar nos updates
                        $id = (int) $ordem->id_item;

                        // carregar usuario dono da transacao
                        $usuario_logado = Usuarios::model()->findByPk($t->usuarios_id);

                        // atualizar ordem para status de paga
                        $ordem->status = Anuncio::$_status_ordem['PAGA'];
                        $ordem->data_ativacao = date('Y-m-d H:i:s');
                        $ordem->update();

                        // verificar o tipo da ordem
                        if ($ordem->ordemTipos->alias == 'plano_anuncio') {

                            // carregar o planoUsuarios pelo ID que está no id_item da ordem
                            $plano_usuario = PlanoUsuarios::model()->findByPk($id);

                            // tipo de ordem é de plano de anuncio (mudar status pra 1 de todas as embarcações do plano)
                            $duracao = $plano_usuario->planos->duracaomeses;
                            $plano_usuario->inicio = date('Y-m-d H:i:s');
                            $plano_usuario->fim = date('Y-m-d H:i:s', strtotime('today + ' . $duracao . ' month'));
                            $plano_usuario->status = Anuncio::$_status_plano['PAGO'];
                            if (!$plano_usuario->update()) {
                                echo "0";
                            }

                            // loop para embarcação
                            foreach ($plano_usuario->embarcacoes as $embarc) {
                                $embarc->status = Anuncio::$_status['ATIVA'];
                                if (!$embarc->update()) {
                                    echo "0";
                                }

                                // ativar imagens não turbo da embarcação
                                foreach ($embarc->embarcacaoImagens as $embarcImagem) {
                                    if ($embarcImagem->turbo == Anuncio::$_img_turbo['NAO_TURBO']) {
                                        $embarcImagem->status = Anuncio::$_status['ATIVA'];
                                        if (!$embarcImagem->update()) {
                                            echo "0";
                                        }

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
                                if (!$plano_usuario_renovado->saveAttributes(array('status'))) {
                                    echo "0";
                                }

                            } else { // Caso não exista um De-Para dos planos, busca o plano na tabela padrão

                                $plano_usuario = PlanoUsuarios::model()->findByPk($id);
                                if (empty($plano_usuario)) {
                                    echo "0";
                                }

                                $plano_usuario->status = 2;
                                if (!$plano_usuario->saveAttributes(array('status'))) {
                                    echo "0";
                                }

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
                            if (!$plano_usuario->update()) {
                                echo "0";
                            }

                            // ativar empresa
                            $usuario_logado->empresases->status = Anuncio::$_status['ATIVA'];
                            if (!$usuario_logado->empresases->update()) {
                                echo "0";
                            }

                            // ordem tipo rec adicional embarcacao
                        } elseif ($ordem->ordemTipos->alias == 'adicional_embarcacao') {

                            $embarcRecAdicionais = EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()->find('id=:id', array(':id' => $id));

                            $embarcRecAdicionais->status = Anuncio::$_status['ATIVA'];
                            if (!$embarcRecAdicionais->update()) {
                                echo "0";
                            }

                            if ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'fotos') {

                                foreach ($embarcRecAdicionais->embarcacoes->embarcacaoImagens as $embarcImg) {
                                    if ($embarcImg->turbo == Anuncio::$_img_turbo['TURBO']) {
                                        $embarcImg->status = Anuncio::$_status['ATIVA'];
                                        if (!$embarcImg->update()) {
                                            echo "0";
                                        }

                                    }
                                }

                            } elseif ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'destaque_busca') {

                                //$embarcRecAdicionais = EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()->find('id=:id', array(':id' => $id));
                                $embarcRecAdicionais->embarcacoes->destaque = Anuncio::$_status_destaque_embarcacao['PAGO'];
                                if (!$embarcRecAdicionais->embarcacoes->update()) {
                                    throw new Exception('Erro ao ativar Destaque na Busca', 1);
                                }

                            } elseif ($embarcRecAdicionais->embarcacaoRecursosAdicionais->flag == 'cpm') {

                                // atualizar cpm na tabela de embarcacao impressoes
                                $idEmbarcImpressoes = $embarcRecAdicionais->embarcacoes->embarcacaoImpressoes[0]->id;
                                $embarcImpressao = EmbarcacaoImpressoes::model()->findByPk($idEmbarcImpressoes);
                                $embarcImpressao->status = Anuncio::$_status['ATIVA'];

                                if (!$embarcImpressao->update()) {
                                    echo "0";
                                }

                            }

                            // ordem tipo rec adicional empresa
                        } elseif ($ordem->ordemTipos->alias == 'adicional_empresa') {

                            $empresaRecAdicionais = EmpresasHasEmpresaRecursosAdicionais::model()->find('id=:id', array(':id' => $id));
                            $empresaRecAdicionais->status = Anuncio::$_status['ATIVA'];
                            if (!$empresaRecAdicionais->update()) {
                                throw new Exception('Erro ao ativar Turbinadas de Empresa', 1);
                            }

                            // verificar se é um rec adicional de imagem (caso for, temos q ativar as imagens)
                            if ($empresaRecAdicionais->empresaRecursosAdicionais->flag == 'fotos') {

                                // obter empresa
                                $empresa = Usuarios::getEmpresa();

                                // loop para ativar as fotos da empresa
                                foreach ($empresa->empresaImagens as $imagem) {
                                    $imagem->status = Anuncio::$_status['ATIVA'];
                                    if (!$imagem->update()) {
                                        echo "0";
                                    }

                                }

                            } else if ($empresaRecAdicionais->empresaRecursosAdicionais->flag == 'cpm') {

                                // atualizar cpm na tabela de empresas impressoes
                                $idEmpresaImpressoes = $empresaRecAdicionais->empresas->empresasImpressoes[0]->id;
                                if (!EmpresasImpressoes::model()->updateByPk($idEmpresaImpressoes, array('status' => Anuncio::$_status['ATIVA']))) {
                                    echo "0";
                                }

                            }

                        }

                        // atualizar transação
                        Transacoes::model()->updateByPk($t->id, array('status' => Anuncio::$_status_transacao['PAGA']));

                        // enviar email avisando o cliente q o pagamento foi realizado com sucesso
                        $message = new YiiMailMessage;
                        $message->view = "mail_pagou";
                        $message->subject = 'BomBarco - Pagamento Realizado com Sucesso!';
                        $message->setBody(array('email' => $usuario_logado->email), 'text/html');
                        $message->addTo($usuario_logado->email);
                        $message->from = Yii::app()->params['bombarcoAtendimento'];

                        // enviar email para o email cadastrado na embarcação, para informar que o anuncio foi validado ok
                        if (!Yii::app()->mail->send($message)) {
                            echo "0";
                        }

                    } // fim foreach

                    echo "1";
                    exit;

                } // fim if pagou

            } catch (Exception $ex) {
                echo "0";
            }
        }

    }

    public function actionPf()
    {

        $usuarios = Usuarios::model()->findAll("pessoa = 'F' ORDER BY nome ASC");

        $cont = 0;

        foreach ($usuarios as $u) {

            $usuarios_emb = UsuariosEmbarcacoes::model()->with('embarcacoes')->findAll("usuarios_id=:usuarios_id and embarcacoes.status = 2", array(":usuarios_id" => $u->id));

            if (count($usuarios_emb) > 0) {

                $cont += 1;
                echo $u->nome . " - " . $u->email;
                echo '<br/>';
            }
        }

        echo "<br/>";
        echo "Total: " . $cont;
    }

    public function actionPj()
    {

        $usuarios = Usuarios::model()->findAll("pessoa = 'J' AND usuario_classificacoes_id != 3");
        //$usuarios = Usuarios::model()->findAll("email='thiago@quadraimoveis.com.br'");

        $cont = 0;

        foreach ($usuarios as $u) {

            $usuarios_emb = UsuariosEmbarcacoes::model()->with('embarcacoes')->findAll("usuarios_id=:usuarios_id and embarcacoes.status = 2", array(":usuarios_id" => $u->id));

            if (count($usuarios_emb) > 0) {

                $cont += 1;

                /*$emp = Empresas::model()->find("usuarios_id=:usuarios_id", array(":usuarios_id"=>$u->id));

                if($emp != null && $emp->macros_id != 3) {
                echo $emp->razao. " - ";
                }*/

                echo $u->email;
                echo '<br/>';
            }
        }

        echo "<br/>";
        echo "Total: " . $cont;
    }

    public function actionMarcasSemAnuncio()
    {

        $criteria = new CDbCriteria();
        $criteria->distinct = true;
        $criteria->select = 'slug, id';
        $criteria->order = "titulo asc";
        $marcas = EmbarcacaoFabricantes::model()->findAll($criteria);

        foreach ($marcas as $m) {
            $emb = Embarcacoes::model()->findAll("embarcacao_fabricantes_id = " . $m->id);
            if (count($emb) == 0) {
                echo "<br/>";
                echo $m->slug;
            }
        }

    }

} // fim classe
