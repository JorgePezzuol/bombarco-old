<?php

class MobileController extends GxController {

	public function init() {
		Yii::app()->theme = "bombarco";
	}

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
					'actions'=>array('view', 'teste'),
					'expression'=>'$user->isAdmin()'
					),
				array('deny', 
					'users'=>array('*'),
					),
				);
	}


	public function actionIndex() {

			//$str = EmbarcacaoFabricantes::dropDown('marca', 'brand', 2, 'Marca');
			//echo '<span>'.EmbarcacaoFabricantes::dropDown('marca', 'brand', 2, 'Marca').'</span>';

		$this->render('index234234');
	}

	public function actionTeste() {


		$estaleiros = Empresas::model()->findAll('status = 2 and macros_id = 3');

		$flgAchouPlano = false;

		foreach($estaleiros as $estaleiro) {

			foreach($estaleiro->usuarios['planos'] as $plano) {

				
				if($plano->planos->flag == 'plano_estaleiro' && $plano->status == 2) {
					$flgAchouPlano = true;
				}

			}

			var_dump($flgAchouPlano);
			
		}
	}

	

}