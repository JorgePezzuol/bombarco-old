<?php

class EmbarcacaoAcessoriosController extends GxController {

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
				array('allow', 
					'actions'=>array('minicreate', 'create','update', 'admin', 'delete', 'view'),
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
			'model' => $this->loadModel($id, 'EmbarcacaoAcessorios'),
		));
	}

	public function actionCreate() {
		$model = new EmbarcacaoAcessorios;


		if (isset($_POST['EmbarcacaoAcessorios'])) {
			$model->setAttributes($_POST['EmbarcacaoAcessorios']);

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
		$model = $this->loadModel($id, 'EmbarcacaoAcessorios');


		if (isset($_POST['EmbarcacaoAcessorios'])) {
			$model->setAttributes($_POST['EmbarcacaoAcessorios']);

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
			$this->loadModel($id, 'EmbarcacaoAcessorios')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdmin() {
		$model = new EmbarcacaoAcessorios('search');
		$model->unsetAttributes();

		if (isset($_GET['EmbarcacaoAcessorios']))
			$model->setAttributes($_GET['EmbarcacaoAcessorios']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}