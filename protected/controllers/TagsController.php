<?php

class TagsController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('minicreate', 'create','update'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('admin','delete','view'),
				'users'=>array('admin'),
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Tags'),
		));
	}

	public function actionCreate() {
		$model = new Tags;


		if (isset($_POST['Tags'])) {
			$model->setAttributes($_POST['Tags']);
			$relatedData = array(
				'agendases' => $_POST['Tags']['agendases'] === '' ? null : $_POST['Tags']['agendases'],
				'conteudoses' => $_POST['Tags']['conteudoses'] === '' ? null : $_POST['Tags']['conteudoses'],
				'embarcacoes' => $_POST['Tags']['embarcacoes'] === '' ? null : $_POST['Tags']['embarcacoes'],
				);

			if ($model->saveWithRelated($relatedData)) {
				if (Yii::app()->getRequest()->getIsAjaxRequest())
					Yii::app()->end();
				else
					$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Tags');


		if (isset($_POST['Tags'])) {
			$model->setAttributes($_POST['Tags']);
			$relatedData = array(
				'agendases' => $_POST['Tags']['agendases'] === '' ? null : $_POST['Tags']['agendases'],
				'conteudoses' => $_POST['Tags']['conteudoses'] === '' ? null : $_POST['Tags']['conteudoses'],
				'embarcacoes' => $_POST['Tags']['embarcacoes'] === '' ? null : $_POST['Tags']['embarcacoes'],
				);

			if ($model->saveWithRelated($relatedData)) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Tags')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
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