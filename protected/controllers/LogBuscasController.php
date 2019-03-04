<?php

class LogBuscasController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('admin','delete','minicreate', 'create','update', 'view'),
				'expression'=>'$user->isAdmin()'
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'LogBuscas'),
		));
	}

	public function actionCreate() {
		$model = new LogBuscas;


		if (isset($_POST['LogBuscas'])) {
			$model->setAttributes($_POST['LogBuscas']);

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
		$model = $this->loadModel($id, 'LogBuscas');


		if (isset($_POST['LogBuscas'])) {
			$model->setAttributes($_POST['LogBuscas']);

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
			$this->loadModel($id, 'LogBuscas')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdmin() {
		$model = new LogBuscas('search');
		$model->unsetAttributes();

		if (isset($_GET['LogBuscas']))
			$model->setAttributes($_GET['LogBuscas']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}