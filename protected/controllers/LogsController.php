<?php

class LogsController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('create'),
				'users'=>array('*'),
				),
			array('allow', 
				'actions'=>array('admin','delete','minicreate','update'),
				'expression'=>'$user->isAdmin()'
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Logs'),
		));
	}

	public function actionCreate() {
		$model = new Logs;


		if (isset($_POST['Logs'])) {
			$model->setAttributes($_POST['Logs']);

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
		$model = $this->loadModel($id, 'Logs');


		if (isset($_POST['Logs'])) {
			$model->setAttributes($_POST['Logs']);

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
			$this->loadModel($id, 'Logs')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdmin() {
		$model = new Logs('search');
		$model->unsetAttributes();

		if (isset($_GET['Logs']))
			$model->setAttributes($_GET['Logs']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}