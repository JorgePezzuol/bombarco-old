<?php

class TabelaEmbarcacoesController extends GxController {


	public function init() {
		$this->setPageTitle("Tabela Bombarco");
	}

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
				array('allow',
					'actions'=>array('index','view', 'LoadYearByModel', 'busca', 'obterAno', 'carregarMaisAnunciosTabela'), 
					'users'=>array('*'),
					),
				array('allow', 
						'actions'=>array('admin','delete','minicreate','create','update','changeStatus', 'teste', 'ajaxUpdate', 'desativar'),
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

	public function actionAjaxUpdate() {

		$campo = $_POST["campo"];
		$valor = $_POST["valor"];
		$pk = $_POST["pk"];

		if($campo == "valor") {
			$valor = str_replace(',', '.', str_replace('.', '', $valor));
		}

		echo TabelaEmbarcacoes::model()->updateByPk($pk, array($campo => $valor));
		
	}

	public function actionTeste() {

		$model = new TabelaEmbarcacoes('search');
        $model->unsetAttributes();

        if (isset($_GET['TabelaEmbarcacoes']))
            $model->setAttributes($_GET['TabelaEmbarcacoes']);

        $this->render('teste', array(
            'model' => $model
        ));
	}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'TabelaEmbarcacoes'),
		));
	}


	public function actionCreate() {
		$model = new TabelaEmbarcacoes;

		if (isset($_POST['TabelaEmbarcacoes'])) {

			$model->setAttributes($_POST['TabelaEmbarcacoes']);
			
			$model->valor = str_replace(',', '.', str_replace('.', '', $model->valor));

			if ($model->save()) {
				
				if (Yii::app()->getRequest()->getIsAjaxRequest()) {
					echo "1";
					exit;
				}
				else {
					$this->redirect(array('view', 'id' => $model->id));
				}
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionAdmin() {

		$model = new TabelaEmbarcacoes('search');
        $model->unsetAttributes();

        if (isset($_GET['TabelaEmbarcacoes']))
            $model->setAttributes($_GET['TabelaEmbarcacoes']);

        $this->render('admin', array(
            'model' => $model
        ));

        /*$this->render('admin', array(
            'model' => $model
        ));*/
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'TabelaEmbarcacoes');


		if (isset($_POST['TabelaEmbarcacoes'])) {
			$model->setAttributes($_POST['TabelaEmbarcacoes']);
			$model->valor = Utils::formataValor($model->valor);
			
			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$modelo = EmbarcacaoModelos::model()->findByPk($model->embarcacao_modelos_id);

		$fabricantes = CHtml::listData( EmbarcacaoFabricantes::model()->findAll( 'embarcacao_macros_id = :id', array( ':id'=>$modelo->embarcacao_macros_id ) ),'id','titulo' );
		$modelos = CHtml::listData( EmbarcacaoModelos::model()->findAll( 'embarcacao_fabricantes_id = :id', array( ':id'=>$modelo->embarcacao_fabricantes_id) ),'id','titulo') ;


		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/numeral.min.js', CClientScript::POS_END);
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/languages.min.js', CClientScript::POS_END);
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.price_format.2.0.min.js', CClientScript::POS_END);

		if (!Yii::app()->user->isGuest) {
			Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/admin_tabela_embarcacoes.js', CClientScript::POS_END);
		}

		$this->render('update', array(
				'model' => $model,
				'macro_selected' => $modelo->embarcacao_macros_id,
				'fabricantes' => $fabricantes,
				'fabricante_selected' => $modelo->embarcacao_fabricantes_id,
				'modelos' => $modelos,
			)
		);
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'TabelaEmbarcacoes')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {

		/* possiveis parametros que podem ter vindo da url */
		$marca = Yii::app()->request->getParam('marca');
		$modelo = Yii::app()->request->getParam('modelo');
		$ano = Yii::app()->request->getParam('ano');
		$macro = Yii::app()->request->getParam('macro');


		$breadcrumbs[] = array('texto'=>'Home', 'link'=> Yii::app()->homeUrl);
		$breadcrumbs[] = array('texto'=>'Tabela de Barcos', 'link'=> Yii::app()->createUrl('tabela'));

		/*==========  SEO  ==========*/				
		/*Yii::app()->clientScript->registerMetaTag('description', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Neque, quae repellat delectus enim consectetur alias sit ipsam, facilis doloremque sint quidem iste ducimus magnam rerum aliquam! Officia dicta aliquid rerum.');
		Yii::app()->clientScript->registerMetaTag('keywords', 'tag, tag1, tag2');*/

		$this->render('index', array(
			'breadcrumbs' => $breadcrumbs,
			'marca'=>$marca,
			'modelo'=>$modelo,
			'ano'=>$ano,
			'macro'=>$macro
			)
		);
	}



	/**
	 * Busca por preço de embarcação Tabela
	 * @return [type] [description]
	 */
	public function actionBusca() {

		$params = array();
		$array_json = array();

		/*==========  Criteria de Tabela  ==========*/		
		$criteria = new CDbCriteria();
		$criteria->condition = 't.status = 1';
		//$criteria->limit = TabelaEmbarcacoes::LIMIT_SEARCH;

		/*==========  Criteria de Anúncios  ==========*/
		$criteria_anuncios = new CDbCriteria();
		$criteria_anuncios->with = array('embarcacaoModelos');
		//$criteria_anuncios->limit = Embarcacoes::LIMIT_SEARCH;	

		// Filtrando por fabricantes
		if (Yii::app()->request->getParam('marca') != "") {

			$marca = EmbarcacaoFabricantes::model()->find("slug=:slug", array(":slug"=>Yii::app()->request->getParam('marca')))->id;
			
			$criteria->with['embarcacaoModelos'] = array(
				'with' => array(
					'embarcacaoFabricantes' => array(
						'condition' => 'embarcacaoFabricantes.id=:embarcacao_fabricantes',
						'params' => array(':embarcacao_fabricantes'=>$marca)
						)
					)
				);
			$criteria_anuncios->addCondition('t.embarcacao_fabricantes_id = ' . $marca);
		}

		// Filtrando por Modelo
		if (Yii::app()->request->getParam('modelo') != "") {	

			// aqui vem o slug da marca-modelo
			$marca_modelo = Yii::app()->request->getParam('modelo');

			if($marca_modelo != Yii::app()->request->getParam('marca') . "-") {

				//$modelo_slug = str_replace(Yii::app()->request->getParam('marca')."-", "", $marca_modelo);
				$modelo_slug = $marca_modelo;
				$modelo = EmbarcacaoModelos::model()->find("slug=:slug", array(":slug"=>$modelo_slug))->id;		
				$criteria->addCondition('t.embarcacao_modelos_id = :embarcacao_modelos');
				$criteria_anuncios->addCondition('t.embarcacao_modelos_id = :embarcacao_modelos');
				$params[':embarcacao_modelos'] = $modelo;
			}
			
		}

		// Filtrando por Ano
		if (Yii::app()->request->getParam('ano') != "") {

			$ano = Yii::app()->request->getParam('ano');
			
			$criteria->addCondition('t.ano = :ano');
			$criteria_anuncios->addCondition('t.ano = :ano');
			$params[':ano'] = $ano;
		}
	
		/*==========  Embarcacões  ==========*/		
		$criteria->params = $params;
		$criteria->order = "t.ano desc";
		$embarcacoes = TabelaEmbarcacoes::model()->findAll($criteria);



		/*==========  HTML de Embarcacões  ==========*/
		$html_embarcacoes = '';
		foreach ($embarcacoes as $key => $value) {

			// lancha ou veleiro
			if($value->embarcacao_macros_id != 1) {

				$pes = preg_replace('~\.0+$~', '', $value->pes);
				$potencia = str_replace("HP", "", $value->potenciamotor);
				$potencia = str_replace("hp", "", $value->potenciamotor);

				$html_embarcacoes .= '<div class="box-tabela-bb-r" id="resultado-tabela">';

	            $html_embarcacoes .= '<li class="category-tabela-r">';
	            $html_embarcacoes .=    '<div class="textos-tabela-bb-r">';
	            $html_embarcacoes .=        '<span class="text-tabela-bb-title-r"> ' .@$value->embarcacaoModelos->embarcacaoFabricantes->titulo . ' '. $value->embarcacaoModelos->titulo . ' </span>';
	            $html_embarcacoes .=        '<span class="text-tabela-bb-ano-rnd-r"> Ano: </span><span class="text-tabela-bb-ano-r">' . @$value->ano . ' </span><br>';
	            $html_embarcacoes .=        '<span class="text-tabela-bb-ano-rnd-r"> Tamanho: </span><span class="text-tabela-bb-ano-r">' . @$pes . ' Pés</span><br>';
	            $html_embarcacoes .=        '<span class="text-tabela-bb-ano-rnd-r"> Qtd Motores: </span><span class="text-tabela-bb-ano-r">' . @$value->qtdemotores . ' </span><br>';
	             ' </span><br>';
	            if($value->motor_fabricantes_id != null) {
					$marca_motor = MotorFabricantes::model()->findByPk($value->motor_fabricantes_id)->titulo;
					$html_embarcacoes .=        '<span class="text-tabela-bb-ano-rnd-r"> Marca do Motor: </span><span class="text-tabela-bb-ano-r">' . @$marca_motor . ' </span><br>';  
				}

				if($value->motor_modelos_id != null) {
					$modelo_motor = MotorModelos::model()->findByPk($value->motor_modelos_id);
					if($modelo_motor != null) {
						$titulo_motor = $modelo_motor->titulo;
						$html_embarcacoes .=        '<span class="text-tabela-bb-ano-rnd-r"> Modelo do Motor: </span><span class="text-tabela-bb-ano-r">' . @$titulo_motor . ' </span><br>';  
					}
				}            
	            $html_embarcacoes .=        '<span class="text-tabela-bb-ano-rnd-r"> Tipo de Motor: </span><span class="text-tabela-bb-ano-r">' . @$value->motorTipos->titulo . ' </span><br>';
	            $html_embarcacoes .=        '<span class="text-tabela-bb-ano-rnd-r"> Potência do Motor: </span><span class="text-tabela-bb-ano-r">' . @$potencia . ' HP </span><br>';

	            $html_embarcacoes .=        '<span class="text-tabela-bb-price-r"> Valor Aproximado <br><span> ' . @($value->valor > 0?"R$ " . number_format($value->valor,2, ",","."):"Não informado") . ' </span></span><br>';
	            $html_embarcacoes .=    '</div>';                        
	            $html_embarcacoes .= '</li>';
	            $html_embarcacoes .= '</div>';
        	}


        	// jetski
        	else {

        		$html_embarcacoes .= '<div class="box-tabela-bb-r" id="resultado-tabela">';
	            $html_embarcacoes .= '<li class="category-tabela-r">';
	            $html_embarcacoes .=    '<div class="textos-tabela-bb-r">';
	            $html_embarcacoes .=        '<span class="text-tabela-bb-title-r"> ' .$value->embarcacaoModelos->embarcacaoFabricantes->titulo . ' '. $value->embarcacaoModelos->titulo . ' </span>';
	            $html_embarcacoes .=        '<span class="text-tabela-bb-ano-rnd-r"> Ano: </span><span class="text-tabela-bb-ano-r">' . $value->ano . ' </span><br>';
	            $html_embarcacoes .=        '<span class="text-tabela-bb-ano-rnd-r"> Motor: </span><span class="text-tabela-bb-ano-r">' . $value->embarcacaoModelos->motor_de_fabrica . ' Pés</span><br>';
	            $html_embarcacoes .=        '<span class="text-tabela-bb-ano-rnd-r"> Passageiros: </span><span class="text-tabela-bb-ano-r">' . $value->embarcacaoModelos->passageiros . ' </span><br>';            
	            $html_embarcacoes .=        '<span class="text-tabela-bb-price-r"> Valor Aproximado <br><span> ' . ($value->valor > 0?"R$ " . number_format($value->valor,2, ",","."):"Não informado") . ' </span></span><br>';
	            $html_embarcacoes .=    '</div>';                        
	            $html_embarcacoes .= '</li>';
	            $html_embarcacoes .= '</div>';
        	}

			/*$html_embarcacoes .= '<div class="botoes-tabela-top">
									<div class="botao-tabela-top1">
										 <a class="botao-opcoes-seguro-tab" id="btn-opcoes-seguro-tab">Opcões de seguro</a>
									</div>
									<div class="botao-tabela-top2"> 
										 <a class="botao-financiamento-tab" id="btn-fincanciamento">Financiamento</a>
									</div>
								</div>';*/

		}	

		$html_embarcacoes .= '<br/><p style="font-size: 12px;
text-align: left;">*A Tabela Bombarco mostra a média de preços de embarcações que já foram anunciadas no Bombarco, servindo apenas para consulta. Os preços efetivamente praticados são decididos pelos seus proprietários e variam em função de diversas situações como: região, conservação, cor, acessórios, motor, ano, etc.</p><br/>';

		/*==========  Anúncios  ==========*/	
		$criteria_anuncios->addCondition('t.status = 2');	
		$criteria_anuncios->addCondition('t.macros_id != 3');	

		if(count($embarcacoes) > 0) {

			$tamanho = (int)$embarcacoes[0]->embarcacaoModelos->tamanho;
			$tamanhoMax = $tamanho + 3;
			$tamanhoMin = $tamanho - 3;
			$criteria_anuncios->addCondition('embarcacaoModelos.tamanho >= :tamanhoMin AND embarcacaoModelos.tamanho <= :tamanhoMax');	
			$params[':tamanhoMin'] = $tamanhoMin;
			$params[':tamanhoMax'] = $tamanhoMax;
		}

		$criteria_anuncios->params = $params;
	
		$anuncios = Embarcacoes::model()->findAll($criteria_anuncios);

		/*==========  HTML de Anúncios  ==========*/		
		$html_anuncios = '';

		// achou anuncios
		if(count($anuncios) > 0) {
			foreach ($anuncios as $key => $value) {

				$html_anuncios .=   '<li class="category-tabela">';

				$html_anuncios .= Embarcacoes::getThumb($value, array('class'=>'bg-img-tabela'), true);
				$html_anuncios .=		'<div class="textos-tabela-bb">';
				$html_anuncios .=			'<span class="text-tabela-bb-title">'.$value->embarcacaoFabricantes->titulo . ' '.$value->embarcacaoModelos->titulo.'</span>';
				$html_anuncios .=			'<span class="text-tabela-bb-ano"> Ano:<b>'.$value->ano.' </b></span><br>';
				$html_anuncios .=			'<span class="text-tabela-bb-estado"> Estado: <b>'.$value->estados->nome.' </b></span><br>';
				
				if($value->valor == 0.00) {
					$html_anuncios .=			'<span class="text-tabela-bb-price"> R$ A combinar</span>';
				}
				else {
					$html_anuncios .=			'<span class="text-tabela-bb-price"> '.($value->valor > 0?"R$ " . number_format($value->valor,2, ",","."):"Não informado").' </span>';
				}
				$html_anuncios .=		'</div>';						
				$html_anuncios .=	'</li>';

			}
		}

		// vazio
		else {
			$html_anuncios = "";
		}
	


		echo json_encode(array(
			'embarcacoes'=>$html_embarcacoes,
			'anuncios'=>$html_anuncios,
			'qnt_anuncios'=>count($anuncios),
			'qnt_results'=>count($embarcacoes)
			)
		);

	}

	/* carregar mais anúncios do resultado da busca da tabela Bombarco */
	public function actionCarregarMaisAnunciosTabela() {


		/* busca */
		$fabricante = Yii::app()->request->getParam('fabricante');		
		$modelo = Yii::app()->request->getParam('modelo');
		$offset = (Yii::app()->request->getParam('page') != null) ? ((int)Yii::app()->request->getParam('page') * Embarcacoes::LIMIT_SEARCH) : null;

		/* criteria */
		$criteria = new CDbCriteria();
		$criteria->with = array('embarcacaoModelos','embarcacaoImagens', 'embarcacaoFabricantes', 'planoUsuarios');		
		$criteria->condition = ' t.status = :status AND t.macros_id != :macro_estaleiros AND planoUsuarios.status = 2';
		$criteria->limit = Embarcacoes::LIMIT_SEARCH;	
		$criteria->offset = $offset;
		$criteria->addCondition("(t.embarcacao_modelos_id = :modelo
										OR t.embarcacao_fabricantes_id = :fabricante)");
			
		$params = array(':macro_estaleiros'=>Macros::$macro_by_slug['estaleiro'], 
			':status'=>Embarcacoes::ACTIVE,
			':modelo'=>$modelo,
			':fabricante'=>$fabricante);

		$criteria->params = $params;

		$embarcacoes = Embarcacoes::model()->findAll($criteria);

		/* montar html de resposta */
		$html = '';

		foreach($embarcacoes as $embarc) {

			$html .= '<li class="category-tabela">';

				$html .= Embarcacoes::getThumb($embarc, array('class'=>'bg-img-tabela'), true);

				if($embarc->destaque == 2) {
					$html .= '<i class="faixa-destaque-emba"></i>';
				}
				
				$html .= '<div class="textos-tabela-bb">';
					
					$html .= '<h2 class="text-tabela-bb-title">'.$embarc->titulo.'</h2>';
					$html .= '<h2 class="text-tabela-bb-ano">Ano: <b>'.$embarc->ano.'</b></h2>';
					$html .= '<h2 class="text-tabela-bb-estado">Estado: <b>'.Embarcacoes::$_estado[$embarc->estado].'</b></h2>';
					$html .= '<h2 class="text-tabela-bb-price">R$ ' . ($value->valor > 0?"R$ " . number_format($value->valor,2, ",","."):"Não informado") .  '</h2>';
					// $html .= '<h2 class="text-tabela-bb-ano-rnd">'.$embarc->ano.'</h2>';
					// $html .= '<h2 class="text-tabela-bb-estado-rnd">'.Embarcacoes::$_estado[$embarc->estado].'</h2>';
				
				$html .= '</div>';
			
			$html .= '</li>';

		}

		echo json_encode(array('html'=>$html,'count'=>count($embarcacoes)));
	}


	/**
	 * Action que altera o Status
	 * Se estiver Ativado, desativa
	 * Se estiver Desativado, ativa
	 * @param  [type] $id [ID do Modelo]
	 * @return [type]     [description]
	 */
	public function actionChangeStatus($id) {

		$model = TabelaEmbarcacoes::model()->findByPk($id);

		if ($model->status == 0) {
			$model->status = 1;
		} else if ($model->status == 1) {
			$model->status = 0;
		}

		$model->update();
		$this->redirect(Yii::app()->request->urlReferrer);

	}


		/**
	 * Action que altera o Status
	 * Se estiver Ativado, desativa
	 * Se estiver Desativado, ativa
	 * @param  [type] $id [ID do Modelo]
	 * @return [type]     [description]
	 */
	public function actionDesativar() {

		$id = $_POST["id"];
		$model = TabelaEmbarcacoes::model()->findByPk($id);
		$model->status = 0;

		if($model->update()) {
			echo 1;
		}
		else {
			echo 0;
		}
		

	}

	// obtém os anos pelo ID do modelo e ID do fabricante
	public function actionObterAno() {

		$slug_fabricante = $_POST['embarcacao_fabricantes_slug'];
		$slug_modelo = $_POST['embarcacao_modelos_slug'];

		$embarcacao_fabricantes_id = EmbarcacaoFabricantes::model()->find("slug=:slug", array(":slug"=>$slug_fabricante))->id;
		$embarcacao_modelos_id = EmbarcacaoModelos::model()->find("slug=:slug", array(":slug"=>$slug_modelo))->id;

		$criteria = new CDbCriteria;
		$criteria->select = array('ano');
		$criteria->distinct = true;
		$criteria->condition = 'embarcacao_fabricantes_id=:embarcacao_fabricantes_id AND embarcacao_modelos_id=:embarcacao_modelos_id';
		$criteria->params = array(':embarcacao_fabricantes_id'=>$embarcacao_fabricantes_id, ':embarcacao_modelos_id'=>$embarcacao_modelos_id);
		$criteria->order = 't.ano ASC';

		// resultado da criteria
		$result = TabelaEmbarcacoes::model()->findAll($criteria);

		// array que vai conter os anos
		$array_anos = array();

		// loop para obter os anos
		foreach($result as $r) {
			$array_anos[] = $r->ano;
		}

		// retornar array de anos
		echo json_encode($array_anos);
	}

	/**
	 * Retorna o DropDown de anos, a partir do Modelo
	 * @param  [type] $model_id [description]
	 * @return [type]           [description]
	 */
	public function actionLoadYearByModel() {

		$id = Yii::app()->request->getPost('id');

		$criteria = new CDbCriteria();
		$criteria->condition = "embarcacao_modelos_id = :id";
		$criteria->params = array(":id"=>$id);
		$criteria->group = 'ano';

		$model = TabelaEmbarcacoes::model()->findAll($criteria);

		echo TabelaEmbarcacoes::dropDownYear($model);

	}

}