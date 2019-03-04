<?php

class MotorAnuncioController extends GxController {

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
			    array('allow',
	                'actions' => array('busca', 'planosParaMotor', 'detalhe', 'contabilizarVerTelefone'),
	                'users' => array('*'),
	            ),
				array('allow', 
					'actions'=>array('criarPlanoMotor', 'anunciarMotor', 'previewMotor', 'meusMotores', 'excluir', 'pausar', 'despausar', 'update'),
					'users'=>array('@'),
					),
                array('allow', 
                    'actions'=>array('aprovarAnuncios', 'aprovar', 'barrar', 'adminGeral'),
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



    public function actionAprovarAnuncios() {

        $criteria = new CDbCriteria();
        $criteria->with = array('planoUsuarios'=>array("with"=>"usuarios"), 'motorFabricantes', 'motorTipos');
        $criteria->condition = 't.status = :status';
        $criteria->params = array(":status" => Anuncio::$_status_anuncio["ANUNCIO_PAGO"]);
        $criteria->order = "t.data_registro DESC";

        $motores = MotorAnuncio::model()->findAll($criteria);

        $this->render("admin_aprovar", array("motores" => $motores));
    }

    public function actionAdminGeral() {

        $criteria = new CDbCriteria();
        $criteria->with = array('planoUsuarios'=>array("with"=>"usuarios"), 'motorFabricantes', 'motorTipos');
        $criteria->condition = 't.usuarios_id != :usuarios_id and t.status != 7';
        $criteria->params = array(":usuarios_id" => 5876);
        $criteria->order = "t.data_registro DESC";

        $motores = MotorAnuncio::model()->findAll($criteria);

        $this->render("admin_geral", array("motores" => $motores));
    }

	public function actionPlanosParaMotor() {

    	Yii::app()->theme = "";

    	$this->render("planos_motor");
    }
	
	public function actionCriarPlanoMotor() {

    	Yii::app()->theme = "";

    	$planos_id = Yii::app()->request->getQuery('pid');

		if($planos_id != null) {

			$plano = Planos::model()->findByPk($planos_id);

			if($plano != null && $plano->flag == 'anuncio_motor') {

                $planoUsuarios = new PlanoUsuarios();
                $planoUsuarios->status = 0;

				// escolheu gratuito e ja tem
				if($plano->gratuito == 1) {

					$flgTemGratuito = PlanoUsuarios::model()->exists("usuarios_id = :usuarios_id AND planos_id = :planos_id", 
						array(":usuarios_id"=>Yii::app()->user->id, ":planos_id"=>125));

					if($flgTemGratuito) {
						Yii::app()->user->setFlash('msg', "Você já possui um plano grátis!");
						$this->render("planos_motor");
						exit;
					}

                    $planoUsuarios->status = 1;
				}

				// ok 
				
				$planoUsuarios->planos_id = $planos_id;
				$planoUsuarios->usuarios_id = Yii::app()->user->id;
                $planoUsuarios->valor = $plano->valor;
				$planoUsuarios->qntpermitida = $plano->qntpermitida;
				$planoUsuarios->gratuito = $plano->gratuito;

				if($planoUsuarios->save()) {

                    $this->redirect(array('/anunciarMotor?pid='.$planoUsuarios->id));
					exit;
				}
			}
		}

		// plano n existe
		$this->render("planos_motor");
    }

    public function actionAnunciarMotor() {

    	Yii::app()->theme = "";

    	$motor = new MotorAnuncio();

    	$criteria = new CDbCriteria;
        $criteria->condition = "status = 1";
        $criteria->order = "titulo asc";
    	$marcas = MotorFabricantes::model()->findAll($criteria);

    	$criteria = new CDbCriteria;
        $criteria->condition = "status = 1";
        $criteria->order = "titulo asc";
    	$tipos = MotorTipos::model()->findAll($criteria);

		if (isset($_POST['MotorAnuncio'])) {

            $plano_usuarios_id = Yii::app()->request->getQuery('pid');

            if(MotorAnuncio::verSePodeAnunciar($plano_usuarios_id)) {

                $motor->setAttributes($_POST['MotorAnuncio']);
	            $motor->valor = Utils::formataValor($motor->valor);
	            $motor->usuarios_id = Yii::app()->user->id;
	            $motor->plano_usuarios_id = $plano_usuarios_id;
	            $motor->data_registro = date('Y-m-d H:i:s');
                $motor->status = 0;

                $planoUsuarios = PlanoUsuarios::model()->findByPk($plano_usuarios_id);

                // plano grats
                if($planoUsuarios->planos->gratuito == 1) {
                    $motor->status = 1;
                }

                if ($motor->valor > $planoUsuarios->planos->limitepreco && $planoUsuarios->planos->limitepreco != 0.00) {
                    Yii::app()->user->setFlash('msg_erro', "O limite de preço foi atingido");
                    $this->render("anunciar_motor", array("motor"=>$motor, "marcas"=>$marcas, "tipos"=>$tipos));
                    exit;
                }

                $ordem = new Ordens;
                $ordem->usuarios_id = Yii::app()->user->getId();
                $ordem->valor = (float) $planoUsuarios->valor;
                //$ordem->valor = 0.01;
                $ordem->data_criacao = date("Y-m-d H:i:s");
                $ordem->ordem_tipos_id = Anuncio::$_tipo_ordem['PLANO_MOTOR'];
                $ordem->descricao = 'Plano - Anúncio de Motor - ' . $planoUsuarios->qntpermitida . ' por ' . $planoUsuarios->planos->duracaomeses . ' meses';
                $ordem->status = Anuncio::$_status_ordem['CRIADA'];
                // FK do item da ordem (aqui no caso é o plano)
                $ordem->id_item = (int) $plano_usuarios_id;
                $ordem->save();

                $flgNaoAchou = true;

                // n achou marca
                if(isset($_POST["MotorFabricantes"])) {
                    $motorFabricantes = new MotorFabricantes();
                    $motorFabricantes->setAttributes($_POST["MotorFabricantes"]);
                    $motorFabricantes->status = 0;
                    $motorFabricantes->slug = MotorFabricantes::gerarSlug($motorFabricantes);
                    if($motorFabricantes->save()) {
                        $motor->motor_fabricantes_id = $motorFabricantes->id;
                    }
                    else {
                        Yii::app()->user->setFlash('msg_erro', "Erro ao realizar o cadastro. Marca já cadastrada!");
                        $this->render("anunciar_motor", array("motor"=>$motor, "marcas"=>$marcas, "tipos"=>$tipos));
                        exit;
                    }
                }

                // n achou tipo
                if(isset($_POST["MotorTipos"])) {
                    $motorTipos = new MotorTipos();
                    $motorTipos->setAttributes($_POST["MotorTipos"]);
                    $motorTipos->status = 0;
                    $motorTipos->slug = MotorTipos::gerarSlug($motorTipos);
                    if($motorTipos->save()) {
                        $motor->motor_tipos_id = $motorTipos->id;
                    }
                    else {
                        Yii::app()->user->setFlash('msg_erro', "Erro ao realizar o cadastro. Tipo já cadastrado!");
                        $this->render("anunciar_motor", array("motor"=>$motor, "marcas"=>$marcas, "tipos"=>$tipos));
                        exit;
                    }
                }

                $motor->slug = MotorAnuncio::gerarSlug($motor);

                if($motor->save()) {

                    $photos = CUploadedFile::getInstancesByName('MotorImagens[imagem]');   

                    if (isset($photos) && count($photos) > 0) {

                        $ordem = explode("|", $_POST["ordem-fotos"]);
                         
                        foreach ($photos as $key => $pic) {

                            $nome_arquivo = uniqid().str_replace(' ', '_', $pic->name);

                            if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/public/motores/'.$nome_arquivo)) {

                                $img = new MotorImagens();
                                $img->motor_anuncio_id = $motor->id;
                                $img->imagem = $nome_arquivo;
                                // nao ordenou as fotos
		                        if($ordem[0] == "") {
		                        	$img->ordem = $key;
		                        }
		                        else {
		                        	$img->ordem = (int)array_search($pic->name, $ordem); 	
		                        } 
                                $img->status = 1;
                                $img->save(); 
                            }
                        }
                    }

                    // sucesso
                    Yii::app()->user->setFlash('msg_sucesso', "Anúncio cadastrado com sucesso!");
                    
                }
            }

            // qtde max de anuncios atingida
            else {

                Yii::app()->user->setFlash('msg', "Quantidade máxima de anúncios atingida!");
                $this->redirect(array('/anunciar'));
                exit;
            }


		}

    	$this->render("anunciar_motor", array("motor"=>$motor, "marcas"=>$marcas, "tipos"=>$tipos));
    }

