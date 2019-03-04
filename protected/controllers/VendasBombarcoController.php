<?php

class VendasBombarcoController extends GxController {

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
				'actions'=>array('minicreate', 'create','update', 'createAjax'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('admin', 'delete'),
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
			'model' => $this->loadModel($id, 'VendasBombarco'),
		));
	}

	public function actionCreate() {
		$model = new VendasBombarco;

		$this->performAjaxValidation($model, 'vendas-bombarco-form');

		if (isset($_POST['VendasBombarco'])) {
			$model->setAttributes($_POST['VendasBombarco']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionCreateAjax() {

		if(isset($_POST)) {

			$model = new VendasBombarco();
			$model->embarcacoes_id = $_POST["embarcacoes_id"];
			$model->venda_pelo_bombarco = $_POST["simNao"];
			$model->data = date("Y-m-d h:i:s");
			$model->save();
		}
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'VendasBombarco');

		$this->performAjaxValidation($model, 'vendas-bombarco-form');

		if (isset($_POST['VendasBombarco'])) {
			$model->setAttributes($_POST['VendasBombarco']);

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
			$this->loadModel($id, 'VendasBombarco')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('VendasBombarco');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new VendasBombarco('search');
		$model->unsetAttributes();

		if (isset($_GET['VendasBombarco'])) {

			$model->setAttributes($_GET['VendasBombarco']);

			if(isset($_GET["VendasBombarco"]["data_de"]) && isset($_GET["VendasBombarco"]["data_ate"])) {
				$model->data_de = Utils::formatDateTimeToDb($_GET["VendasBombarco"]["data_de"]);
				$model->data_ate = Utils::formatDateTimeToDb($_GET["VendasBombarco"]["data_ate"]);
			}

			if(isset($_GET["pelobb"])) {
				$model->venda_pelo_bombarco = $_GET["pelobb"];
			}
		}

		$this->render('admin', array(
			'model' => $model,
		));
	}


}