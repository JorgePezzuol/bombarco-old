<?php

class EmpresaCategoriasController extends GxController {

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
			'model' => $this->loadModel($id, 'EmpresaCategorias'),
		));
	}

	public function actionCreate() {
		$model = new EmpresaCategorias;


		if (isset($_POST['EmpresaCategorias'])) {
			$model->setAttributes($_POST['EmpresaCategorias']);

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
		$model = $this->loadModel($id, 'EmpresaCategorias');


		if (isset($_POST['EmpresaCategorias'])) {
			$model->setAttributes($_POST['EmpresaCategorias']);

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
			$this->loadModel($id, 'EmpresaCategorias')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdmin() {
		$model = new EmpresaCategorias('search');
		$model->unsetAttributes();

		if (isset($_GET['EmpresaCategorias']))
			$model->setAttributes($_GET['EmpresaCategorias']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}