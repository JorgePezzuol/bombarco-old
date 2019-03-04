<?php

class PlanoUsuariosController extends GxController {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('emailPlanoGratis', 'view', 'AJAXCreate', 'AJAXUpdate', 'ajaxPlanoMotor'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('minicreate', 'verificarSePossuiPlanoGrats', 'create', 'update', 'renovarPlano', 'retornarPlanoIndividual', 'upgradePlano', 'retornarPlanoPorLimitePreco', 'retornarPlanoPorDuracaoMeses'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('admin', 'delete'),
                                                'expression'=> function() {
                    if(Yii::app()->user->isAtendimento() || Yii::app()->user->isAdmin()) {
                        return true;
                    }
                    return false;
                }
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionAjaxPlanoMotor() {

        if(isset($_POST)) {

            $duracaomeses = $_POST["duracaomeses"];
            $limitepreco = $_POST["limitepreco"];

            $plano = Planos::model()
                ->find("duracaomeses = :duracaomeses AND limitepreco = :limitepreco AND flag = :flag AND status = 1",
                    array(":duracaomeses" => $duracaomeses, ":limitepreco" => $limitepreco, ":flag" => "anuncio_motor"));

            if($plano != null) {
                echo CJSON::encode($plano);    
            }
            else {
                echo "0";
            }
        }
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'PlanoUsuarios'),
        ));
    }

    // 1 => ja tem plano grats
    // 0 => ñ tem
    public function actionVerificarSePossuiPlanoGrats() {

        if(PlanoUsuarios::verificarSePossuiPlanoGrats($_POST["usuarios_id"])) {
            echo "1";
        }
        else {
            echo "0";
        }
    }

    /* retorna o plano individual baseado na duracao de meses e valor permitido da embarc */

    public function actionRetornarPlanoIndividual() {

        if (isset($_POST)) {

            $meses = $_POST['meses'];
            $valor = $_POST['valor'];

            echo CJSON::encode(Planos::model()->find('duracaomeses=:meses and limitepreco=:limite', array(':meses' => $meses, ':limite' => $valor)));
        }
    }

    /* retorna o plano baseado na qntpermitida e duracaomeses */

    public function actionRetornarPlanoPorLimitePreco() {

        if (isset($_POST)) {

            $qntpermitida = $_POST['qntpermitida'];
            $limitepreco = $_POST['limitepreco'];


            if ($qntpermitida == "" && $limitepreco == "") {
                $planos = Planos::model()->findByPk(26);
            } else {

                if ($limitepreco != "") {
                    $planos = Planos::model()->findAll('flag <> "plano_estaleiro" and qntpermitida=:qntpermitida and limitepreco =:limitepreco and status = 1', array(':qntpermitida' => $qntpermitida, ':limitepreco' => $limitepreco));
                } else {
                    $planos = Planos::model()->findAll('qntpermitida=:qntpermitida', array(':qntpermitida' => $qntpermitida));
                }
            }





            echo CJSON::encode($planos);
        }
    }

    public function actionRetornarPlanoPorDuracaoMeses() {

        if (isset($_POST)) {

            $qntpermitida = $_POST['qntpermitida'];
            $duracaomeses = $_POST['duracaomeses'];

            $planos = Planos::model()->find('flag <> "plano_estaleiro" and qntpermitida=:qntpermitida and duracaomeses =:duracaomeses', array(':qntpermitida' => $qntpermitida, ':duracaomeses' => $duracaomeses));


            echo CJSON::encode($planos);
        }
    }

    /**
     * [actionRenovarPlano renova o plano do usuário
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionRenovarPlano($id_plano_usuarios_atual, $id_plano_renovado) {

        // Plano Atual
        $planoUsuario = PlanoUsuarios::model()->findByPk($id_plano_usuarios_atual);

        if (PlanoUsuarios::renovarPlano($id_plano_usuarios_atual, $id_plano_renovado)) {

            $plano = Planos::model()->findByPk($id_plano_renovado);

            // se a renovação foi ok, vamos redirecionar para a tela de pagamento
            //$planoAtual = Usuarios::getPlanoCorrenteAnuncio();

            $ordens = Usuarios::getOrdens();
            // renderizar para pag de pagamento
            $this->redirect(array('anuncios/anuncioPagamento?minha_conta=1',
                'somaordens' => Usuarios::somarOrdens(),
                'ordens' => $ordens));
        }
    }

    /**
     * [actionUpgradePlano] direciona para a página para escolher um novo plano
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function actionUpgradePlano($id) {

        // obter a quantidade de anuncios do plano atual para poder
        // comparar aos outros planos e decidir quais planos renderizar na view
        // (somente planos com qtdepermitida maior que a do plano atual)
        $plano = PlanoUsuarios::model()->findByPk($id);

        if ($plano->usuarios->id != Yii::app()->user->id) {
            $this->redirect(Yii::app()->homeUrl);
        }

        $id_plano_usuarios_atual = $plano->id;

        $qntpermitida = 0;
        if ($plano != null) {
            $qntpermitida = $plano->qntpermitida;
        }

        // renderizar pagina com planos
        /*$this->render('planos', array('qntpermitida' => $qntpermitida, 'limitepreco' => $plano->planos->limitepreco,
            'id_plano_usuarios_atual' => $id_plano_usuarios_atual));*/
        $this->render('planos', array('flag'=>$plano->planos->flag,'id_plano_usuarios_atual' => $id_plano_usuarios_atual));

    }



    /**
     * AJAX para CADASTAR planos
     * @return [type] [description]
     */
    public function actionAJAXCreate() {

        $res = array(
            'success' => 1,
            'error' => 0,
            'message' => 'Plano cadastrado com sucesso!'
        );

        try {

            $model = new PlanoUsuarios;

            if (!isset($_POST['PlanoUsuarios']))
                 throw new Exception("Preencha o formulário", 1);
            if(empty($_POST['PlanoUsuarios']['qntpermitida'])){
              $_POST['PlanoUsuarios']['qntpermitida'] = 0;
            }

            $model->setAttributes($_POST['PlanoUsuarios']);

            //$model->inicio = Yii::app()->dateFormatter->formatDateTime($model->inicio);
            //$model->fim = date('Y-m-d H:i:s', strtotime($model->fim));
            #$model->save();
            if (!$model->save())
                throw new Exception(CHtml::errorSummary($model), 2);

            // Se o plano é do tipo Empresa/Estaleiro
            if ($model->planos->macros_id == 2 || $model->planos->macros_id == 3) {

                // Empresas/Estaleiros deste usuário
                $empresa = Empresas::model()->findAllByAttributes(array('usuarios_id'=>$model->usuarios_id));
                foreach ($empresa as $key => $value) {

                    // Se a empresa não tem plano vinculado
                    if (empty($value->plano_usuarios_id))
                        $value->saveAttributes(array('plano_usuarios_id'=>$model->id));

                }
            }

        } catch (Exception $e) {
            $res['success'] = 0;
            $res['error'] = $e->getError();
            $res['message'] = $e->getMessage();
        }

        echo json_encode($res);
        Yii::app()->end();
    }



    /**
     * AJAX para EDITAR planos
     * @return [type] [description]
     */
    public function actionAJAXUpdate($id) {

        $res = array(
            'success' => 1,
            'error' => 0,
            'message' => 'Plano editado com sucesso!'
        );

        try {

            $model = $this->loadModel($id, 'PlanoUsuarios');

            // Se o plano é do tipo Empresa/Estaleiro
            if ($model->planos->macros_id == 2 || $model->planos->macros_id == 3) {

                // Empresas/Estaleiros deste usuário
                $empresa = Empresas::model()->findAllByAttributes(array('usuarios_id'=>$model->usuarios_id));
                foreach ($empresa as $key => $value) {

                    // Se a empresa não tem plano vinculado
                    if (empty($value->plano_usuarios_id))
                        $value->saveAttributes(array('plano_usuarios_id'=>$id));

                }
            }

            if (!isset($_POST['PlanoUsuarios']))
                throw new Exception("Preencha o formulário", 1);

            $model->setAttributes($_POST['PlanoUsuarios']);

            //$model->inicio = date('Y-m-d', strtotime($model->inicio));
            //$model->fim = date('Y-m-d', strtotime($model->fim));

            // pediram pra tirar, aqui o certo era expirar o plano, expira todos os barcos, e vice versa..
            // mas pediram pra tirar, vai entender

            if ($model->update()) {
                if($model->status == Anuncio::$_status_plano['PAGO']) {

                    //Embarcacoes::model()->updateAll(array( 'status' => Anuncio::$_status_anuncio["ANUNCIO_PAGO"] ), 'plano_usuarios_id=:id', array(":id"=>$model->id));
                    $ordem = Ordens::model()->find("id_item=:id_item", array(":id_item"=>$model->id));
                    $ordem->status = Anuncio::$_status_ordem['PAGA'];
                    $ordem->update();

                }
                elseif($model->status == Anuncio::$_status_plano['FINALIZADO']) {

                    //Embarcacoes::model()->updateAll(array( 'status' => Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"] ), 'plano_usuarios_id=:id', array(":id"=>$model->id));
                }
                else {
                    //Embarcacoes::model()->updateAll(array( 'status' => Anuncio::$_status_anuncio["ANUNCIO_CRIADO"] ), 'plano_usuarios_id=:id', array(":id"=>$model->id));
                }
            }
                

        } catch (Exception $e) {

            $res['success'] = 0;
            //$res['error'] = $e->getError();
            $res['message'] = $e->getMessage();
        }

        echo json_encode($res);
        Yii::app()->end();
    }


    public function actionCreate() {
        $model = new PlanoUsuarios;


        if (isset($_POST['PlanoUsuarios'])) {
            $model->setAttributes($_POST['PlanoUsuarios']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest())
                    Yii::app()->end();
                else
                    $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'PlanoUsuarios');


        if (isset($_POST['PlanoUsuarios'])) {
            $model->setAttributes($_POST['PlanoUsuarios']);

            if ($model->save()) {
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $this->render('update', array(
            'model' => $model,
        ));
    }

    public function actionDelete($id) {
        $plano = PlanoUsuarios::model()->findByPk($id);
        $plano->status = 5;
        $plano->update();
    }

    public function actionAdmin() {
        $model = new PlanoUsuarios('search');
        $model->unsetAttributes();

        if (isset($_GET['PlanoUsuarios']))
            $model->setAttributes($_GET['PlanoUsuarios']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    // http://www.getcron.com/
    public function actionEmailPlanoGratis() {

        $planos_gratis = PlanoUsuarios::getPlanosGratis();

        // verifica se deu 7 dias e envia email
        PlanoUsuarios::emailPlanoGratisSeteDias($planos_gratis);

        // a partir daqui verificamos se deu 2 meses ou 3
        $params = array();
        $hoje = date("Y-m-d");

        // meses (2, 3, 4, etc)
        $meses = $_GET["meses"];

        foreach($planos_gratis as $plano_gratis) {

            // para cada plano gratis, vamos consultar a tabela de envio de emails de planos gratis
            $criteria = new CDbCriteria();
            $criteria->condition  = "plano_usuarios_id=:id AND tipo_envio=:tipo";
            $criteria->order = "id DESC";
            $criteria->limit = 1;
            $criteria->params[":id"] = $plano_gratis["plano_usuarios_id"];
            $criteria->params[":tipo"] = $meses. " meses";

            // objeto do tipo envia email plano gratis
            $obj = EnvioEmailsPlanoGratis::model()->find($criteria);

            $month = "+".$meses." month";

            // verificar se tem registro na tabela de envio de emails
            if($obj != null) {

                $ultimo_envio = $obj->data_envio;

                // ver se ja deu x meses apos o ultimo envio
                $data = date("Y-m-d", strtotime($month, strtotime($ultimo_envio)));
                
            }

            // nao tem registro na tabela de envio de emails, entao usar a data de ativação do plano
            else {

                $data = date("Y-m-d", strtotime($month, strtotime($plano_gratis["dias"])));
            }


            // deu x meses
            if($data == $hoje) {

                $embarc = Embarcacoes::buscarEmbarcPeloPlano($plano_gratis["plano_usuarios_id"]);

                if($embarc->status == 2) {

                    $nome_usuario = $plano_gratis["nome"];
                    $email_usuario = $plano_gratis["email"];

                    if($meses == 2) {
                        $view = "mail_plano_gratuito_deu_sete_dias";
                        $subject = 'BomBarco - Quanto mais completo seu anúncio for, mais negócios podem aparecer';
                    }
                    elseif($meses == 3) {
                        $view = "mail_plano_gratuito_deu_3_meses";
                        $subject = 'BomBarco - Você ja vendeu sua embarcação?';
                    }
                    else {

                    }

                    // enviar email
                    $message = new YiiMailMessage;
                    $message->view = $view;
                    $message->subject = $subject;
                    $message->setBody(array('nome_usuario' => $nome_usuario, 'id_embarcacao' => $embarc->id), 'text/html');
                    $message->addTo($email_usuario);
                    $message->from = Yii::app()->params['bombarcoAtendimento'];

                    $envio_email = new EnvioEmailsPlanoGratis();
                    $envio_email->plano_usuarios_id = $plano_gratis["plano_usuarios_id"];
                    $envio_email->data_envio = date("Y-m-d");
                    $envio_email->tipo_envio = $meses." meses";

                    if($envio_email->save()) {
                        Yii::app()->mail->send($message);
                    }
                }
            }  
        } // foreach

        echo "1";
    }

    
    // fim cronjob

}
