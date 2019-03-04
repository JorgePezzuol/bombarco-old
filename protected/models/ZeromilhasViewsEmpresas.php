<?php

Yii::import('application.models._base.BaseZeromilhasViewsEmpresas');

class ZeromilhasViewsEmpresas extends BaseZeromilhasViewsEmpresas
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public static function salvar($embarcacoes) {

		foreach($embarcacoes as $emb) {

			$id_usuario = UsuariosEmbarcacoes::model()->find("embarcacoes_id=:id", array(":id"=>$emb->id))->usuarios_id;
        	$estaleiro = Empresas::model()->find("usuarios_id=:id and macros_id = 3", array(":id"=>$id_usuario));

        	if($estaleiro != null) {

        		$view = new ZeromilhasViewsEmpresas();
	        	$view->id_empresa = $estaleiro->id;
	        	$view->data = date('Y-m-d H:i:s');
	        	$view->save();
        	}


		}
	}
}