<?php

class ContatosController extends GxController {

    public function filters() {
        return array(
            'accessControl',
        );
    }

    public function accessRules() {
        return array(
            array('allow',
                'actions' => array('mailAnunciante', 'contatoBombarco', 'marcarComoLida', 'contatoAgenda', 'contatoEmpresa', 'contatoEmpresaResposta', 'contatoTabelaBombarcoBusca', 'contatoTabelaBombarcoNaoEncontrou', 'partners', 'partner'),
                'users' => array('*'),
            ),
            array('allow',
                'actions' => array('excluirMsgs2', 'minicreate', 'mensagensVelhas', 'view', 'create', 'update', 'mensagens', 'delete', 'alterarStatusVariasMsgs', 'deletarMsgs', 'responder'),
                'users' => array('@'),
            ),
            array('deny',
                'users' => array('*'),
            ),
        );
    }

    public function actionExcluirMsgs2() {

        if(isset($_POST['ids'])) {

            $ids = explode("|", $_POST["ids"]);

            foreach($ids as $id) {

                $msg = Contatos::model()->findByPk($id);

                if(Contatos::model()->updateByPk($id, array("status" => 3)) == 0
                    || $msg->email_dest != Usuarios::getUsuarioLogado()->email) {
                    echo 0; 
                    exit;
                }
            }

            echo 1;
            exit;
        }

        echo 0;
    }


    public function actionResponder() {


        if(isset($_POST)) {
            
            $c = Contatos::model()->findByPk($_POST["id"]);

            $contato = new Contatos();
            $contato->mensagem = $_POST["msg"];
            $contato->motor_anuncio_id = $c->motor_anuncio_id;
            $contato->embarcacoes_id = $c->embarcacoes_id;
            $contato->email_rem = $c->email_dest;
            $contato->email_dest = $c->email_rem;
            $contato->nome_rem = Usuarios::getUsuarioLogado()->nome;
            $contato->telefone_rem = Usuarios::getUsuarioLogado()->celular;
            $contato->status = 0;
            $contato->data = date('Y-m-d H:i:s');

            if($contato->save()) {

                $c->status = 1;
                $c->update();
                
                if($contato->motor_anuncio_id != null) {

                    $anuncio = MotorAnuncio::model()->findByPk($contato->motor_anuncio_id);
                    $nome_anuncio = MotorAnuncio::nomeAnuncio($anuncio);    
                    $link = MotorAnuncio::gerarLinkAbsoluto($anuncio);
                    $nome = Usuarios::model()->findByPk($anuncio->usuarios_id)->nome;
                }
                else {
                    $anuncio = Embarcacoes::model()->findByPk($contato->embarcacoes_id);
                    $nome_anuncio = Embarcacoes::getAlt($anuncio);
                    $link = Embarcacoes::mountAbsoluteUrl($anuncio);
                    $nome = Usuarios::buscarDonoEmbarc($contato->embarcacoes_id)->nome;
                }

                $parser = new CHtmlPurifier();

                $message = new YiiMailMessage;
                //$message->addTo("jorge_pezzuol@hotmail.com");
                $message->addTo($contato->email_dest);
                $message->view = "contato_motor";
                $message->subject = 'Contato - ' . $nome_anuncio;
                $message->addBcc("bombarcoadm@gmail.com");
                $message->addBcc("atendimento@bombarco.com.br");
                $message->from = Yii::app()->params['bombarcoAtendimento'];
                $message->setReplyTo($parser->purify($contato->email_rem));

                $message->setBody(
                    array(
                        'nome_destinatario' => $nome,
                        'nome_rem' => $contato->nome_rem,
                        'email_rem' => $contato->email_rem,
                        'mensagem' => $contato->mensagem,
                        'id_contato' => $contato->id,
                        'telefone' => $contato->telefone_rem,
                        'anuncio' => $nome_anuncio,
                        'link' => $link
                    ),
                    'text/html'
                );

                if (Yii::app()->mail->send($message)) {
                    echo '1';
                    
                }
                else {
                    echo '0';
                }
            }
            else {
                echo '0';
            }
        }


        exit;


    }

    /*public function actionMensagens() {

        $model = new Contatos('search');
        $model->unsetAttributes();

        if(isset($_GET["filtro"])) {
            if($_GET["filtro"] == 0) {
                $model->status = 0;
            }
        }

        if (isset($_GET['Contatos'])) {
            $model->setAttributes($_GET['Contatos']);

        }

        $this->render('admin', array(
            'model' => $model,
        ));
        
    }*/

    public function actionMensagens() {

        Yii::app()->clientScript->scriptMap=array(
            'jquery.js'=>false,
        );

        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery-3.2.1.min.js');


        $criteria = new CDbCriteria();
        $criteria->condition = 't.email_dest = :email_dest and status != 3';
        $criteria->params = array(":email_dest" => Usuarios::getUsuarioLogado()->email);
        //$criteria->params = array(":email_dest" => "milena@bombarco.com.br");
        $criteria->limit = 100;
        $criteria->order = "t.data DESC";

        $mensagens = Contatos::model()->findAll($criteria);

        $this->render("mensagens2", array("mensagens" => $mensagens));
    }

    // mensagens antes do minha conta
    public function actionMensagensVelhas() {

        $mensagens_velhas = Contatos::model()->findAll('usuarios_id_rem=:user and flag_msg_velha = 1', array(':user' => Yii::app()->user->id));

        $this->render('mensagens_velhas', array('mensagens_velhas' => $mensagens_velhas));
    }

    public function actionView($id) {

        Yii::app()->clientScript->scriptMap=array(
            'jquery.js'=>false,
        );

        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/js_zeromilhas/jquery-3.2.1.min.js');


        $criteria = new CDbCriteria();
        $criteria->condition = 't.email_dest = :email_dest and status != 3';
        $criteria->params = array(":email_dest" => Usuarios::getUsuarioLogado()->email);
        //$criteria->params = array(":email_dest" => "milena@bombarco.com.br");
        $criteria->limit = 100;
        $criteria->order = "t.data DESC";

        $mensagens = Contatos::model()->findAll($criteria);

        $this->render("mensagens2", array("mensagens" => $mensagens));

        /*

        Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/contato.js?234234', CClientScript::POS_END);

        // verificar se a mensagem eh do usuario
        $c = Contatos::model()->findByPk($id);
        if ($c != null && $c->usuarios_id_dest == Yii::app()->user->id) {
            $this->render('view', array(
                'model' => $this->loadModel($id, 'Contatos'),
            ));
        } else {
            $this->redirect(Yii::app()->homeUrl);
        }
        */
    }


    /* action que altera o status da mensagen para status de lida */

