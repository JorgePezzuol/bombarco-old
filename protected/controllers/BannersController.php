<?php

class BannersController extends GxController {

    public function filters() {
        return array(
                'accessControl',
                );
    }

    public function accessRules() {
        return array(
                array('allow',
                    'actions'=>array('contato', 'contabilizarClique', 'contabilizarView'),
                    'users'=>array('*'),
                    ),
                array('allow',
                    'actions'=>array('admin','delete','minicreate','create','update','changeStatus', 'validarImagem', 'view'),
                                                    'expression'=> function() {
                    if(Yii::app()->user->isAtendimento() || Yii::app()->user->isAdmin()) {
                        return true;
                    }
                    return false;
                }
                    ),
                array('deny',
                    'users'=>array('*'),
                    ),
                );
    }

    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Banners'),
        ));
    }

    /**
     * Função para contabilizar o clique do banner em questão
     */
    public function actionContabilizarClique() {

        if(!Yii::app()->user->isAdmin()) {

            $c = new BannersClicks();
            if(!Yii::app()->user->isGuest) {
                $c->usuarios_id = Yii::app()->user->id;
            }
            $c->ip = $_SERVER['REMOTE_ADDR'];
            $c->banners_id = Yii::app()->request->getPost("banner_id");

            if($c->save()) {
                echo "1";
            }
            else {
                echo "-1";
            }    
        }
        
    }

    /**
     * Função para contabilizar as views do banner em questão
     */
    public function actionContabilizarView() {

        if(!Yii::app()->user->isAdmin()) {

            $v = new BannersViews();
            if(!Yii::app()->user->isGuest) {
                $v->usuarios_id = Yii::app()->user->id;
            }
            $v->ip = $_SERVER['REMOTE_ADDR'];
            $v->banners_id = Yii::app()->request->getPost("banner_id");

            if($v->save()) {
                echo "1";
            }
            else {
                echo "-1";
            }
        }
        
    }

    public function actionContato() {

        // setar dados de contato
        $contato = new Contatos;
        $contato->nome_rem = $_POST["nome"];
        $contato->email_rem = $_POST["email"];
        $contato->telefone_rem = $_POST["telefone"];
        $contato->data = date('Y-m-d H:i:s');
        $contato->email_dest = 'atendimento@bombarco.com.br';
        $contato->tipo = 'B';

        // salvar e enviar email
        if($contato->save()) {

            // enviar email para admin a respeito do banner
            $message = new YiiMailMessage;
            $message->view = "mail_banner_admin";
            $message->subject = 'Solicitação de Banner';
            $message->setBody(array('email'=>$_POST['email'], 'nome'=> $_POST["nome"], 'telefone'=> $_POST['telefone'], 'nomeEmpresa'=>$_POST['nome_empresa']), 'text/html');
            $message->addTo(Yii::app()->params['bombarcoAtendimento']);
            $message->from = $_POST['email'];
            //$message->from = Yii::app()->params['bombarcoAtendimento'];

            // envia msg
            if(!Yii::app()->mail->send($message)) {

                // erro
                echo '-1';
            }

            // msg enviada ok
            else {
                echo '1';
            }
        }


        // erro ao salvar o contato
        else {
            echo '-1';
        }


    }

    public function actionCreate() {

        $model = new Banners;
        $usuario = new Usuarios;

        // indica se vai salvar ou não
        $flgOk = true;
        $flgCadastrouNovoUsuario = false;
        $flg_cadastro = false;

        if(isset($_POST['Banners'])) {

            /*if(isset($_POST['check-novo-usuario'])) {
                    $usuario->setAttributes($_POST['Usuarios']);
                $usuario->usuario_classificacoes_id = Macros::$macro_by_slug['empresa'];
                $usuario->pessoa = 'J';
                $usuario->telefone = '0000-0000';
                $usuario->celular = '00000-0000';
                // salvar usuario
                if(!$usuario->save()) {
                    $flgOk = false;
                }

                $flgCadastrouNovoUsuario = true;
            }*/

            $model->setAttributes($_POST['Banners']);
            $model->usuarios_id = 3578;

            $file_imagem = CUploadedFile::getInstance($model,'imagem');
            $file_imagem_topo = CUploadedFile::getInstance($model,'imagem_topo');

            $flgImagem = false;         // indica deu upload na imagem
            $flgImagemTopo = false;     // indica deu upload na imagem expansiva

            if($file_imagem != null) {

                $model->imagem = $file_imagem;
                $flgImagem = true;
            }

            if($file_imagem_topo != null && $model->local == Banners::TOPO) {

                $model->imagem_topo = $file_imagem_topo;
                $flgImagemTopo = true;
            }

            // optou pelo banner expansivo
            if($flgImagem && $flgImagemTopo) {

                if(!$model->imagem_topo->saveAs(Yii::getPathOfAlias('webroot').'/public/banners/'.$model->imagem_topo)) {
                    $model->addError('imagem_topo', 'Erro ao salvar a imagem expansiva');
                    $flgOk = false;
                }

                if(!$model->imagem->saveAs(Yii::getPathOfAlias('webroot').'/public/banners/'.$model->imagem)) {
                    $model->addError('imagem_topo', 'Erro ao salvar a imagem');
                    $flgOk = false;
                }
            }

            // algum outro banner
            if($flgImagem && !$flgImagemTopo) {

                if(!$model->imagem->saveAs(Yii::getPathOfAlias('webroot').'/public/banners/'.$model->imagem)) {
                    $model->addError('imagem_topo', 'Erro ao salvar a imagem');
                    $flgOk = false;
                }
            }

            // atrelar banner ao usuario
            /*if($flgCadastrouNovoUsuario) {
                $model->usuarios_id = $usuario->primaryKey;
            }*/

            if($flgOk && $model->save()) {
                //$this->redirect(array('view', 'id' => $model->id));
                $flg_cadastro = true;
                //exit;
            }

            else {

                $model->addError('imagem', 'Ocorreu um erro crítico. Tente mais tarde.');
            }
            

            $model->unsetAttributes();

        }


        

        $this->render('create', array('model'=>$model, 'flg_cadastro' => $flg_cadastro));
    }

    public function actionUpdate($id) {
        $model = $this->loadModel($id, 'Banners');

        $flg_update = false;

        if (isset($_POST['Banners'])) {
            $model->setAttributes($_POST['Banners']);

            // testar se alterou imagem
            if(CUploadedFile::getInstance($model,'imagem') != null) {

                // obter nova imagem
                $model->imagem = CUploadedFile::getInstance($model,'imagem');

                // salvar nova imagem no banco
                if(!$model->imagem->saveAs(Yii::getPathOfAlias('webroot').'/public/banners/'.$model->imagem)) {
                    $model->addError('imagem', 'Erro ao salvar a imagem fechada');
                }
            }

            // testar se alterou imagem
            if(CUploadedFile::getInstance($model,'imagem_topo') != null) {

                // obter nova imagem
                $model->imagem_topo = CUploadedFile::getInstance($model,'imagem_topo');

                // salvar nova imagem no banco
                if(!$model->imagem_topo->saveAs(Yii::getPathOfAlias('webroot').'/public/banners/'.$model->imagem_topo)) {
                    $model->addError('imagem_topo', 'Erro ao salvar a imagem expansiva');
                }
            }


            // update
            $model->fim = Banners::formatDateTimeToDb($model->fim);
            if ($model->update()) {
                $flg_update = true;
                //$this->redirect(array('view', 'id' => $model->id));
            }
        }

        

        $this->render('update', array(
                'model' => $model,
                'flg_update' => $flg_update
                ));
    }

    public function actionDelete($id) {

        $model = Banners::model()->findByPk($id);
        $model->status = 3;

        if($model->update()) {
            echo "1";
        }
        else {
            echo "-1";
        }
    }

    public function actionAdmin() {
        $model = new Banners('search');

        $model->unsetAttributes();

        if (isset($_GET['Banners']))
            $model->setAttributes($_GET['Banners']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    // método executado via ajax que serve para validar as dimensoes e tamanho de
  	// imagens de banners
  	// retorna -1 caso a validação falhe
  	public function actionValidarImagem() {

  		if(isset($_POST)) {



  			// guarda o retorno dos metodos de validação
  			$resp = 1;

  			$local = $_POST['local'];

  			// banner expansivo
  			if($local == Banners::TOPO) {

  				// imagem do banner fechado -> 1
  				// imagem do banner aberto -> 2
  				$abertoFechado = $_POST['abertoFechado'];

  				$resp = Banners::validarImagemDeBannerExpansivo(CUploadedFile::getInstanceByName('imagem'), $abertoFechado);
  			}

  			// não é o banner expansivo
  			else {

  				$resp = Banners::validarImagemDeBanner(CUploadedFile::getInstanceByName('imagem'), $local);

  			}

  			// resposta ajax
  			echo $resp;
  		}
  	}


            /**
     * Action que altera o Status
     * Se estiver Ativado, desativa
     * Se estiver Desativado, ativa
     * @param  [type] $id [ID do Modelo]
     * @return [type]     [description]
     */
    public function actionChangeStatus($id) {

        $model = Banners::model()->findByPk($id);

        if ($model->status == 0) {
            $model->status = 1;
        } else if ($model->status == 1) {
            $model->status = 0;
        }

        if($model->update()) {
            echo "1";
        }

    }
}
