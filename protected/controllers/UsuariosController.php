<?php

class UsuariosController extends GxController {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('view', 'create', 'redesocial', 'verificarEmail', 'verificarCpfOuCnpj', 'alterarSenhaEsqeceu', 'verificarCpf'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('update', 'updateNovo', 'updateIndoPelaEmbarc', 'alterarSenha', 'atualizarDadosPessoais', 'alterarLogo'),
                'users' => array('@'),
            ),
            array('allow',
                'actions' => array('index', 'delete', 'searchUser', 'searchUserPessoaJuridica', 'searchUserSemPlanos', 'searchUserSemPlanosDeEmpresa', 'backadmin'),
                'expression'=> function() {
                    if(Yii::app()->user->isAtendimento() || Yii::app()->user->isAdmin()) {
                        return true;
                    }
                    return false;
                }
            ),
            array('allow',
                'actions' => array('switchuser', 'admin', 'adminComercial'),
                'expression'=> function() {
                    if(Yii::app()->user->isComercial() || Yii::app()->user->isAdmin() || Yii::app()->user->isAtendimento()) {
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



    public function actionView($id) {
        $this->render('view', array(
            'model' => $this->loadModel($id, 'Usuarios'),
        ));
    }

    public function actionAlterarSenhaEsqeceu() {

        $token = Yii::app()->request->getParam('token');
        $id_usuario = Yii::app()->request->getParam('id_usuario');

        // carregar usuario baseado no id passado
        $model = $this->loadModel($id_usuario, 'Usuarios');

        if (isset($_POST['Usuarios'])) {

            $senhaNova = $_POST['Usuarios']['senha'];
            $senhaConfirmada = $_POST['Usuarios']['confirmaSenha'];
            $flgSenhasOK = true;

            if ($senhaNova == '' || $senhaConfirmada == '') {
                $model->addError('senha', 'Insira uma senha!');
                $flgSenhasOK = false;
            }

            if ($senhaNova != $senhaConfirmada) {
                $model->addError('senha', 'Senhas não batem!');
                $flgSenhasOK = false;
            }

            if ($flgSenhasOK) {

                // validar token e id de usuario
                if (UsuariosRecuperacaoSenha::model()
                                ->exists('usuarios_id=:usuarios_id AND token=:token', array(':usuarios_id' => $id_usuario, ':token' => $token))) {

                    // atualizar senha
                    $model->senha = CPasswordHelper::hashPassword($senhaNova, 4);
                    if ($model->save()) {

                        // logar usuario
                        $identity = new UserIdentity($model->email, $_POST['Usuarios']['senha']);
                        if ($identity->authenticate()) {
                            $user = Yii::app()->user;

                            // logar usuario e redirecionar para URL que gostaria de acessar antes de logar
                            $user->login($identity);
                            $this->redirect(Yii::app()->homeUrl);
                        }
                    } else {
                        $model->addError('senha', 'Erro ao alterar a senha!');
                    }
                }
            }
        }

        $this->render('alterar_senha', array(
            'model' => $model,
        ));
    }

    public function actionCreate() {

        if (!Yii::app()->user->isGuest) {
            $this->redirect(Yii::app()->homeUrl);
            exit;
        }

        // novo objeto de usuario
        $model = new Usuarios;

        // post com dados do usuario
        if (isset($_POST['Usuarios'])) {

            // atribuir atributos ao model de usuário
            $model->setAttributes($_POST['Usuarios']);

            // cookie
            $cookie_email = new CHttpCookie('email', $model->email);
            $cookie_email->expire = time()+60*60*24*365; 
            Yii::app()->request->cookies['email'] = $cookie_email;

            $cookie_telefone = new CHttpCookie('celular', $model->celular);
            $cookie_telefone->expire = time()+60*60*24*365; 
            Yii::app()->request->cookies['celular'] = $cookie_telefone;

            $cookie_nome = new CHttpCookie('nome', $model->nome);
            $cookie_nome->expire = time()+60*60*24*365; 
            Yii::app()->request->cookies['nome'] = $cookie_nome;

            $model->usuario_classificacoes_id = Anuncio::$_classificacoes_de_usuario['VENDEDOR'];

            if ($model->save()) {

                // enviar email para o usuário
              $message = new YiiMailMessage;
                  $message->view = "mail_boas_vindas";
                  $message->subject = 'Bem Vindo - BomBarco';
                  $message->setBody(array('nome'=>$model->nome), 'text/html');
                  $message->addTo($model->email);
                  $message->from = Yii::app()->params['bombarcoAtendimento'];

                  // enviar email
                  Yii::app()->mail->send($message);

                // checamos se quem cadastrou o usuario foi um admin, caso sim
                // não há necessidade de logar com o usuário recém cadastrado pois o admin já estará logado
                if (Yii::app()->user->isAdmin()) {
                    $this->redirect('/site/sucesso');
                    exit;
                }

                // logar usuário (COLOCAR ISSO AQUI, TALVEZ NO AFTER SAVE)
                $identity = new UserIdentity($model->email, $_POST['Usuarios']['senha']);
                if ($identity->authenticate()) {

                    // log
                    $log = new LogLogins;
                    $log->usuarios_id = Yii::app()->user->id;
                    $log->date = date('Y-m-d H:i:s');
                    $log->ip = $_SERVER["REMOTE_ADDR"];
                    $log->save();
                    $user = Yii::app()->user;

                    // logar usuario e redirecionar para URL que gostaria de acessar antes de logar
                    $user->login($identity);

                    if (Yii::app()->homeUrl == $user->returnUrl && Yii::app()->theme->name != 'mobile') {
                        // mimnha conta
                        if(isset($_GET["tabela_bb"])) {
                            $marca = Yii::app()->request->getParam("fabricante");
                            $modelo = $marca."-".Yii::app()->request->getParam("modelo");
                            $ano = Yii::app()->request->getParam("ano");

                            $this->redirect(array("tabela/".$marca."/".$modelo."/".$ano));

                            //$this->redirect(array("tabela", "marca"=>Yii::app()->request->getParam("fabricante"), "modelo" => Yii::app()->request->getParam("modelo"), "ano" => Yii::app()->request->getParam("ano")));
                        }
                        $this->redirect(array('usuarios/update', 'id' => Yii::app()->user->id));
                    } else {
                        $this->redirect(''.$user->returnUrl.'?createtrue');
                    }
                }
            }
        }


        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id) {

        $model = $this->loadModel($id, 'Usuarios');

        if ($model->id != Yii::app()->user->id && !Yii::app()->user->isAdmin()) {
            $this->redirect("/site/index");
            exit;
        }

        // ativos
        $criteria = new CDbCriteria();
        $criteria->with = array('planos');
        $criteria->condition = 'usuarios_id=:usuarios_id AND t.status = 2 AND (planos.flag = "anuncio_individual" OR planos.flag = "plano_embarcacao")';
        $criteria->params = array(':usuarios_id' => $id);
        $ativos = PlanoUsuarios::model()->findAll($criteria);

        // expirados
        $criteria = new CDbCriteria();
        $criteria->with = array('planos');
        $criteria->condition = 'usuarios_id=:usuarios_id AND t.status = 0 AND (planos.flag = "anuncio_individual" OR planos.flag = "plano_embarcacao")';
        $criteria->params = array(':usuarios_id' => Yii::app()->user->id);
        $expirados = PlanoUsuarios::model()->findAll($criteria);

        // se tiver 1 expirado que ja teve 1 renovacao, nao conta
        foreach($expirados as $index => $exp) {
            if(PlanosUsuariosRenovados::model()->find("plano_usuarios_id_atual=:plano_velho_id and status = :status", array(":plano_velho_id"=>$exp->id, ":status"=>Anuncio::$_status_plano["RENOVACAO_CONCLUIDA"]))) {
                unset($expirados[$index]);
            }
        }

        $this->render('update', array(
            'model' => $model,
            'ativos' => $ativos,
            'expirados' => $expirados
        ));


        /*Yii::app()->theme = "";

        $model = $this->loadModel($id, 'Usuarios');

        if ($model->id != Yii::app()->user->id && !Yii::app()->user->isAdmin()) {
            $this->redirect("/site/index");
            exit;
        }

        $this->render("/zeromilhas/perfil", array("model"=>$model));*/
    }

    public function actionUpdateNovo($id) {

        Yii::app()->theme = "";

        $model = $this->loadModel($id, 'Usuarios');

        if ($model->id != Yii::app()->user->id && !Yii::app()->user->isAdmin()) {
            $this->redirect("/site/index");
            exit;
        }

        $this->render("/zeromilhas/perfil", array("model"=>$model));
    }

    public function actionAtualizarDadosPessoais($id) {


        if (isset($_POST)) {

            $model = $this->loadModel($id, 'Usuarios');

            if ($model->id != Yii::app()->user->id && !Yii::app()->user->isAdmin()) {
                $this->redirect->homeUrl;
                exit;
            }

            $model->setAttributes($_POST['Usuarios']);
            $model->data_nascimento = Usuarios::formatDateTimeToDb($model->data_nascimento);

            if ($model->update()) {
                echo '1';
            } else {
                echo '-1';
            }
        }
    }

    public function actionAlterarLogo() {


        if (isset($_POST)) {

            $model = Usuarios::model()->findByPk(Yii::app()->user->id);

            // excluir logo
            if (isset($_POST['excluirlogo'])) {

                $model->logo = null;
                $model->update();
                exit;
            }


            // alterar/incluir
            else {
                $imagem = CUploadedFile::getInstanceByName('logo');

                $size = $imagem->size / 1024;

                if ($size > 1020) {

                    echo '-1';
                    exit;
                }

                if ($imagem->type != Anuncio::$_extensoes_permitidas['JPEG'] && $imagem->type != Anuncio::$_extensoes_permitidas['JPG'] && $imagem->type != Anuncio::$_extensoes_permitidas['PNG']) {
                    echo '-1';
                    exit;
                }


                $model->logo = Utils::genImageName($imagem);
                
                if ($model->update()) {
                    if ($imagem->saveAs(Yii::getPathOfAlias('webroot') . '/public/usuarios/' . $model->logo)) {

                        echo $model->logo;
                    } else {
                        echo '-1';
                    }
                } else {
                    echo '-1';
                }

                /* $imagem = CUploadedFile::getInstanceByName('logo');

                  $size = $imagem->size / 1024;

                  // se for mais que 1000 kb, informar erro
                  if($size > 1020 || $size < 100) {

                  echo '-1';
                  }

                  else {


                  $model->logo = Utils::genImageName($imagem);

                  if($model->update()) {
                  if ($imagem->saveAs(Yii::getPathOfAlias('webroot').'/public/usuarios/'.$model->logo)) {

                  echo $model->logo;
                  }

                  else {
                  echo '-1';
                  }
                  }

                  else {
                  echo '-1';
                  }


                  } */
            }
        }
    }

    public function actionDelete($id) {
        if (Yii::app()->getRequest()->getIsPostRequest()) {
            $this->loadModel($id, 'Usuarios')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionAlterarSenha($id) {

        if (isset($_POST)) {


            $model = $this->loadModel($id, 'Usuarios');



            $senhaNova = $_POST["senha"];
            $senhaConfirmada = $_POST["confirmaSenha"];
            $flgSenhasOK = true;

            if ($senhaNova == '' || $senhaConfirmada == '') {
                $model->addError('senha', 'Insira uma senha!');
                $flgSenhasOK = false;
            }

            if ($senhaNova != $senhaConfirmada) {
                $model->addError('senha', 'Senhas não batem!');
                $flgSenhasOK = false;
            }

            if ($flgSenhasOK) {
                $model->senha = CPasswordHelper::hashPassword($senhaNova, 4);
                if ($model->update(array("senha"))) {
                    //$this->redirect(Yii::app()->homeUrl);
                    //exit;
                    // ok
                    echo '1';
                } else {
                    //$model->addError('senha', 'Erro ao alterar a senha!');
                    echo '-1';
                }
            }
        }

        /* $this->render('alterar_senha', array(
          'model' => $model,
          )); */
    }

    // método executado via ajax que retorna true ou false
    // dependendo da existência do email passado
    public function actionVerificarEmail() {

        if (isset($_POST)) {

            $email = $_POST['email'];

            if (Usuarios::model()->exists('email = :email', array(':email' => $email))) {
                // existe usuario com o email passado
                echo '1';
            } else {
                // nao existe usuario com o email passado
                echo '-1';
            }
        }
    }

    public function actionVerificarCpf() {
        
                if (isset($_POST)) {
        
                    $email = $_POST['cpf'];
        
                    if (Usuarios::model()->exists('cpf = :cpf', array(':cpf' => $cpf))) {
                        // existe usuario com o email passado
                        echo '1';
                    } else {
                        // nao existe usuario com o email passado
                        echo '-1';
                    }
                }
            }

    public function actionIndex() {
        $dataProvider = new CActiveDataProvider('Usuarios');
        $this->render('index', array(
            'dataProvider' => $dataProvider,
        ));
    }

    public function actionAdmin() {
        $model = new Usuarios('search');
        $model->unsetAttributes();

        if (isset($_GET['Usuarios']))
            $model->setAttributes($_GET['Usuarios']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }


    public function actionAdminComercial() {
        $model = new Usuarios('search');
        $model->unsetAttributes();

        if (isset($_GET['Usuarios']))
            $model->setAttributes($_GET['Usuarios']);

        $this->render('admin_comercial', array(
            'model' => $model,
        ));
    }

    // Método para o usuário se cadastrar usando nome e email
    // do google plus ou facebook (executado via ajax)
    public function actionRedesocial() {

        // verificar se houve POSTs
        if (isset($_POST['email'])) {

            // novo objeto usuarios
            $model = new Usuarios;

            // obter dados do post
            $email = $_POST['email'];
            $nome = $_POST['nome'];
            $idFbOuGooglePlus = $_POST['id'];
            $redeSocial = $_POST['redeSocial'];


            // verificar se usuário já existe
            $record = Usuarios::model()->findByAttributes(array('email' => $email));

            // usuário não existe
            if ($record == null) {

                // setar atributos do usuario
                $model->pessoa = Anuncio::$_pessoa['FISICA'];
                $model->usuario_classificacoes_id = Anuncio::$_classificacoes_de_usuario['VENDEDOR'];
                $model->nome = $nome;
                $model->email = $email;
                // encriptar senha do usuario passando a dificuldade 4
                $model->senha = CPasswordHelper::hashPassword($idFbOuGooglePlus, 4);

                // verificar se foi pelo facebook ou googleplus
                if ($redeSocial == 'googleplus')
                    $model->googleplus = $idFbOuGooglePlus;
                else
                    $model->facebook = $idFbOuGooglePlus;

                // salvar
                try {
                    $model->save();
                } catch (Exception $e) {
                    $this->redirect('site/error');
                }


                // logar usuário
                $identity = new UserIdentity($email, $idFbOuGooglePlus);

                if ($identity->authenticate(Anuncio::$_tipo_de_login['REDE_SOCIAL'])) {
                    $user = Yii::app()->user;
                    $user->login($identity);
                    echo $user->returnUrl;
                }
            }

            // email já existe, o que indica que o usuário já havia se cadastrado, mas dessa vez resolveu utilizar sua
            // rede social para logar.
            else {
                // vamos atualizar seu campo de googleplus ou facebook, inserindo o ID da rede social
                // em questão
                if ($record->facebook == null || $record->googleplus == null) {

                    if ($redeSocial == 'googleplus')
                        $record->googleplus = $idFbOuGooglePlus;
                    else
                        $record->facebook = $idFbOuGooglePlus;
                    // update
                    try {
                        $record->update();
                    } catch (Exception $e) {
                        $this->redirect('site/error');
                    }
                }

                // logar usuário passando no método authenticate algum valor.. para indicar que logou via rede social (a senha então não importa)
                $identity = new UserIdentity($email, '');
                if ($identity->authenticate(Anuncio::$_tipo_de_login['REDE_SOCIAL'])) {
                    $user = Yii::app()->user;
                    $user->login($identity);
                    echo $user->returnUrl;
                }
            } // else - email já existe
        } // post
    }

    /**
     * Retorna um dataList com users
     * Atualiza o DropDown para evitar que um user seja cadastrado mais de uma vez
     * @param  [type] $data_users [model ou array com os users]
     * @return [type]             [CHtml::listData]
     */
    public function actionSearchUser($term) {

        $users_criteria = new CDbCriteria();
        $users_criteria->with = 'planoUsuarioses';
        $users_criteria->addSearchCondition("nome", $term, true, "OR");
        $users_criteria->addSearchCondition("email", $term, true);

        $query = Usuarios::model()->findAll($users_criteria);

        $list = array();
        foreach ($query as $q) {
            $data['value'] = $q['id'];
            $data['label'] = $q['nome'] . ' - ' . $q['email'];
            $list[] = $data;
            unset($data);
        }

        echo json_encode($list);
    }

    /**
     * Retorna um dataList com users do tipo pessoa juridica
     * Atualiza o DropDown para evitar que um user seja cadastrado mais de uma vez
     * @param  [type] $data_users [model ou array com os users]
     * @return [type]             [CHtml::listData]
     */
    public function actionSearchUserPessoaJuridica($term) {

        $users_criteria = new CDbCriteria();
        $users_criteria->addSearchCondition("email", $term, true);
        $users_criteria->addSearchCondition("pessoa", "J", true);

        $query = Usuarios::model()->findAll($users_criteria);

        $list = array();
        foreach ($query as $q) {
            $data['value'] = $q['id'];
            $data['label'] = $q['email'];
            $list[] = $data;
            unset($data);
        }

        echo json_encode($list);
    }

    /**
     * Retorna um dataList com users
     * Atualiza o DropDown para evitar que um user seja cadastrado mais de uma vez
     * @param  [type] $data_users [model ou array com os users]
     * @return [type]             [CHtml::listData]
     */
    public function actionSearchUserSemPlanos($term) {

        $users_criteria = new CDbCriteria();
        $users_criteria->addSearchCondition("nome", $term, true, "OR");
        $users_criteria->addSearchCondition("email", $term, true);

        $query = Usuarios::model()->findAll($users_criteria);

        $list = array();
        foreach ($query as $q) {
            $data['value'] = $q['id'];
            $data['label'] = $q['nome'] . ' - ' . $q['email'];
            $list[] = $data;
            unset($data);
        }

        echo json_encode($list);
    }

    /**
     * Retorna um dataList com users
     * Atualiza o DropDown para evitar que um user seja cadastrado mais de uma vez
     * @param  [type] $data_users [model ou array com os users]
     * @return [type]             [CHtml::listData]
     */
    public function actionSearchUserSemPlanosDeEmpresa($term) {

        $users_criteria = new CDbCriteria();
        $users_criteria->addSearchCondition("nome", $term, true, "OR");
        $users_criteria->addSearchCondition("email", $term, true);
        $users_criteria->addSearchCondition("usuario_classificacoes_id", 1, true);

        $query = Usuarios::model()->findAll($users_criteria);

        $list = array();
        foreach ($query as $q) {
            $data['value'] = $q['id'];
            $data['label'] = $q['nome'] . ' - ' . $q['email'];
            $list[] = $data;
            unset($data);
        }

        echo json_encode($list);
    }

    /**
     * Action que altera a session do user logado
     * @return [type] [description]
     */
     public function actionSwitchUser($id) {

         $identity = new UserIdentity(null, null);
         $identity->switchUser($id);
         Yii::app()->user->login($identity);

         $this->redirect(array('usuarios/update', 'id' => $id));
         //$this->redirect(Yii::app()->request->urlReferrer);
     }

    /**
     * Action que retorna a conta para o Admin
     * @return [type] [description]
     */
    public function actionBackAdmin() {

        if (Yii::app()->user->isAdmin()) {

            $identity = new UserIdentity(null, null);
            $identity->switchUser(Yii::app()->user->getState('admin_id'));
            Yii::app()->user->login($identity);
        }

        $this->redirect(Yii::app()->request->urlReferrer);
    }

    public function actionVerificarCpfOuCnpj() {

        $cpfcnpj = $_POST["cpfcnpj"];
        $tipopessoa = $_POST["tipopessoa"];

        // cpf
        if($tipopessoa == "F") {

            $existe = Usuarios::model()->find("cpf=:cpf", array(":cpf"=>$cpfcnpj));
        }

        // cnpj
        else {

            $existe = Usuarios::model()->find("cnpj=:cnpj", array(":cnpj"=>$cpfcnpj));
        }

        // 0 => n existe
        // 1 => existe
        if($existe == null) {
            echo "0";
        }
        else {
            echo "1";
        }

    }

    public function actionUpdateIndoPelaEmbarc($id) {

        $model = Usuarios::buscarDonoEmbarc($id);

        // ativos
        $criteria = new CDbCriteria();
        $criteria->with = array('planos');
        $criteria->condition = 'usuarios_id=:usuarios_id AND t.status = 2 AND (planos.flag = "anuncio_individual" OR planos.flag = "plano_embarcacao")';
        $criteria->params = array(':usuarios_id' => $id);
        $ativos = PlanoUsuarios::model()->findAll($criteria);

        // expirados
        $criteria = new CDbCriteria();
        $criteria->with = array('planos');
        $criteria->condition = 'usuarios_id=:usuarios_id AND t.status = 0 AND (planos.flag = "anuncio_individual" OR planos.flag = "plano_embarcacao")';
        $criteria->params = array(':usuarios_id' => Yii::app()->user->id);
        $expirados = PlanoUsuarios::model()->findAll($criteria);

        // se tiver 1 expirado que ja teve 1 renovacao, nao conta
        foreach($expirados as $index => $exp) {
            if(PlanosUsuariosRenovados::model()->find("plano_usuarios_id_atual=:plano_velho_id and status = :status", array(":plano_velho_id"=>$exp->id, ":status"=>Anuncio::$_status_plano["RENOVACAO_CONCLUIDA"]))) {
                unset($expirados[$index]);
            }
        }


        $this->render('update2', array(
            'model' => $model,
            'ativos' => $ativos,
            'expirados' => $expirados
        ));

    }

}

// fim do controller
