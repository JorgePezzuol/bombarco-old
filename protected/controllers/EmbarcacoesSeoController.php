<?php

class EmbarcacoesSeoController extends GxController {

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
				array('allow', 
					'actions'=>array('admin','delete','view','minicreate', 'create','update'),
					'users'=>array('admin'),
					),
				array('deny', 
					'users'=>array('*'),
					),
				);
	}


	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'EmbarcacoesSeo'),
		));
	}

	public function actionCreate() {
		$model = new EmbarcacoesSeo;


		if (isset($_POST['EmbarcacoesSeo'])) {
			$model->setAttributes($_POST['EmbarcacoesSeo']);

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
		$model = $this->loadModel($id, 'EmbarcacoesSeo');


		if (isset($_POST['EmbarcacoesSeo'])) {
			$model->setAttributes($_POST['EmbarcacoesSeo']);

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
			$this->loadModel($id, 'EmbarcacoesSeo')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdmin() {
		$model = new EmbarcacoesSeo('search');
		$model->unsetAttributes();

		if (isset($_GET['EmbarcacoesSeo']))
			$model->setAttributes($_GET['EmbarcacoesSeo']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}