<?php

class MotoresController extends GxController {

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
				array('allow', 
						'actions'=>array('index','view','admin','delete','minicreate','create','update','changestatus'),
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
			'model' => $this->loadModel($id, 'Motores'),
		));
	}

	public function actionCreate() {
		$model = new Motores;


		if (isset($_POST['Motores'])) {
			$model->setAttributes($_POST['Motores']);

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
		$model = $this->loadModel($id, 'Motores');


		if (isset($_POST['Motores'])) {
			$model->setAttributes($_POST['Motores']);

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
			$this->loadModel($id, 'Motores')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Motores');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Motores('search');
		$model->unsetAttributes();

		if (isset($_GET['Motores']))
			$model->setAttributes($_GET['Motores']);

		$this->render('admin', array(
			'model' => $model,
		));
	}


	/**
	 * Action que altera o Status
	 * Se estiver Ativado, desativa
	 * Se estiver Desativado, ativa
	 * @param  [type] $id [ID]
	 * @return [type]     [description]
	 */
	public function actionChangeStatus($id) {

		$model = Motores::model()->findByPk($id);

		if ($model->status == 0) {
			$model->status = 1;
		} else if ($model->status == 1) {
			$model->status = 0;
		}

		$model->update();
		$this->redirect(Yii::app()->request->urlReferrer);

	}

}