    public function actionUpdate($id) {

        Yii::app()->theme = "";

        if(!MotorAnuncio::verSeEhDono($id)) {
            $this->redirect(array('/anunciar'));
            exit;
        }

        $motor = MotorAnuncio::model()->findByPk($id);

        $criteria = new CDbCriteria;
        $criteria->condition = "status = 1";
        $criteria->order = "titulo asc";
        $marcas = MotorFabricantes::model()->findAll($criteria);

        $criteria = new CDbCriteria;
        $criteria->condition = "status = 1";
        $criteria->order = "titulo asc";
        $tipos = MotorTipos::model()->findAll($criteria);

        if (isset($_POST['MotorAnuncio'])) {

            $motor->setAttributes($_POST['MotorAnuncio']);
            $motor->valor = Utils::formataValor($motor->valor);

            $planoUsuarios = PlanoUsuarios::model()->findByPk($motor->plano_usuarios_id);

            if ($motor->valor > $planoUsuarios->planos->limitepreco && $planoUsuarios->planos->limitepreco != 0.00) {
                Yii::app()->user->setFlash('msg_erro', "O limite de preço foi atingido");
                $this->render("update", array("motor"=>$motor, "marcas"=>$marcas, "tipos"=>$tipos));
                exit;
            }

            // n achou marca
            if(isset($_POST["MotorFabricantes"])) {
                $motorFabricantes = new MotorFabricantes();
                $motorFabricantes->setAttributes($_POST["MotorFabricantes"]);
                $motorFabricantes->status = 0;
                $motorFabricantes->slug = MotorFabricantes::gerarSlug($motorFabricantes);
                if($motorFabricantes->save()) {
                    $motor->motor_fabricantes_id = $motorFabricantes->id;
                }
                else {
                    Yii::app()->user->setFlash('msg_erro', "Marca já cadastrada!");
                    $this->render("update", array("motor"=>$motor, "marcas"=>$marcas, "tipos"=>$tipos));
                    exit;
                }
            }

            // n achou tipo
            if(isset($_POST["MotorTipos"])) {
                $motorTipos = new MotorTipos();
                $motorTipos->setAttributes($_POST["MotorTipos"]);
                $motorTipos->status = 0;
                $motorTipos->slug = MotorTipos::gerarSlug($motorTipos);
                if($motorTipos->save()) {
                    $motor->motor_tipos_id = $motorTipos->id;
                }
                else {
                    Yii::app()->user->setFlash('msg_erro', "Tipo já cadastrado!");
                    $this->render("update", array("motor"=>$motor, "marcas"=>$marcas, "tipos"=>$tipos));
                    exit;
                }
            }

            $motor->slug = MotorAnuncio::gerarSlug($motor);
            $motor->status = Anuncio::$_status_anuncio["ANUNCIO_PAGO"];

            if($motor->update()) {

                $photos = CUploadedFile::getInstancesByName('MotorImagens[imagem]');   
                $ordem = explode("|", $_POST["ordem-fotos"]);

                // soh ordenou fotos existentes (n adicionou fotos novas)
                if($ordem[0] != "" && count($photos) == 0) {

                    foreach($ordem as $ord) {

                        $img = MotorImagens::model()->find("imagem = :imagem", array(":imagem" => $ord));

                        if($img != null) {

                            $img->ordem = (int)array_search($ord, $ordem);
                            $img->update();
                        }
                    }
                }

                // adicinou fotos
                if (isset($photos) && count($photos) > 0) {

                    $nome_fotos = array();
                     
                    foreach ($photos as $key => $pic) {

                        $nome_fotos[] = $pic->name;

                        $nome_arquivo = uniqid().str_replace(' ', '_', $pic->name);

                        if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/public/motores/'.$nome_arquivo)) {

                            $img = new MotorImagens();
                            $img->motor_anuncio_id = $motor->id;
                            $img->imagem = $nome_arquivo;
                            // nao ordenou as fotos
                            if($ordem[0] == "") {
                                $img->ordem = $key;
                            }
                            else {
                                $img->ordem = (int)array_search($pic->name, $ordem);    
                            } 
                            $img->status = 1;
                            $img->save(); 
                        }
                    }

                    $result = array_diff($ordem, $nome_fotos);
                    foreach($result as $r) {
                        $img = MotorImagens::model()->find("imagem = :imagem", array(":imagem" => $r));
                        $img->ordem = (int)array_search($r, $ordem);
                        $img->update();
                    }

                }

                // sucesso
                Yii::app()->user->setFlash('msg_sucesso', "Anúncio alterado com sucesso!");
            }
        }

