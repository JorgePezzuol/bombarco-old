<?php

class RedirectsController extends GxController {

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
				array('allow', 
						'actions'=>array('index','view','admin','delete','minicreate','create','update'),
						'expression'=>'$user->isAdmin()'
						),
				array('deny', 
					'users'=>array('*'),
					),
				);
	}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Redirects'),
		));
	}

	public function actionCreate() {
		$model = new Redirects;


		if (isset($_POST['Redirects'])) {
			$model->setAttributes($_POST['Redirects']);

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
		$model = $this->loadModel($id, 'Redirects');


		if (isset($_POST['Redirects'])) {
			$model->setAttributes($_POST['Redirects']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		$this->loadModel($id, 'Redirects')->delete();

		if (!Yii::app()->getRequest()->getIsAjaxRequest())
			$this->redirect(array('admin'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('Redirects');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new Redirects('search');
		$model->unsetAttributes();

		if (isset($_GET['Redirects']))
			$model->setAttributes($_GET['Redirects']);

		$this->render('admin', array(
			'model' => $model,
		));
	}


	/**
	 * Action que altera o Status
	 * Se estiver Ativado, desativa
	 * Se estiver Desativado, ativa
	 * @param  [type] $id [ID do Modelo]
	 * @return [type]     [description]
	 */
	public function actionChangeStatus($id) {

		$model = Redirects::model()->findByPk($id);

		if ($model->status == 0) {
			$model->status = 1;
		} else if ($model->status == 1) {
			$model->status = 0;
		}

		$model->update();
		$this->redirect(Yii::app()->request->urlReferrer);

	}

}