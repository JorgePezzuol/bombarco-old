<?php

class MotorFabricantesController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('admin','delete', 'create', 'update', 'changeStatus', 'view'),
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
			'model' => $this->loadModel($id, 'MotorFabricantes'),
		));
	}

	public function actionCreate() {
		$model = new MotorFabricantes;


		if (isset($_POST['MotorFabricantes'])) {
			$model->setAttributes($_POST['MotorFabricantes']);
			$model->slug = MotorFabricantes::gerarSlug($model);

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
		$model = $this->loadModel($id, 'MotorFabricantes');


		if (isset($_POST['MotorFabricantes'])) {
			$model->setAttributes($_POST['MotorFabricantes']);
			$model->slug = MotorFabricantes::gerarSlug($model);

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
			$this->loadModel($id, 'MotorFabricantes')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdmin() {
		$model = new MotorFabricantes('search');
		$model->unsetAttributes();

		if (isset($_GET['MotorFabricantes']))
			$model->setAttributes($_GET['MotorFabricantes']);

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

		$model = MotorFabricantes::model()->findByPk($id);

		if ($model->status == 0) {
			$model->status = 1;
		} else if ($model->status == 1) {
			$model->status = 0;
		}

		$model->update();
		$this->redirect(Yii::app()->request->urlReferrer);

	}

}