        $this->render("update", array("motor"=>$motor, "marcas"=>$marcas, "tipos"=>$tipos));
    }

    public function actionPreviewMotor() {

        $plano_usuarios_id = Yii::app()->request->getQuery('pid');

        if(MotorAnuncio::verSePodeAnunciar($plano_usuarios_id) || Yii::app()->user->isAdmin()) {

            $motorPreview = new MotorAnuncioPreview();
            $motorPreview->setAttributes($_POST['MotorAnuncio']);
            $motorPreview->valor = Utils::formataValor($motorPreview->valor);
            $motorPreview->usuarios_id = Yii::app()->user->id;
            $motorPreview->plano_usuarios_id = $plano_usuarios_id;
            $motorPreview->data_registro = date('Y-m-d H:i:s');

            if($motorPreview->save()) {

            	$photos = CUploadedFile::getInstancesByName('MotorImagens[imagem]');   

	            if (isset($photos) && count($photos) > 0) {

	                $ordem = explode("|", $_POST["ordem-fotos"]);
	                 
	                foreach ($photos as $key => $pic) {

	                    $nome_arquivo = uniqid().str_replace(' ', '_', $pic->name);

	                    if ($pic->saveAs(Yii::getPathOfAlias('webroot').'/public/motores_preview/'.$nome_arquivo)) {

	                        $img = new MotorImagensPreview();
	                        $img->motor_anuncio_preview_id = $motorPreview->id;
	                        $img->imagem = $nome_arquivo;

	                        // nao ordenou as fotos
	                        if($ordem[0] == "") {
	                        	$img->ordem = $key;
	                        }
	                        else {
	                        	$img->ordem = (int)array_search($pic->name, $ordem); 	
	                        }
	                        
	                        $img->status = 1;
	                        $img->save(); 


	                    } 
	                }
	            }

            	// renderizar preview
                $this->render("preview", array("motorPreview"=>$motorPreview));
            }
        }
        else {

    	    Yii::app()->user->setFlash('msg', "Sem permissão para acessar a pagina desejada");
            $this->redirect(array('/anunciar'));
        }
    }

    public function actionAprovar($id) {

        /*
          0 - criado anuncio
          1 - pago
          2 - ativo (validado pelo admin)
          3 - vendido ou acabou tempo de anuncio
         */
        $motor = MotorAnuncio::model()->findByPk($id);
        $motor->status = Anuncio::$_status_anuncio['ANUNCIO_ATIVADO'];

        if($motor->motorFabricantes->status == 0) {
            MotorFabricantes::model()->updateByPk($motor->motor_fabricantes_id, array("status" => 1));
        }

        if($motor->motorTipos->status == 0) {
            MotorTipos::model()->updateByPk($motor->motor_tipos_id, array("status" => 1));
        }

        // atualizar data de fim do plano do anuncio, ja q foi ativado agora
        $planoUsuarios = PlanoUsuarios::model()->findByPk($motor->plano_usuarios_id);

        // verificar se é plano grats
        $planoUsuarios->inicio = date('Y-m-d H:i:s');
        $planoUsuarios->fim = date('Y-m-d H:i:s', strtotime('today + ' . $planoUsuarios->planos->duracaomeses . ' month'));          
        $planoUsuarios->status = 2;
        $planoUsuarios->update();

        $motor->update();

        $usuario = Usuarios::model()->findByPk($motor->usuarios_id);

        //Seu cadastro foi validado com sucesso e já está no ar em nosso site!
        $message = new YiiMailMessage;
        $message->view = "aprovar_motor";
        $message->subject = 'BomBarco - Ativação de Anúncio ' . MotorAnuncio::nomeAnuncio($motor);
        $message->setBody(array('motor' => $motor, 'nomeCliente' => $usuario->nome), 'text/html');
        $message->addTo($usuario->email);
        $message->from = Yii::app()->params['bombarcoAtendimento'];

        // enviar email para o email cadastrado na embarcação, para informar que o anuncio foi validado ok
        if (Yii::app()->mail->send($message)) {
            echo '1';
        } else {
            echo '-1';
        }

    }

    public function actionBarrar($id) {

        $motor = MotorAnuncio::model()->findByPk($id);
        $motor->status = Anuncio::$_status_anuncio["ANUNCIO_BARRADO"];
        $motor->update();

        $usuario = Usuarios::model()->findByPk($motor->usuarios_id);

        $message = new YiiMailMessage;
        $message->view = "barrar_motor";
        $message->subject = 'BomBarco - Anúncio Não Autorizado ' . MotorAnuncio::nomeAnuncio($motor);
        $message->setBody(array('motor' => $motor, 'nomeCliente' => $usuario->nome), 'text/html');
        $message->addTo($usuario->email);
        $message->from = Yii::app()->params['bombarcoAtendimento'];

        // enviar email para o email cadastrado na embarcação, para informar que o anuncio foi validado ok
        if (Yii::app()->mail->send($message)) {
            echo '1';
        } else {
            echo '-1';
        }
    }

    public function actionExcluir($id) {

        if(MotorAnuncio::verSeEhDono($id)) {
            echo MotorAnuncio::model()->updateByPk($id, array('status'=>Anuncio::$_status_anuncio["ANUNCIO_DELETADO"]));    
        }
        else {
            echo 0;
        }
        
    }

    public function actionPausar($id) {

        if(MotorAnuncio::verSeEhDono($id)) {
            echo MotorAnuncio::model()->updateByPk($id, array('status'=>Anuncio::$_status_anuncio["ANUNCIO_PAUSADO"]));    
        }
        else {
            echo 0;
        }
    }

    public function actionDespausar($id) {

        $motor = MotorAnuncio::model()->findByPk($id);
        if($motor->status != Anuncio::$_status_anuncio["ANUNCIO_PAUSADO"]) {
            echo 0; 
            exit;
        }

        if(MotorAnuncio::verSeEhDono($id)) {
            echo MotorAnuncio::model()->updateByPk($id, array('status'=>Anuncio::$_status_anuncio["ANUNCIO_ATIVADO"]));    
        }
        else {
            echo 0;
        }
    }

    public function actionMeusMotores() {

        $criteria = new CDbCriteria();
        $criteria->with = array('planoUsuarios'=>array("with"=>"usuarios"), 'motorFabricantes', 'motorTipos');
        //$criteria->condition = 't.status = 2 AND planoUsuarios.status = 2';
        $criteria->condition = 't.usuarios_id = :usuarios_id AND t.status <> :status_deletado';
        $criteria->params = array(":usuarios_id" => Yii::app()->user->id, ':status_deletado' => Anuncio::$_status_anuncio["ANUNCIO_DELETADO"]);
        $criteria->order = "t.data_registro DESC";

        $motores = MotorAnuncio::model()->findAll($criteria);

        $this->render("meus_motores", array("motores" => $motores));
    }


    public function actionBusca() {

    	// https://www.bombarco.com.br/motores?marca=jhonson&tipo=popa&preco-min=0&preco-max=99999999999999.99&estado=N
    	$array_view = array();
        $array_view['estado'] = Yii::app()->request->getParam('estado');
        $array_view['marca'] = Yii::app()->request->getParam('marca');
        $array_view['tipo'] = Yii::app()->request->getParam('tipo');
        $array_view['preco-min'] = Yii::app()->request->getParam('preco-min');
        $array_view['preco-max'] = Yii::app()->request->getParam('preco-max');
        $array_view['ordem'] = preg_replace('/[^A-ù]/', "", Yii::app()->request->getParam('ordem'));
        $array_view['busca'] = Yii::app()->request->getParam('busca-texto');

        $offset = (Yii::app()->request->getParam('page') != null) ? ((int) Yii::app()->request->getParam('page') * Embarcacoes::LIMIT_SEARCH) : null;
        $ajax = Yii::app()->request->getParam('ajax');

    	$criteria = new CDbCriteria();
        $criteria->with = array('planoUsuarios'=>array("with"=>"usuarios"), 'motorFabricantes', 'motorTipos');
        $criteria->condition = ' t.status = 2 AND planoUsuarios.status = 2';
        $criteria->offset = $offset;

       	if (Yii::app()->request->getParam('ordem') != "") {
            $criteria->order = 't.valor ' . Yii::app()->request->getParam('ordem');
        } else {
            $criteria->order = 'RAND('.date('ymdh').')';
        }

    	if (Yii::app()->request->getParam('estado') != "") { 
            $criteria->addCondition("t.estado = '".Yii::app()->request->getParam('estado')."'") ;
            $array_view['estado'] = Yii::app()->request->getParam('estado');
        }

        if (Yii::app()->request->getParam('marca') != "") { 

            $marca = MotorFabricantes::model()->findByAttributes(array('slug' => Yii::app()->request->getParam('marca')));

            if (!empty($marca)) {
                $array_view['marca'] = $marca;

                $criteria->addCondition('motor_fabricantes_id = ' . $marca->id);
            }
        }

        if (Yii::app()->request->getParam('tipo') != "") { 

            $tipo = MotorTipos::model()->findByAttributes(array('slug' => Yii::app()->request->getParam('tipo')));

            if (!empty($tipo)) {
                $array_view['tipo'] = $tipo;
                $criteria->addCondition('motor_tipos_id = ' . $tipo->id);
            }
        }

        if (Yii::app()->request->getParam('preco-min') != null && Yii::app()->request->getParam('preco-max') != null) { 

            $preco_min = number_format(str_replace('.', '', Yii::app()->request->getParam('preco-min')), 2, '.', '');
            $array_view['preco_min'] = $preco_min;

            $preco_max = number_format(str_replace('.', '', Yii::app()->request->getParam('preco-max')), 2, '.', '');
            $array_view['preco_max'] = $preco_max;

            $criteria->addBetweenCondition('t.valor', $preco_min, $preco_max);
            $criteria->addCondition('t.valor IS NOT NULL');
        }

        if(Yii::app()->request->getParam('busca-texto') != "") {

        	$busca = str_replace(' ', '%', Yii::app()->request->getParam('busca-texto'));

            $criteria->addCondition('(t.slug LIKE "%'.$busca.'%"
                    OR usuarios.nome LIKE "%'.$busca.'%"
                    OR usuarios.razaosocial LIKE "%'.$busca.'%"
					OR t.descricao LIKE "%'.$busca.'%"
					OR motorTipos.slug LIKE "%'.$busca.'%"
					OR motorFabricantes.slug LIKE "%'.$busca.'%")');

            $array_view["busca"] = Yii::app()->request->getParam('busca-texto');
        }

        $array_view["total"] = MotorAnuncio::model()->count($criteria);
        
        $criteria->limit = Embarcacoes::LIMIT_SEARCH;
        $array_view["motores"] = MotorAnuncio::model()->findAll($criteria);


        // Executando via AJAX
        // HTML do Ver Mais.
        if ($ajax == true) {

            $html = '';


            foreach ($array_view["motores"] as $motor) {

                // Macro vinda do Fabricante
                if (Yii::app()->theme->name != 'mobile') {

                    $html .= '<li class="category-tabela">';

                    $html .= MotorAnuncio::getThumb($motor, array('class' => 'bg-img-tabela'), true);

                    /*if ($embarc->destaque == 2) {
                        $html .= '<i class="faixa-destaque-emba"></i>';
                    }*/

                    $html .= '<div class="textos-tabela-bb">';

                    $titulo = "";
                    /*if(Embarcacoes::checkTurbo($embarc, "titulo") == true) {
                        $titulo = $embarc->titulo;
                    }*/                                                                                                                                                                

                    $html .= '<h2 class="text-tabela-bb-title">'.$motor->motorFabricantes->titulo . ' ' . $motor->motorTipos->titulo. ' '. '<b>'.$titulo.'</b></h2>';
                    $html .= '<h2 class="text-tabela-bb-ano">Potência: <b>'.$motor->potencia.'</b></h2>';
                    $html .= '<h2 class="text-tabela-bb-estado">Estado: <b>' . Embarcacoes::$_estado[$motor->estado] . '</b></h2>';
                    $html .= '<h2 class="text-tabela-bb-price">';
                    $html .= ($motor->valor > 0?"R$ " . number_format($motor->valor, 2, ',', '.'):"R$ não informado");
                    $html .= '</h2>';

                    $html .= '<div  style="cursor:pointer;" class="balao_contato" data-email="@email" data-embarcid="'. $motor->id . '" data-link="'.MotorAnuncio::gerarLinkAbsoluto($motor).'" data-valor="'.$motor->valor.'" data-titulo="'.MotorAnuncio::nomeAnuncio($motor).'">';
                    //$html .= '<img style="cursor:pointer; float:left;" class="balao" data-email="@email" data-embarcid="'. $motor->id . '" src="'. Yii::app()->createUrl("img/icon_chat.png"). '"/>';
                    //$html .= '<span style="float:left; margin-left:5px; font-weight:bolder; font-size:13px;">Entre em contato</span>';  
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</li>';
                } else {

                    // fazer aqui o html do tema mobile que será gerado para o ver mais
                    $html .= '<div class="result-content pure-g">';

                    $html .= '<a href="' . MotorAnuncio::gerarLinkAbsoluto($motor) . '" class="link-result">';
                    $html .= '<div class="result-image pure-u-1-4">';
                    $html .= MotorAnuncio::getThumb($motor, array('class' => 'bg-img-tabela'), true);
                    $html .= '</div>';

                    $html .= '<div class="result-infos pure-u-3-4">';

                    $result_title = $motor->motorFabricantes->titulo . ' ' . $motor->motorTipos->titulo;
                    $result_price = $motor->valor != '0.00' ? Utils::formataValorView($motor->valor) : "N/Info.";

                    $html .= '<div class="infos-content">';

                    /*if ($motor->destaque == 2) {
                        $html .= '<div class="box-featured sprite"></div>';
                    }*/

                    $html .= '<article class="result-title">' . $result_title . ' </article>';

                    $html .= '<article class="info-content">';
                    $html .= '<span class="info-text">' . $motor->motorTipos->titulo . '</span>';
                    $html .= '<span class="result-price inline-block">R$ ' . $result_price . ' </span>';
                    $html .= '</article>';
                    $html .= '</div>';
                    $html .= '</div>';
                    $html .= '</a>';
                    $html .= '</div>';
                }
            }

            echo json_encode(array('html' => $html, 'count' => $array_view["total"]));
            exit;

        }

    	$this->render("busca", array("array_view"=>$array_view));

    }

    public function actionContabilizarVerTelefone() {

        if (isset($_POST['id_motor'])) {

            $motor = MotorAnuncio::model()->findByPk($_POST["id_motor"]);

            if($motor != null) {
                $motor->ver_telefone += 1;
                $motor->update();    
            }
            
        }
    }

    public function actionDetalhe() {

        $slug = Yii::app()->request->getParam('marca') . "/" . Yii::app()->request->getParam('tipo') . "/" .Yii::app()->request->getParam('potencia');
        
        $motor = MotorAnuncio::model()->find("slug = :slug", array(":slug" => $slug));

        if($motor != null) {

            $motor->clicks += 1;
            $motor->update();

            $this->render("detalhe", array("motor"=>$motor));    
        }

    	
    }

	public function actionAdmin() {
		$model = new Tags('search');
		$model->unsetAttributes();

		if (isset($_GET['Tags']))
			$model->setAttributes($_GET['Tags']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}