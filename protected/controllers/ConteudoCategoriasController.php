<?php

class ConteudoCategoriasController extends GxController {

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
				array('allow', 
					'actions'=>array('admin','delete','minicreate','create','update','view'),
					'expression'=>'$user->isAdmin()'
					),
				array('deny', 
					'users'=>array('*'),
					),
				);
	}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'ConteudoCategorias'),
		));
	}

	public function actionCreate() {
		$model = new ConteudoCategorias;


		if (isset($_POST['ConteudoCategorias'])) {
			$model->setAttributes($_POST['ConteudoCategorias']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'ConteudoCategorias');


		if (isset($_POST['ConteudoCategorias'])) {
			$model->setAttributes($_POST['ConteudoCategorias']);

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
			$this->loadModel($id, 'ConteudoCategorias')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdmin() {
		$model = new ConteudoCategorias('search');
		$model->unsetAttributes();

		if (isset($_GET['ConteudoCategorias']))
			$model->setAttributes($_GET['ConteudoCategorias']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}