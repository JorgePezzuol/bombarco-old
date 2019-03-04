<?php

class ComparadorController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('index','view'),
				'users'=>array('*'),
				),
			array('allow', 
				'actions'=>array('minicreate', 'create','update', 'comparar', 'delete'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('admin'),
				'users'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
} 



	public function actionComparar($id_embarcacao = null) {

		$embarcacoes_semelhates = array();
		$embarc = Embarcacoes::model()->findByPk($id_embarcacao);

		if($embarc != null) {

			// temos que verificar se o barco que ele clicou paraa comparar já não foi
			// clicado nesta sessão corrente do usuario (para não repetir na página de comparações)
			if(!Comparador::model()->exists('embarcacoes_id=:embarcacoes_id AND sessaotoken=:sessaotoken AND status = 1', 
				array(':embarcacoes_id'=>$id_embarcacao, ':sessaotoken'=>Yii::app()->session->sessionID))) {


				// não foi comparado ainda, salvar
				$comparador = new Comparador;
				$comparador->usuarios_id = Yii::app()->user->id;
				$comparador->embarcacoes_id = $id_embarcacao;
				$comparador->dataregistro = date('Y-m-d H:i:s');
				$comparador->sessaotoken = Yii::app()->session->sessionID;

				if(!$comparador->save()) {
					$this->redirect('site/error');
					exit;
				}
			}
		}

		else {
			$embarc = Comparador::ultimoBarcoComparado();

		}

		$criteria_semelhantes = new CDbCriteria();
		$criteria_semelhantes->with = array('embarcacaoModelos'=>array('with'=>'embarcacaoTipos'), 'embarcacaoFabricantes');
		$criteria_semelhantes->limit = Embarcacoes::LIMIT_SEARCH;	
		$params = array();

		$id_tipo = $embarc->embarcacaoModelos->embarcacaoTipos->id;
		$tamanho = (int)$embarc->embarcacaoModelos->tamanho;
		$tamanhoMax = $tamanho + 3;
		$tamanhoMin = $tamanho - 3;
		$criteria_semelhantes->addCondition('embarcacaoModelos.tamanho >= :tamanhoMin AND embarcacaoModelos.tamanho <= :tamanhoMax');
		$criteria_semelhantes->addCondition('t.status = 2 and t.macros_id != 3');
		$criteria_semelhantes->addCondition('t.id != :id');
		$criteria_semelhantes->addCondition('embarcacaoTipos.id =:idTipo');
		//$criteria_semelhantes->addCondition('t.embarcacao_modelos_id =:embarcacao_modelos_id');
		//$criteria_semelhantes->addCondition('t.embarcacao_fabricantes_id =:embarcacao_fabricantes_id');	
		$params[':id'] = $embarc->id;
		$params[':idTipo'] = $id_tipo;
		$params[':tamanhoMin'] = $tamanhoMin;
		$params[':tamanhoMax'] = $tamanhoMax;
		//$params[':embarcacao_modelos_id'] = $embarc->embarcacao_modelos_id;
		//$params[':embarcacao_fabricantes_id'] = $embarc->embarcacao_fabricantes_id;
		$criteria_semelhantes->params = $params;

		$embarcacoes_semelhantes = Embarcacoes::model()->findAll($criteria_semelhantes);

		

		// redirecionar para tela das embarcações comparadas
		$barcos_comparados = Comparador::listarBarcos();
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/comparador.js', CClientScript::POS_END);

	
		// renderizar pagina de comparações
		$this->render('comparacoes', array('embarcacoes_semelhantes'=>$embarcacoes_semelhantes, 'barcos_comparados'=>$barcos_comparados));

		
	}

	public function actionDelete() {
		
		$id = (int)$_POST['id'];
		$model = Comparador::model()->find('status = 1 and embarcacoes_id=:embarcacoes_id and sessaotoken =:sessaotoken', array(':embarcacoes_id'=>$id, ':sessaotoken'=>Yii::app()->session->sessionID));
		$model->status = 0;

		// ok
		if($model->update()) {
			echo '1';
		}

		// erro
		else {
			echo '-1';
		}
	}



	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Comparador'),
		));
	}

	public function actionCreate() {
		$model = new Comparador;


		if (isset($_POST['Comparador'])) {
			$model->setAttributes($_POST['Comparador']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Comparador');


		if (isset($_POST['Comparador'])) {
			$model->setAttributes($_POST['Comparador']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}


	
	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Comparador');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Comparador('search');
		$model->unsetAttributes();

		if (isset($_GET['Comparador']))
			$model->setAttributes($_GET['Comparador']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}