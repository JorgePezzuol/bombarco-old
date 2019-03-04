<?php

Yii::import('application.models._base.BaseAcessorioModelos');

class AcessorioModelos extends BaseAcessorioModelos
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	// método que lista os acessorios para jetski
	public static function listarAcessoriosJetSki() {
		$acessorios = self::model()->findAll('embarcacao_macros_id=1 AND status=1');

		if(count($acessorios) > 0)
			return $acessorios;
		else
			return null;
	}

	// método que lista acessorios para lanchas
	public static function listarAcessoriosLancha() {
		$acessorios = self::model()->findAll('embarcacao_macros_id=2 AND status=1');

		if(count($acessorios) > 0)
			return $acessorios;
		else
			return null;
	}

	// método que lista acessorios para veleiros
	public static function listarAcessoriosVeleiro() {
		$acessorios = self::model()->findAll('(embarcacao_macros_id=2 OR embarcacao_macros_id=3) AND status=1');

		if(count($acessorios) > 0)
			return $acessorios;
		else
			return  null;
	}

	// método que lista acessorios para pesca
	public static function listarAcessoriosPesca() {
		$acessorios = self::model()->findAll('(embarcacao_macros_id=2 OR embarcacao_macros_id=4) AND status=1');

		if(count($acessorios) > 0)
			return $acessorios;
		else
			return  null;
	}
}