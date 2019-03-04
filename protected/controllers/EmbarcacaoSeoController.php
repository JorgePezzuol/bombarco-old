<?php

class EmbarcacaoSeoController extends GxController {

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
			'model' => $this->loadModel($id, 'EmbarcacaoSeo'),
		));
	}

	public function actionCreate() {
		$model = new EmbarcacaoSeo;


		if (isset($_POST['EmbarcacaoSeo'])) {
			$model->setAttributes($_POST['EmbarcacaoSeo']);

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
		$model = $this->loadModel($id, 'EmbarcacaoSeo');


		if (isset($_POST['EmbarcacaoSeo'])) {
			$model->setAttributes($_POST['EmbarcacaoSeo']);

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
			$this->loadModel($id, 'EmbarcacaoSeo')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdmin() {
		$model = new EmbarcacaoSeo('search');
		$model->unsetAttributes();

		if (isset($_GET['EmbarcacaoSeo']))
			$model->setAttributes($_GET['EmbarcacaoSeo']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}