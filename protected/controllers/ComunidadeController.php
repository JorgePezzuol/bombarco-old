<?php

class ComunidadeController extends GxController
{

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
				array('allow',
					'actions'=>array('index'),
					'users'=>array('*'),
					),
				array('allow', 
					'actions'=>array(),
					'users'=>array('@'),
					),
				array('allow', 
					'actions'=>array(),
					'users'=>array('admin'),
					),
				array('deny', 
					'users'=>array('*'),
					),
				);
	}

	/**
	 * Página principal de Comunidades
	 * @return [type] [description]
	 */
	public function actionIndex() {
		$this->render('index');
	}

	/**
	 * Tela principal da Agenda
	 * @return [type] [description]
	 */
	public function actionAgenda() {
		$this->render('agenda');
	}


} // fim