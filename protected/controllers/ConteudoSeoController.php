<?php

class ConteudoSeoController extends GxController {

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
				array('allow', 
					'actions'=>array('admin','delete','view','minicreate', 'create','update'),
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
			'model' => $this->loadModel($id, 'ConteudoSeo'),
		));
	}

	public function actionCreate() {
		$model = new ConteudoSeo;


		if (isset($_POST['ConteudoSeo'])) {
			$model->setAttributes($_POST['ConteudoSeo']);

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
		$model = $this->loadModel($id, 'ConteudoSeo');


		if (isset($_POST['ConteudoSeo'])) {
			$model->setAttributes($_POST['ConteudoSeo']);

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
			$this->loadModel($id, 'ConteudoSeo')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdmin() {
		$model = new ConteudoSeo('search');
		$model->unsetAttributes();

		if (isset($_GET['ConteudoSeo']))
			$model->setAttributes($_GET['ConteudoSeo']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}