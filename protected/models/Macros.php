<?php

Yii::import('application.models._base.BaseMacros');

class Macros extends BaseMacros
{

	// Macros que definem usuários e empresas
	public static $macro_by_id = array(1 => 'Vendedor', 2 => 'Empresa', 3 => 'Estaleiro');
	public static $macro_by_slug = array('vendedor' => 1, 'empresa' => 2, 'estaleiro' => 3);

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}