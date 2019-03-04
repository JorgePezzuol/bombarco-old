<?php

class AgendasController extends GxController {

	public function filters() {
		return array(
				'accessControl',
				);
	}

	public function accessRules() {
		return array(
				array('allow',
					'actions'=>array('index','view','loadmore', 'minicreate','create','update','admin'),
					'users'=>array('*'),
					),
				array('deny',
					'users'=>array('*'),
					),
				);
	}

	public function actionView($slug) {

		$model = Agendas::model()->findByAttributes(array("slug"=>$slug));

		// Breadcrumbs
		$breadcrumbs[] = array('texto'=>'Home', 'link'=> Yii::app()->homeUrl);
		$breadcrumbs[] = array('texto'=>'Comunidade', 'link'=> Yii::app()->createUrl('comunidade'));
		$breadcrumbs[] = array('texto'=>'Agendas', 'link'=> Yii::app()->createUrl('comunidade/agenda'));
		$breadcrumbs[] = array('texto'=>$model->titulo, 'link' => '#');

		$this->render('view', array(
			'model' => $model,
			'breadcrumbs' => $breadcrumbs
		));
	}

	public function actionCreate() {
		$model = new Agendas;


		if (isset($_POST['Agendas'])) {
			$model->setAttributes($_POST['Agendas']);

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
		$model = $this->loadModel($id, 'Agendas');


		if (isset($_POST['Agendas'])) {
			$model->setAttributes($_POST['Agendas']);

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
			$this->loadModel($id, 'Agendas')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	/**
	 * Página principal de Agendas
	 * @return [type] [description]
	 */
	public function actionIndex() {

		$criteria = new CDbCriteria();
		$criteria->order = "data_inicio DESC";
		$criteria->limit = Agendas::LIMIT_SEARCH;

		$agendas = Agendas::model()->findAll($criteria);

		// scripts
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/agendas.js', CClientScript::POS_END);

		// Breadcrumbs
		$breadcrumbs[] = array('texto'=>'Home', 'link'=> Yii::app()->homeUrl);
		$breadcrumbs[] = array('texto'=>'Comunidade', 'link'=> Yii::app()->createUrl('comunidade'));
		$breadcrumbs[] = array('texto'=>'Agenda', 'link'=> Yii::app()->createUrl('comunidade/agenda'));

		$this->render('index', array(
			'agendas' => $agendas,
			'breadcrumbs' => $breadcrumbs,
		));

	}

	public function actionAdmin() {
		$model = new Agendas('search');
		$model->unsetAttributes();

		if (isset($_GET['Agendas']))
			$model->setAttributes($_GET['Agendas']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

	/**
	 * Carregando mais Agendas via AJAX
	 * @return [type] [description]
	 */
	public function actionLoadMore() {

		$offset = (Yii::app()->request->getParam('page') != null) ? ((int)Yii::app()->request->getParam('page') * Agendas::LIMIT_SEARCH) : null;

		$criteria = new CDbCriteria();
		$criteria->order = "data_inicio DESC";
		$criteria->limit = Agendas::LIMIT_SEARCH;
		$criteria->offset = $offset;

		$agendas = Agendas::model()->findAll($criteria);

		echo CJSON::encode($agendas);
	}

}