    public function actionMarcarComoLida() {

        if (isset($_POST)) {

            $id = $_POST['id'];

            $contato = Contatos::model()->findByPk($id);

            if ($contato != null) {

                if ($contato->tipo == 'S' || $contato->tipo == 'X') {
                    // marcar conversas como lidas
                    $conversas = Contatos::model()
                            ->findAll('email_rem=:email_rem AND usuarios_id_dest=:usuarios_id_dest AND embarcacoes_id=:embarcacoes_id', array(':email_rem' => $contato->email_rem, ':usuarios_id_dest' => $contato->usuarios_id_dest, ':embarcacoes_id' => $contato->embarcacoes_id));
                } else {

                    $conversas = Contatos::model()
                            ->findAll('email_rem=:email_rem AND usuarios_id_dest=:usuarios_id_dest AND empresas_id=:empresas_id', array(':email_rem' => $contato->email_rem, ':usuarios_id_dest' => $contato->usuarios_id_dest, ':empresas_id' => $contato->empresas_id));
                }

                if (count($conversas) > 0) {
                    foreach ($conversas as $conv) {
                        $conv->status = 1;
                        $conv->update();
                    }
                }
            }
        }
    }

    // enviar email do form de contato do /institucional
    public function actionContatoBombarco() {

        if($_POST['email_re'] == "mrs.navegação@hotmail.com") 
            return false;

        preg_match("/siteblindado/", $_POST["email_rem"], $arr);

        if(count($arr) > 0)
          return false;

        $parser = new CHtmlPurifier();

        // Honeypot
        if (!isset($_POST['mLmA8MdP']) || !empty($_POST['mLmA8MdP'])) {
            echo '-1';
            exit();
        }


        // enviar msg de contato para o admin
        // setar dados de contato
        $contato = new Contatos;
        $contato->setAttributes($_POST);
        $contato->data = date('Y-m-d H:i:s');
        $contato->email_dest = Yii::app()->params['bombarcoAtendimento'];
        $contato->tipo = 'C';

        $mensagem = $parser->purify($_POST['mensagem']) . ' Telefone: ' . $contato->telefone_rem;


        // salvar e enviar email
        if ($contato->save()) {

            // enviar email para admin a respeito do contato
            $message = new YiiMailMessage;
            $message->view = "mail_contato_admin";
            $message->subject = 'Contato - Site';
            $message->setBody(array('email' => $parser->purify($_POST['email_rem']), 'mensagem' => $mensagem), 'text/html');
            $message->addTo(Yii::app()->params['bombarcoAtendimento']);
            $message->setReplyTo($parser->purify($_POST['email_rem']));
            $message->from = Yii::app()->params['bombarcoAtendimento'];

            // envia msg
            if (!Yii::app()->mail->send($message)) {
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

    // E-mail de contato para o empresas/estaleiros
    // echo -1 => erro enviar email
    // echo -3 => tentou usar um email que já existe sem estar logado
    // echo -5 => tentou enviar a mensagem a si mesmo
    // echo -7 => usuário existe, digitou senha, mas é inválida
    // echo 1 => OK
    public function actionContatoEmpresa() {
        preg_match("/siteblindado/", $_POST["email_rem"], $arr);
        if(count($arr) > 0)
          return false;
        $parser = new CHtmlPurifier();

        if($_POST["email_rem"] == "natyads@hotmail.com") {
            return false;
        }

        // Honeypot
        /*if (!isset($_POST['j8BSVuvy']) || !empty($_POST['j8BSVuvy'])) {
            echo '-1';
            exit();
        }*/

        $check_login = false;
        $flgEstaleiro = (int) $parser->purify($_POST['flgEstaleiro']);


        // setar dados de contato
        $contato = new Contatos;
        $contato->setAttributes($_POST);

        $contato->data = date('Y-m-d H:i:s');
        $contato->usuarios_id_rem = Yii::app()->user->id;
        $contato->email_rem = $parser->purify($_POST['email_rem']);

        $empresa = Empresas::model()->find('usuarios_id=:usuarios_id', array(':usuarios_id' => $parser->purify($_POST['usuarios_id_dest']) ));
        if ($empresa == null) {
            echo '-1';
            exit;
        }

        if ($_POST['usuarios_id_dest'] == Yii::app()->user->id) {
            echo '-5';
            exit;
        }

        $contato->empresas_id = $empresa->id;
        // palavras chaves para achar a mensagem na busca
        $contato->palavras_chaves = $empresa->nomefantasia . ' ' . $empresa->nomefantasia . ' ' . $contato->nome_rem . ' ' . $contato->email_rem . ' ' . $contato->telefone_rem . ' ' . Utils::formatDateTimeToView($contato->data);

        if ($flgEstaleiro == 1) {

            $contato->tipo = Anuncio::$_tipo_contato['ESTALEIRO'];
            $contato->palavras_chaves .= ' estaleiro';
            // estaleiro
            $contato->email_dest = $parser->purify($_POST['email_empresa']);
            $contato->usuarios_id_dest = (int) $parser->purify($_POST['usuarios_id_dest']);

        } else {
            $contato->palavras_chaves .= ' guia';
            $contato->tipo = Anuncio::$_tipo_contato['GUIA_DE_EMPRESAS'];
            $contato->email_dest = $parser->purify($_POST['email_empresa']);
            $contato->usuarios_id_dest = (int) $parser->purify($_POST['usuarios_id_dest']);
        }

        // id vai conter o ID do usuario da empresa (achamos o usuario atraves do email da empresa)
        //$contato->usuarios_id = (int)$_POST['usuarios_id'];
        // nomefantasia da empresa
        $nomefantasia = $parser->purify($_POST['nomefantasia']);
        $mensagem = $parser->purify($_POST['mensagem']);

       

        /* gambiarra para que a mensagem que cair no usuario destinatario, apareça em 1º */
        $c = Contatos::model()
                ->find('usuarios_id_dest=:usuarios_id_dest and usuarios_id_rem=:usuarios_id_rem and empresas_id=:empresas_id', array(':usuarios_id_dest' => $contato->usuarios_id_dest, ':usuarios_id_rem' => $contato->usuarios_id_rem, ':empresas_id' => $contato->empresas_id));


        if (count($c) > 0) {
            $c->data_do_titulo = $contato->data;
            $c->titulo_mensagem = $contato->mensagem;
            $c->update();
        }

        $contato->data_do_titulo = date('Y-m-d H:i:s');
        $contato->titulo_mensagem = $mensagem;



        // salvar e enviar email
        if ($contato->save()) {
            $message = new YiiMailMessage;
            //this points to the file test.php inside the view path
            if ($flgEstaleiro == 1) {

                $message->subject = 'Contato Estaleiro';
                $message->view = 'mail_contato_estaleiro';
                $message->addTo($parser->purify($_POST['email_empresa']));
                //$message->addTo($parser->purify("jorge_pezzuol@hotmail.com"));
                //$mensagem .= ' - Email da pergunta: ' . $parser->purify($_POST['email_rem']);

                $c = Contatos::model()->findByPk($contato->id);
                $c->mensagem .= ' - Estaleiro contatado: ' . $parser->purify($nomefantasia) . ' / E-mail da pergunta: ' . $parser->purify($_POST['email_rem']);
                $c->update();

            } else {
                $message->subject = 'Contato Guia de Empresa';
                $message->view = 'mail_contato_empresa';
                $message->addTo($parser->purify($_POST['email_empresa']));
            }

            $message->setBody(array('nomefantasia' => $nomefantasia, 'mensagem' => $mensagem, 'id_contato' => $contato->id, 'nome_rem'=>$contato->nome_rem, 'email_rem'=>$contato->email_rem, 'telefone_rem'=>$contato->telefone_rem), 'text/html');
            $message->setReplyTo($parser->purify($_POST['email_rem']));
            $message->from = Yii::app()->params['bombarcoAtendimento'];

            if($parser->purify($_POST['email_empresa']) != Yii::app()->params['bombarcoAtendimento']) {

                $emails = array(Yii::app()->params['bombarcoAtendimento']);
                foreach ($emails as $value) {
                    $message->addCC($value);
                }
            }
            
            if (!Yii::app()->mail->send($message)) {
                echo '-1';
            } else {
                echo '1';
            }

        }

    }



    public function actionContatoEmpresaResposta() {

        $parser = new CHtmlPurifier();

        // post
        $email_remetente = $parser->purify($_POST['email_remetente']);
        $mensagem = $parser->purify($_POST['mensagem']);
        $email_destinatario = Usuarios::model()->findByPk($_POST['usuarios_id_dest'])->email;
        //$email_destinatario = $parser->purify($_POST['email_dest']);

        // verifica se o email de destino é um email que pertence a um estaleiro ou empresa
        // 1 - estaleiro
        // 0 - empresa
        $empresa = Empresas::model()->findByPk($parser->purify($_POST['empresas_id']));
        if ($empresa == null) {
            echo '-1';
            exit;
        }

        if ($empresa->macros_id == 3) {
            $flgEstaleiro = 1;
        } else {
            $flgEstaleiro = 0;
        }

        // setar dados de contato
        $contato = new Contatos;
        $contato->setAttributes($_POST);

        $contato->data = date('Y-m-d H:i:s');
        $contato->email_rem = $email_remetente;
        $contato->usuarios_id_rem = Yii::app()->user->id;

        $contato->empresas_id = $empresa->id;
        $contato->email_dest = $email_destinatario;
        $contato->usuarios_id_dest = (isset($_POST['usuarios_id_dest']) && !empty($_POST['usuarios_id_dest'])) ? $parser->purify($_POST['usuarios_id_dest']) : null;
        // palavras chaves para achar a mensagem na busca
        $contato->palavras_chaves = $empresa->razao . ' ' . $empresa->nomefantasia . ' ' . $contato->nome_rem . ' ' . $contato->email_rem . ' ' . $contato->telefone_rem . ' ' . Utils::formatDateTimeToView($contato->data);

        if ($flgEstaleiro == 1) {
            $contato->tipo = Anuncio::$_tipo_contato['ESTALEIRO'];
            $contato->palavras_chaves .= ' estaleiro';
            // estaleiro
            /*if (in_array($email_destinatario, Contatos::$emails_estaleiros)) {
                $contato->email_dest = $email_destinatario;
                $contato->usuarios_id_dest = $_POST['usuarios_id_dest'];
            } else {

                // estaleiros que o bombarco toma conta, enviar email para atendimento
                $contato->email_dest = Yii::app()->params['bombarcoAtendimento'];
                $contato->usuarios_id_dest = Usuarios::model()->find('email=:email', array(':email' => Yii::app()->params['bombarcoAtendimento']))->id;
            }*/

        }

        // empresa
        else {
            $contato->palavras_chaves .= ' guia';
            $contato->tipo = Anuncio::$_tipo_contato['GUIA_DE_EMPRESAS'];
        }


        /* gambiarra para que a mensagem que cair no usuario destinatario, apareça em 1º */
        $c = Contatos::model()->find('email_dest=:email_dest and usuarios_id_rem=:usuarios_id_rem and empresas_id=:empresas_id', array(':email_dest' => $contato->email_dest, ':usuarios_id_rem' => $contato->usuarios_id_rem, ':empresas_id' => $contato->empresas_id));
        if (count($c) > 0) {
            $c->data_do_titulo = $contato->data;
            $c->titulo_mensagem = $contato->mensagem;
            $c->update();
        }

        $contato->data_do_titulo = date('Y-m-d H:i:s');
        $contato->titulo_mensagem = $mensagem;

        /* aqui */


        // salvar e enviar email
        if ($contato->save()) {

            // enviar email para empresa
            $message = new YiiMailMessage;
            $message->view = "mail_empresa_resposta";
            if ($flgEstaleiro == 1) {
                $message->subject = 'Contato Estaleiro - Resposta';
            } else {
                $message->subject = 'Contato Guia de Empresa - Resposta';
            }

            $nome = '';

            // verificar se o estaleiro não é um estaleiro que deve ter a msg enviada
            // a propria caixa de entrada dos estaleiros
            if ($flgEstaleiro == 1) {
                if (in_array($email_destinatario, Contatos::$emails_estaleiros)) {
                    $message->addTo($email_destinatario);
                    $nome = Usuarios::model()->find('email=:email', array(':email' => $email_destinatario))->nome;
                } else {
                    // estaleiros que o bombarco toma conta, enviar email para atendimento
                    $message->addTo(Yii::app()->params['bombarcoAtendimento']);
                    $nome = 'Admin';
                }
            }

            // vai pro email da empresa se n for estaleiro
            else {
                $message->addTo($email_destinatario);
                $nome = Usuarios::model()->find('email=:email', array(':email' => $email_destinatario))->nome;
            }

            // remetente
            $message->from = Yii::app()->params['bombarcoAtendimento'];
            $message->setReplyTo($email_remetente);
            $message->setBody(array('mensagem' => $mensagem, 'id_contato' => $contato->id, 'nome' => $nome, 'id_customer' => $contato->usuarios_id_dest), 'text/html');

            // cópia para atendimento
            $emails = array(Yii::app()->params['bombarcoAtendimento']);
            foreach ($emails as $value) {
                $message->addCC($value);
            }

            // envia msg
            if (!Yii::app()->mail->send($message)) {
                echo '-1';
            } else {
                echo '1';
            }
        }
    }



    // enviar email para atendimento bombarco e um para o usuario avisando que
    // a embarcação não encontrada na tabela.....
    public function actionContatoTabelaBombarcoNaoEncontrou() {

        $parser = new CHtmlPurifier();

        if (isset($_POST)) {

            // dados do post
            $nome = $parser->purify(Yii::app()->request->getPost('nome'));
            $email = $parser->purify(Yii::app()->request->getPost('email'));
            $telefone = $parser->purify(Yii::app()->request->getPost('telefone'));
            $descricao = $parser->purify(Yii::app()->request->getPost('descricao'));

            if (empty($nome) || empty($email) || empty($telefone) || empty($descricao)) {
                echo '-1';
                exit();
            }

            // enviar email para admin e um email para o usuario
            // email para o admin contendo a msg do usuario
            $message = new YiiMailMessage;
            $message->view = "mail_tabela_bombarco";
            $message->subject = 'Tabela BomBarco';
            $message->setBody(array('nome' => $nome, 'email' => $email, 'telefone' => $telefone, 'mensagem' => $descricao), 'text/html');
            $message->addTo("atendimento@bombarco.com.br");
            $message->from = Yii::app()->params['bombarcoAtendimento'];
            $message->setReplyTo($email);

            if (!Yii::app()->mail->send($message)) {
                echo '-1';
                exit();
            }

            // email para o usuario contendo uma msg que o email foi enviado
            // e que alguém entrará em contato
            $message2 = new YiiMailMessage;
            $message2->view = "mail_automatico_resposta";
            $message2->subject = 'E-mail Automático';
            $message2->setBody(array('nome' => $nome), 'text/html');
            $message2->addTo($email);
            $message2->from = Yii::app()->params['bombarcoAtendimento'];

            if (!Yii::app()->mail->send($message2)) {
                echo '-1';
                exit();
            }

        }
    }



    // enviar email e criar usuario quando o usuario clica em buscar na tabela bombarco e não está logado
    public function actionContatoTabelaBombarcoBusca() {

        // Honeypot
        /*if (!isset($_POST['j8BSVuvy']) || !empty($_POST['j8BSVuvy'])) {
            echo '-1';
            exit();
        }*/

        // checar se não está logado e email ñ existir no banco, se não estiver, vamos criar o usuario
        if (Yii::app()->user->isGuest && !Usuarios::model()->exists('email=:email', array(':email' => $_POST['email']))) {

            // criar um usuario
            $usuario = new Usuarios;
            $usuario->email_rem = $_POST['email'];
            $usuario->pessoa = 'F';
            $usuario->usuario_classificacoes_id = Anuncio::$_classificacoes_de_usuario['USUARIO'];

            // senha provisória
            $senha = $uniqid = substr(uniqid(rand(), true), 6, 6); // 10 characters long

            $usuario->senha = $senha;

            // se salvar, vamos enviar um email para o usuario
            if ($usuario->save()) {

                // gerar um objeto de esquecimento de senha (caso o usuario qeira alterar sua senha provisória)
                $token = md5(uniqid(rand(), true));
                $recSenha = new UsuariosRecuperacaoSenha;
                $recSenha->token = $token;
                $recSenha->usuarios_id = $usuario->id;

                // objeto de email
                $message = new YiiMailMessage;
                $message->view = "mail_novo_usuario";
                $message->subject = 'Bem Vindo - BomBarco';
                $message->setBody(array('usuario' => $usuario, 'senha' => $senha, 'token' => $token), 'text/html');
                $message->addTo($usuario->email);
                $message->from = Yii::app()->params['bombarcoAtendimento'];

                if ($recSenha->save()) {
                    // envia msg
                    if (!Yii::app()->mail->send($message)) {

                        // erro
                        echo '-1';
                    } else {

                        $identity = new UserIdentity($usuario->email, $senha);
                        if ($identity->authenticate()) {
                            $user = Yii::app()->user;

                            // logar usuario e redirecionar para URL que gostaria de acessar antes de logar
                            $user->login($identity);
                            //$this->redirect(Yii::app()->homeUrl);
                            echo '1';
                        }
                    }
                }

                // erro
                else {
                    echo '-1';
                }
            }
        }
    }

    // enviar email do form de contato do /comunidade/agenda
    public function actionContatoAgenda() {

        // Honeypot
        /*if (!isset($_POST['j8BSVuvy']) || !empty($_POST['j8BSVuvy'])) {
            echo '-1';
            exit();
        }*/

        // enviar msg de contato para o admin
        // setar dados de contato
        $contato = new Contatos;
        $contato->setAttributes($_POST);
        $contato->data = date('Y-m-d H:i:s');
        $contato->email_dest = 'atendimento@bombarco.com.br';
        $contato->tipo = 'A';

        // salvar e enviar email
        if ($contato->save()) {

            // enviar email para admin a respeito do contato
            $message = new YiiMailMessage;
            $message->view = "mail_agenda_admin";
            $message->subject = 'Contato - Agenda';
            $message->setBody(array('email' => $_POST['email'], 'mensagem' => $_POST['mensagem'], 'empresa' => $_POST['empresa']), 'text/html');
            $message->addTo("atendimento@bombarco.com.br");
            $message->from = Yii::app()->params['bombarcoAtendimento'];
            $message->setReplyTo($_POST['email']);

            // envia msg
            if (!Yii::app()->mail->send($message)) {

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

    // E-mail de contato para o anunciante
    // echo -1 => erro enviar email
    // echo -3 => tentou usar um email que já existe sem estar logado
    // echo -5 => tentou enviar a mensagem a si mesmo
    // echo -7 => usuário existe, digitou senha, mas é inválida
    // echo 1 => OK
    public function actionMailAnunciante() {

        
        $parser = new CHtmlPurifier();

        // Honeypot
        if (!isset($_POST['j8BSVuvy']) || !empty($_POST['j8BSVuvy'])) {
            echo '-1';
            exit();
        }

        $check_login = false;

        if (isset($_POST)) {
            /*=========================================
            =            Envio da pergunta            =
            =========================================*/



            $email_remetente = $parser->purify($_POST['email_remetente']);
            if($email_remetente == "natyads@hotmail.com" || $email_remetente == "mrs.navegação@hotmail.com") {
                return false;
            }
            $nome = $parser->purify($_POST['nome_rem']);
            $nome_destinatario = "";
            if(isset($_POST["nome_destinatario"])) {
                $nome_destinatario = $parser->purify($_POST['nome_destinatario']);
            }
            
            $mensagem = $parser->purify($_POST['mensagem']);
            $idEmbarcacao = (int) $parser->purify($_POST['idEmbarcacao']);
            $idUsuarioDonoEmbarc = (isset($_POST['idUsuarioDonoEmbarc']) && !empty($_POST['idUsuarioDonoEmbarc'])) ? (int) $parser->purify($_POST['idUsuarioDonoEmbarc']) : null;
            $email_destinatario = $parser->purify($_POST['emailEmbarcacao']);


            $telefone = '';
            if (isset($_POST['telefone_rem']))
                $telefone = $parser->purify($_POST['telefone_rem']);

            if ($idUsuarioDonoEmbarc == Yii::app()->user->id) {
                echo '-5';
                exit;
            }

            // indica que é uma resposta do anunciante
            $flgResposta = false;
            if (isset($_POST['resposta']))
                $flgResposta = true;

            // marca modelo da embarc para por no subject do email
            $embarcacao = Embarcacoes::model()->findByPk($idEmbarcacao);

            $contato = new Contatos;
            $contato->email_rem = $email_remetente;
            $contato->nome_rem = $nome;
            $contato->mensagem = $mensagem;
            $contato->data = date('Y-m-d H:i:s');
            $contato->usuarios_id_rem = (isset(Yii::app()->user->id) && !empty(Yii::app()->user->id)) ? Yii::app()->user->id : null;
            $contato->usuarios_id_dest = $idUsuarioDonoEmbarc;
            $contato->telefone_rem = $telefone;
            $contato->embarcacoes_id = $idEmbarcacao;
            $contato->data_do_titulo = date('Y-m-d H:i:s');
            $contato->titulo_mensagem = $mensagem;
            // palavras chaves para achar a mensagem na busca
            $contato->palavras_chaves = $embarcacao->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $embarcacao->embarcacaoModelos->titulo . ' ' . $contato->nome_rem . ' ' . $contato->email_rem . ' ' . $contato->telefone_rem . ' ' . Utils::formatDateTimeToView($contato->data);

            if ($embarcacao->macros_id != 3) {
                // tipo de contato classificado
                $contato->tipo = Anuncio::$_tipo_contato['EMBARCACAO_CLASSIFICADO'];
                $contato->palavras_chaves .= ' classificado';
            } else {
                // tipo de contato estaleiro
                $contato->tipo = Anuncio::$_tipo_contato['EMBARCACAO_CATALOGO'];
                $contato->palavras_chaves .= ' catalogo';
            }

            //$contato->email_dest = $email_destinatario;
            $contato->email_dest = Usuarios::model()->findByPk($idUsuarioDonoEmbarc)->email;

            /* gambiarra para que a mensagem que cair no usuario destinatario, apareça em 1º */
            $c = Contatos::model()->find('usuarios_id_dest=:usuarios_id_dest and usuarios_id_rem=:usuarios_id_rem and embarcacoes_id=:embarcacoes_id', array(':usuarios_id_dest' => $contato->usuarios_id_dest, ':usuarios_id_rem' => $contato->usuarios_id_rem, ':embarcacoes_id' => $contato->embarcacoes_id));
            if (count($c) > 0) {
                $c->data_do_titulo = $contato->data;
                $c->titulo_mensagem = $contato->mensagem;
                $c->update();
            }




            if ($contato->save()) {

                $message = new YiiMailMessage;
                $message->addTo($email_destinatario);
                //$message->addTo("jorge_pezzuol@hotmail.com");


                // usuario dono da embarc
                //$usuario = Usuarios::model()->findByPk($idUsuarioDonoEmbarc);

                // se for resposta, mudar a view, para a view de resposta
                if ($_POST['resposta'] == 1) {
                    $message->view = "mail_anunciante_resposta";
                } else {
                    $message->view = "mail_anunciante";
                }

                if ($embarcacao->macros_id == 3) {
                    $message->subject = 'Contato Embarcação de Estaleiro - ' . $embarcacao->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $embarcacao->embarcacaoModelos->titulo;
                } else {
                    $message->subject = 'Contato Embarcação Classificado - ' . $embarcacao->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $embarcacao->embarcacaoModelos->titulo;
                    $message->addBcc("bombarcoadm@gmail.com");
                }

                $message->setBody(
                    array(
                        'nome_destinatario' => $nome_destinatario,
                        'nome_rem' => $nome,
                        'email_rem' => $email_remetente,
                        'mensagem' => $mensagem,
                        'id_contato' => $contato->id,
                        'marca' => $embarcacao->embarcacaoModelos->embarcacaoFabricantes->titulo,
                        'telefone' => $telefone,
                        'modelo' => $embarcacao->embarcacaoModelos->titulo,
                        'id_customer' => $idUsuarioDonoEmbarc,
                        'link' => Embarcacoes::mountAbsoluteUrl($embarcacao)
                    ),

                    'text/html');

                $message->from = Yii::app()->params['bombarcoAtendimento'];
                if($email_destinatario != "atendimento@bombarco.com.br") {
                    $message->addBcc("atendimento@bombarco.com.br");    
                }

                // PUSHNOTIFICATION @@
                //AppTokens::pushNotification();
                

                if(Embarcacoes::checarSeEhDono(Yii::app()->user->id, $embarcacao->id) == true) {                    
                    
                    $message->setReplyTo($parser->purify($embarcacao->email));
                    
                }
                else {

                    $message->setReplyTo($parser->purify($_POST["email_remetente"]));
                }


                if (!Yii::app()->mail->send($message)) {
                    echo '-1';
                    exit();
                }


                /*===============================
                =            Financiamento                    =
                ===============================*/

                /*if (isset($_POST['partner_finan']) && intval($_POST['partner_finan']) === 1) {

                    $params_partner = array(
                        'name' => $nome,
                        'email' => $email_remetente,
                        'phone' => $telefone,
                        'id' => $idEmbarcacao,
                        'title' => $embarcacao->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $embarcacao->embarcacaoModelos->titulo,
                        'price' => Utils::formataValorView((float) $embarcacao->valor),
                        'partner' => 'Alfa Financeira',
                        'link' => Embarcacoes::mountAbsoluteUrl($embarcacao)
                    );

                    // enviar email para admin a respeito do contato
                    $partner = new YiiMailMessage;
                    $partner->view = "mail_partner";
                    $partner->subject = 'Contato Parceiro - Alfa Financeira';
                    $partner->setBody($params_partner, 'text/html');

                    $partner->addTo("laura.irabi@bancoalfa.com.br");
                    $partner->addTo("ana.portela@bancoalfa.com.br");
                    $partner->addTo("atendimento@bombarco.com.br");
                    #$partner->addTo("andreluizrodper@gmail.com");
                    $partner->addTo("bombarcoadm@gmail.com");
                    $partner->from = 'atendimento3@bombarco.com.br';

                    // envia msg
                    if (!Yii::app()->mail->send($partner)) {
                        echo '-1';
                        exit();
                    }

                }


                if (isset($_POST['seg']) && intval($_POST['seg']) === 1) {

                    $params_partner = array(
                        'name' => $nome,
                        'email' => $email_remetente,
                        'phone' => $telefone,
                        'id' => $idEmbarcacao,
                        'title' => $embarcacao->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $embarcacao->embarcacaoModelos->titulo,
                        'price' => Utils::formataValorView((float) $embarcacao->valor),
                        'partner' => 'Top Four',
                        'link' => Embarcacoes::mountAbsoluteUrl($embarcacao)
                    );

                    // enviar email para admin a respeito do contato
                    $partner = new YiiMailMessage;
                    $partner->view = "mail_partner";
                    $partner->subject = 'Contato Parceiro - Top Four';
                    $partner->setBody($params_partner, 'text/html');
                    //$partner->addTo("gcigarro@topfourseguros.com.br");
                    $partner->addTo("bombarcoadm@gmail.com");

                    $partner->from = 'atendimento3@bombarco.com.br';

                    // envia msg
                    if (!Yii::app()->mail->send($partner)) {
                        echo '-1';
                        exit();
                    }

                }

                /*-----  End of Financiamento       ------*/


                /*=================================
                =            Consorcio            =

                if (isset($_POST['partner_cons']) && intval($_POST['partner_cons']) === 1) {

                    $params_partner2 = array(
                        'name' => $nome,
                        'email' => $email_remetente,
                        'phone' => $telefone,
                        'id' => $idEmbarcacao,
                        'title' => $embarcacao->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $embarcacao->embarcacaoModelos->titulo,
                        'price' => Utils::formataValorView((float) $embarcacao->valor),
                        'partner' => 'Unifisa',
                        'link' => Embarcacoes::mountAbsoluteUrl($embarcacao)
                    );

                    // enviar email para admin a respeito do contato
                    $partner2 = new YiiMailMessage;
                    $partner2->view = "mail_partner";
                    $partner2->subject = 'Contato Parceiro - Unifisa';
                    $partner2->setBody($params_partner2, 'text/html');

                    $partner2->addTo(Yii::app()->params['parceiroConsorcio']);
                    $partner2->addTo("atendimento@bombarco.com.br");
                    #$partner2->addTo("andreluizrodper@gmail.com");
                    $partner2->addTo("nautica@consorciounifisa.com.br");
                    $partner2->addTo("bombarco@consorciounifisa.com.br");
                    $partner2->addTo("bombarcoadm@gmail.com");
                    $partner2->from = 'atendimento3@bombarco.com.br';

                    // envia msg
                    if (!Yii::app()->mail->send($partner2)) {
                        echo '-1';
                        exit();
                    }

                }

                /*-----  End of Consorcio  ------*/


                if ($check_login) {
                    echo '2';
                    exit();
                } else {
                    echo '1';
                    exit();
                }

            } else {
                echo '-1';
                exit;
            }

            /*-----  End of Envio da pergunta  ------*/

        }
    }

    public function actionCreate() {
        $model = new Contatos;


        if (isset($_POST['Contatos'])) {
            $model->setAttributes($_POST['Contatos']);

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
        $model = $this->loadModel($id, 'Contatos');


        if (isset($_POST['Contatos'])) {
            $model->setAttributes($_POST['Contatos']);

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
            $this->loadModel($id, 'Contatos')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }




    /**
     * Email para parceiros
     * @return [type] [description]
     */
    public function actionPartners() {

        $parser = new CHtmlPurifier();

        // Honeypot
        if (!isset($_POST['C7RiUSGm']) || !empty($_POST['C7RiUSGm']))
            throw new Exception(0);

        $res = array(
            'error' => 0,
            'msg' => 'Contato enviado',
            'ok' => true,
        );


        $message = new YiiMailMessage;

        $tipo_parceiro = "";

        if ($_POST['partner_type'] === 'finan') { // tipo Financeiro

                /*if (!isset($_POST['finan_email']) || empty($_POST['finan_email'])) {
                    $res['error'] = 1;
                    $res['msg'] = 'Digite seu email';
                    echo json_encode($res);
                    exit;
                }

                $email = $parser->purify($_POST['finan_email']);

                $params = array(
                    'name' => $parser->purify($_POST['finan_nome']),
                    'email' => $email,
                    'phone' => $parser->purify($_POST['finan_phone']),
                    'id' => $parser->purify($_POST['finan_id']),
                    'title' => $parser->purify($_POST['finan_titulo']),
                    'price' => number_format($parser->purify($_POST['finan_valor']), 2, ",", "."),
                    'partner' => $parser->purify($_POST['finan_parceiro']),
                    'link' => $parser->purify($_POST['finan_link'])
                    );

                    $message->addTo(Yii::app()->params['parceiroFinanciamento']);
                    //$message->addTo("ana.portela@bancoalfa.com.br");
                    //$message->addTo("dlavelli@bancoalfa.com.br");
                    //$message->addTo("laura.irabi@bancoalfa.com.br");
                    $message->addTo("atendimento@bombarco.com.br");
                    $message->addTo("bombarcoadm@gmail.com");

                    $tipo_parceiro = "Financiamento";*/

        } else if ($_POST['partner_type'] === 'cons') { // tipo Consórcio

                if (!isset($_POST['cons_email']) || empty($_POST['cons_email'])) {
                    $res['error'] = 1;
                    $res['msg'] = 'Digite seu email';
                    echo json_encode($res);
                    exit;
                }

                $email = $parser->purify($_POST['cons_email']);

                $params = array(
                    'name' => $parser->purify($_POST['cons_nome']),
                    'email' => $email,
                    'phone' => $parser->purify($_POST['cons_phone']),
                    'id' => $parser->purify($_POST['cons_id']),
                    'title' => $parser->purify($_POST['cons_titulo']),
                    'price' => number_format($parser->purify($_POST['cons_valor']), 2, ",", "."),
                    'partner' => $parser->purify($_POST['cons_parceiro']),
                    'link' => $parser->purify($_POST['cons_link'])
                    );

                    //$message->addTo("consorcio2@bombarco.com.br");
                    $message->addTo("consorcio@bombarco.com.br");
                    //$message->addTo("relacionamento@unifisa.com.br");
                    //$message->addTo("nautica@consorciounifisa.com.br");
                    $message->addTo("bombarcoadm@gmail.com");
                    //$message->addTo("bombarco@consorciounifisa.com.br");
                    $message->addTo("atendimento@bombarco.com.br");
                    //$message->addTo("jorge_pezzuol@bombarco.com.br");
                    //$message->addTo("jorge_pezzuol@hotmail.com");
                    //$message->addTo("april.marc@hotmail.com");

                    $tipo_parceiro = "Consorcio";


        } else if($_POST['partner_type'] === 'trans') {

                if (!isset($_POST['trans_email']) || empty($_POST['trans_email'])) {
                    $res['error'] = 1;
                    $res['msg'] = 'Digite seu email';
                    echo json_encode($res);
                    exit;
                }

                $email = $parser->purify($_POST['trans_email']);

                $params = array(
                    'name' => $parser->purify($_POST['trans_nome']),
                    'email' => $email,
                    'phone' => $parser->purify($_POST['trans_phone']),
                    'id' => $parser->purify($_POST['trans_id']),
                    'title' => $parser->purify($_POST['trans_titulo']),
                    'price' => $parser->purify($_POST['trans_valor']),
                    'partner' => $parser->purify($_POST['trans_parceiro']),
                    'link' => $parser->purify($_POST['trans_link'])
                    );

                //$message->addTo("atendimento@bombarco.com.br");
                $message->addTo("transporte@bombarco.com.br");
                //$message->addTo("jorge_pezzuol@hotmail.com");
                

                $tipo_parceiro = "Transporte";

        } else if($_POST['partner_type'] === 'marina') {

            /*$email = $parser->purify($_POST['marina_email']);

            $params = array(
                'name' => $parser->purify($_POST['marina_nome']),
                'email' => $email,
                'phone' => $parser->purify($_POST['marina_phone']),
                'id' => $parser->purify($_POST['marina_id']),
                'title' => $parser->purify($_POST['marina_titulo']),
                'price' => Utils::formataValorView($parser->purify($_POST['marina_valor'])),
                'partner' => $parser->purify($_POST['marina_parceiro']),
                'link' => $parser->purify($_POST['marina_link'])
            );

             $message->addTo("marina@bombarco.com.br");

             $tipo_parceiro = "Marina";*/

        } else {
            $res['error'] = 3;
            $res['ok'] = false;
            $res['msg'] = 'Tipo de parceiro inválido';
        }

        //$message->from = $_POST['finan_email'];
        $message->from = 'atendimento@bombarco.com.br';
        //$message->addCC(Yii::app()->params['bombarcoAtendimento']);

        // enviar email para admin a respeito do contato
        $message->view = "mail_partner";
        $message->subject = 'Contato Parceiro';
        $message->setBody($params, 'text/html');
        //$message->addTo("bombarcoadm@gmail.com");
        //$message->addTo("atendimento@bombarco.com.br");


        $parceiros = new ContatosParceiros();
        $parceiros->email_de = $params["email"];
        $parceiros->tipo_parceiro = $tipo_parceiro;
        $parceiros->nome = $params["name"];
        $parceiros->telefone = $params["phone"];
        $parceiros->link_embarcacao = $params["link"];
        //$parceiros->mensagem = 
        $parceiros->save();

        // envia msg
        if (!Yii::app()->mail->send($message)) {
            $res['error'] = 2;
            $res['ok'] = false;
            $res['msg'] = 'Contato não enviado!';
        }

        // Auto resposta
        $response = new YiiMailMessage;
        $response->from = 'atendimento@bombarco.com.br';
        $response->addTo($email);
        $response->subject = 'Obrigado pelo Contato';
        $response->view = "mail_parceiro_resposta";
        $response->setBody($params, 'text/html');

        if (!Yii::app()->mail->send($response)) {
            $res['error'] = 2;
            $res['ok'] = false;
            $res['msg'] = 'Contato não enviado!';
        }

        echo json_encode($res);
        exit;
    }




    /**
     * Email para um parceiro específico, dentro da área dele
     * @return [type] [description]
     */
    public function actionPartner() {

        $parser = new CHtmlPurifier();

        // Honeypot
        if (!isset($_POST['PuUK8SmP']) || !empty($_POST['PuUK8SmP']))
            throw new Exception(0);

        $res = array(
            'error' => 0,
            'msg' => 'Contato enviado',
            'ok' => true,
        );

        try {

            if (!isset($_POST['email']) || empty($_POST['email']))
                throw new Exception("Digite seu email", 1);
            $params = array(
                        'name' => $parser->purify($_POST['name']),
                        'email' => $parser->purify($_POST['email']),
                        'phone' => $parser->purify($_POST['phone']),
                        //'price' => $parser->purify($_POST['price']),
                        'partner' => $parser->purify($_POST['partner']),
                        'type' => $parser->purify($_POST['type']),
                        'type_partner' => $parser->purify($_POST['type_partner'])
                );



            if(isset($_POST["pes-min"]) && isset($_POST["pes-max"])) {
                $params["pes-min"] = $parser->purify($_POST['pes-min']);
                $params["pes-max"] = $parser->purify($_POST['pes-max']);
            }

            if ($_POST['type_partner'] == 'T') {
                $params["fabricante"] = $parser->purify($_POST['fabricante']);
                $params["modelo"] = $parser->purify($_POST['modelo']);
                $params["local_partida"] = $parser->purify($_POST['local_partida']);
                $params["local_destino"] = $parser->purify($_POST['local_destino']);
            }

            if ($_POST['type_partner'] == 'JET') {
                $params["fabricante"] = $parser->purify($_POST['fabricante']);
                $params["modelo"] = $parser->purify($_POST['modelo']);
                $params["local_partida"] = $parser->purify($_POST['local_partida']);
                $params["price"] = "0";
            }


            if($_POST["type_partner"] == "M") {
                $params["fabricante"] = $parser->purify($_POST['fabricante']);
                $params["modelo"] = $parser->purify($_POST['modelo']);
                $params["cidade_estado"] = $parser->purify($_POST['cidade_estado']);
            }

            if($_POST["type_partner"] == "SURF") {
                $params["cidade_estado"] = $parser->purify($_POST['cidade_estado']);
            }

            if($_POST["type_partner"] == "SUB") {
                $params["fabricante"] = $parser->purify($_POST['fabricante']);
                $params["modelo"] = $parser->purify($_POST['modelo']);
            }

            if($_POST["type_partner"] == "C") {
                $params["price"] = $parser->purify($_POST['price']);
            }

            if($_POST["type_partner"] == "ARR") {
                $params["price"] = "0";
                $params["estado"] = $parser->purify($_POST['estado']);
                $params["cidade"] = $parser->purify($_POST['cidade']);
            }

            if($_POST["type_partner"] == "ALU") {
                $params["mes"] = $parser->purify($_POST['mes']);
                $params["local_passeio"] = $parser->purify($_POST['local_passeio']);
                $params["total_pessoas"] = $parser->purify($_POST['total_pessoas']);
                $params["dias"] = $parser->purify($_POST['dias']);
            }

            // enviar email para admin a respeito do contato
            $message = new YiiMailMessage;
            $message->view = "mail_partner_detail";
            $message->subject = 'Contato Parceiro';
            $message->setBody($params, 'text/html');
            $message->addTo("bombarcoadm@gmail.com");
            //$message->addTo("atendimento@bombarco.com.br");

            if ($_POST['type_partner'] == 'F') { // tipo Financeiro
            	//$tipo_parceiro = "Financiamento";
                //$message->addTo(Yii::app()->params['parceiroFinanciamento']);
                //$message->addTo("laura.irabi@bancoalfa.com.br");
                //$message->addTo("dlavelli@bancoalfa.com.br");
                //$message->addTo("ana.portela@bancoalfa.com.br");
            } else if ($_POST['type_partner'] == 'C') { // tipo Consórcio
                    $message->addTo(Yii::app()->params['parceiroConsorcio']);
                    //$message->addTo("relacionamento@unifisa.com.br");
                    //$message->addTo("nautica@consorciounifisa.com.br");
                    //$message->addTo("bombarcoadm@gmail.com");
                    //$message->addTo("atendimento@bombarco.com.br");
                    //$message->addTo("bombarco@consorciounifisa.com.br");
                $tipo_parceiro = "Consorcio";
            } else if ($_POST['type_partner'] == 'S') { // tipo seguro
            	$tipo_parceiro = "Seguro";
                //$message->addTo("gcigarro@topfourseguros.com.br");
            } else if ($_POST['type_partner'] == 'T') { // tipo seguro
                //$message->addTo(Yii::app()->params['bombarcoAtendimento']);
                $message->addTo("transporte@bombarco.com.br");
                $tipo_parceiro = "Transporte";
            }
            else if($_POST["type_partner"] == 'M') {
                //$message->addTo("marina@bombarco.com.br");
                //$tipo_parceiro = "Marina";
            }
            else if($_POST["type_partner"] == 'SUB') {
                $message->addTo("plataforma@bombarco.com.br");
                $tipo_parceiro = "Subergivel";
            }
            else if($_POST["type_partner"] == 'SURF') {
                $message->addTo("jetsurf@bombarco.com.br");
                //$message->addTo("jorge_pezzuol@bombarco.com.br");
                $tipo_parceiro = "Jet Surf";
            }
            else if($_POST["type_partner"] == 'ARR') {
                $message->addTo("habilitacaonautica@bombarco.com.br");
                $tipo_parceiro = "Arrais";
            }
            else if($_POST["type_partner"] == 'JET') {
                //$message->addTo("jorge_pezzuol@hotmail.com");
                $message->addTo("pisonautico@bombarco.com.br");
                $tipo_parceiro = "Jettdeck";
            }
            else if($_POST["type_partner"] == 'ALU') {
                //$message->addTo("jorge_pezzuol@hotmail.com");
                $message->addTo("alugueldelancha@bombarco.com.br");
                $tipo_parceiro = "Aluguel de Lancha";
            }
            else {
                throw new Exception("Tipo de parceiro inválido", 1);
            }

            $message->from = Yii::app()->params['bombarcoAtendimento'];
            //$message->addCC(Yii::app()->params['bombarcoAtendimento']);

            if (!Yii::app()->mail->send($message))
                throw new Exception("Contato não enviado!", 1);


            $parceiros = new ContatosParceiros();
            $parceiros->email_de = $params["email"];
            $parceiros->tipo_parceiro = $tipo_parceiro;
            $parceiros->nome = $params["name"];
            $parceiros->telefone = $params["phone"];
            //$parceiros->mensagem = 
            $parceiros->save();

            // Auto resposta
            $response = new YiiMailMessage;
            $response->from = "atendimento@bombarco.com.br";
            $response->addTo($parser->purify($_POST['email']));
            $response->subject = 'Obrigado pelo Contato';
            $response->view = "mail_parceiro_resposta";
            $response->setBody($params, 'text/html');

            if (!Yii::app()->mail->send($response))
                throw new Exception("Contato não enviado!", 1);

        } catch (Exception $e) {
            $res['error'] = $e->getCode();
            $res['msg'] = $e->getMessage();
            $res['ok'] = false;
        }

        echo json_encode($res);
        exit;
    }

    public function actionAlterarStatusVariasMsgs() {

        if(isset($_POST)) {

            $ids = json_decode(stripslashes($_POST['ids']));
            $status = $_POST["status"];

            foreach($ids as $id) {

                 $contato = Contatos::model()->findByPk($id);

                if ($contato != null) {

                    if ($contato->tipo == 'S' || $contato->tipo == 'X') {
                        // marcar conversas como lidas
                        $conversas = Contatos::model()
                                ->findAll('email_rem=:email_rem AND usuarios_id_dest=:usuarios_id_dest AND embarcacoes_id=:embarcacoes_id', array(':email_rem' => $contato->email_rem, ':usuarios_id_dest' => $contato->usuarios_id_dest, ':embarcacoes_id' => $contato->embarcacoes_id));
                    } else {

                        $conversas = Contatos::model()
                                ->findAll('email_rem=:email_rem AND usuarios_id_dest=:usuarios_id_dest AND empresas_id=:empresas_id', array(':email_rem' => $contato->email_rem, ':usuarios_id_dest' => $contato->usuarios_id_dest, ':empresas_id' => $contato->empresas_id));
                    }

                    if (count($conversas) > 0) {
                        foreach ($conversas as $conv) {
                            $conv->status = $status;
                            $conv->update();
                        }
                    }
                }
            }
        }
    }


    public function actionDeletarMsgs() {


        if(isset($_POST)) {

            $ids = json_decode(stripslashes($_POST['ids']));

            foreach($ids as $id) {

                 $contato = Contatos::model()->findByPk($id);

                if ($contato != null) {

                    if ($contato->tipo == 'S' || $contato->tipo == 'X') {
                        // marcar conversas como lidas
                        $conversas = Contatos::model()
                                ->findAll('email_rem=:email_rem AND usuarios_id_dest=:usuarios_id_dest AND embarcacoes_id=:embarcacoes_id', array(':email_rem' => $contato->email_rem, ':usuarios_id_dest' => $contato->usuarios_id_dest, ':embarcacoes_id' => $contato->embarcacoes_id));
                    } else {

                        $conversas = Contatos::model()
                                ->findAll('email_rem=:email_rem AND usuarios_id_dest=:usuarios_id_dest AND empresas_id=:empresas_id', array(':email_rem' => $contato->email_rem, ':usuarios_id_dest' => $contato->usuarios_id_dest, ':empresas_id' => $contato->empresas_id));
                    }

                    if (count($conversas) > 0) {
                        foreach ($conversas as $conv) {
                            $conv->status = 3;
                            $conv->update();
                        }
                    }
                }
            }
        }
    }


}
