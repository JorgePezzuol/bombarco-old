<?php

Yii::import('application.models._base.BaseEmbarcacaoMacros');

class EmbarcacaoMacros extends BaseEmbarcacaoMacros
{

	public static $macro = array(0 => 'Sem Macro', 1 => 'Jet skis', 2 => 'Lanchas', 3 => 'Veleiros', 4 => 'Barcos de Pesca');
	public static $macro_singular = array(0 => 'Sem Macro', 1 => 'Jet ski', 2 => 'Lancha', 3 => 'Veleiro', 4 => 'Barco de Pesca');
	public static $macro_by_slug = array('jetski' => 1, 'lancha' => 2, 'veleiro' => 3, 'barcos-pesca' => 4);
	public static $_macros = array(
								0 => array('slug'=>'sem-macro', 'condition'=>array('N'=>'novos','U'=>'usados')),
								1 => array('slug'=>'jet-skis', 'condition'=>array('N'=>'novos','U'=>'usados')),
								2 => array('slug'=>'lanchas', 'condition'=>array('N'=>'novas','U'=>'usadas')),
								3 => array('slug'=>'veleiros', 'condition'=>array('N'=>'novos','U'=>'usados')),
								4 => array('slug'=>'barcos-pesca', 'condition'=>array('N'=>'novos','U'=>'usados')),
							);

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}