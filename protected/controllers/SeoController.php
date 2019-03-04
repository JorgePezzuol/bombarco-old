<?php

class SeoController extends GxController {

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
				array('allow', 
						'actions'=>array('index','view','admin','delete','minicreate','create','update'),
						'expression'=> function() {
		                    if(Yii::app()->user->isSeo() || Yii::app()->user->isAdmin()) {
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
			'model' => $this->loadModel($id, 'Seo'),
		));
	}

	public function actionCreate() {
		$model = new Seo;


		if (isset($_POST['Seo'])) {

			$model->setAttributes($_POST['Seo']);

			if (Seo::model()->exists('url=:url', array(':url' => $model->url))) {
                Yii::app()->user->setFlash('danger', "URL já existe!");
            }
            else {
            	$model->save();
            	Yii::app()->user->setFlash('success', "Sucesso!");
            }
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Seo');


		if (isset($_POST['Seo'])) {

			$model->setAttributes($_POST['Seo']);

            if($model->update()) {
            	Yii::app()->user->setFlash('success', "Sucesso!");	
            }
            else {
            	Yii::app()->user->setFlash('danger', "Ocorreu um erro inesperado");
            }
            
            
		}

		$this->render('update', array( 'model' => $model));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Seo')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Seo');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Seo('search');
		$model->unsetAttributes();

		if (isset($_GET['Seo'])) 
			$model->setAttributes($_GET['Seo']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}