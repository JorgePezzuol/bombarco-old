<?php

Yii::import('application.models._base.BasePlanosUsuariosRenovados');

class PlanosUsuariosRenovados extends BasePlanosUsuariosRenovados
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	// true => ja existe uma renovacao (nao finalizada)
	// false => nao existe
	public static function consultar($plano_usuarios_id) {

		return PlanosUsuariosRenovados::model()->find("plano_usuarios_id_atual=:plano_usuarios AND status <> :status", array(":plano_usuarios"=>$plano_usuarios_id, ":status"=>Anuncio::$_status_plano["RENOVACAO_CONCLUIDA"]));
	}
}