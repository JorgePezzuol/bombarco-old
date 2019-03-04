<?php

class MinhaContaController extends GxController {

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
				array('allow',
					'actions'=>array(),
					'users'=>array('*'),
					),
				array('allow', 
					'actions'=>array('index'),
					'expression'=>array('@'),
					),
				array('deny', 
					'users'=>array('*'),
					),
				);
	}



	public function actionIndex() {
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->theme->baseUrl . '/js/minhaconta_layout.js');
		$this->render('index');
	}


}