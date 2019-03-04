<?php

Yii::import('application.models._base.BaseZeromilhasViewsModelos');

class ZeromilhasViewsModelos extends BaseZeromilhasViewsModelos
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public static function totalizarClicks($id_embarcacao, $parametros) {

		$condition = "t.data between NOW() - INTERVAL 30 DAY AND NOW()";

        if($parametros != null) {
            if(isset($parametros["periodo"])) {
            	$condition = "t.data between NOW() - INTERVAL ".$parametros['periodo']." DAY AND NOW()";
            }
            else {
	           	$data_de = $parametros["de"];
	            $data_ate = $parametros["ate"];
	            $condition = "t.data between '".$data_de."' AND '".$data_ate."'";
            }
        }

        return ZeromilhasViewsModelos::model()->count('id_modelo = :id and '.$condition, array(":id"=>$id_embarcacao));
	}

	public static function totalizarMensagens($id_embarcacao, $parametros) {

		$condition = "t.data between NOW() - INTERVAL 30 DAY AND NOW()";

        if($parametros != null) {
            if(isset($parametros["periodo"])) {
            	$condition = "t.data between NOW() - INTERVAL ".$parametros['periodo']." DAY AND NOW()";
            }
            else {
	           	$data_de = $parametros["de"];
	            $data_ate = $parametros["ate"];
	            $condition = "t.data between '".$data_de."' AND '".$data_ate."'";
            }
        }
		
		return Contatos::model()->with('embarcacoes')->count('usuarios_id_dest=:user and embarcacoes.id=:embid and '.$condition, array(':user' => Yii::app()->user->id, ':embid' => $id_embarcacao));
	}
}