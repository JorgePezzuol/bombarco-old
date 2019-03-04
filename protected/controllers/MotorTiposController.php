<?php

class MotorTiposController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow', 
				'actions'=>array('minicreate','create','update','admin','delete', 'changeStatus','view'),
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
			'model' => $this->loadModel($id, 'MotorTipos'),
		));
	}

	public function actionCreate() {
		$model = new MotorTipos;


		if (isset($_POST['MotorTipos'])) {
			$model->setAttributes($_POST['MotorTipos']);

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
		$model = $this->loadModel($id, 'MotorTipos');


		if (isset($_POST['MotorTipos'])) {
			$model->setAttributes($_POST['MotorTipos']);

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
			$this->loadModel($id, 'MotorTipos')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdmin() {

		$seos = Seo::model()->findAll();
		$teste = array();


		do {
			$flg = false;
			for($i = 0; $i < count($seos)-1; $i++) {

				if($seos[$i]->url == $seos[$i+1]->url) {

					$teste[] = $seos[$i];
					$flg = true;
				}
			}

		} while($flg);

		foreach($teste as $t) {
			var_dump($t);
		} 

		exit;

		$model = new MotorTipos('search');
		$model->unsetAttributes();

		if (isset($_GET['MotorTipos']))
			$model->setAttributes($_GET['MotorTipos']);

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

		$model = MotorTipos::model()->findByPk($id);

		if ($model->status == 0) {
			$model->status = 1;
		} else if ($model->status == 1) {
			$model->status = 0;
		}

		$model->update();
		$this->redirect(Yii::app()->request->urlReferrer);

	}

}