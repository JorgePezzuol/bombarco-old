<?php

Yii::import('application.models._base.BaseEstados');

class Estados extends BaseEstados
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public static function getModelDropDown($form, $model, $nomeCampoCidade) {

		$listData = CHtml::listData(self::model()->findAll(), 'id', 'nome');

		echo $form->dropDownList($model,'estados_id', $listData,
			array(
				'prompt'=>'Estado',
				'ajax' => array(
					'type'=>'POST', 
					'url'=>Yii::app()->createUrl('utils/loadcities'),
					'update'=>'#'.$nomeCampoCidade,
					'data'=>array('estados_id'=>'js:this.value')
				),
			)
		);

	}

	/**
	 * Drop Down de Estados
	 * @param  string $uf [ID do estado selecionado]
	 * @return [type]     [description]
	 */
	public static function dropDown_($uf = '', $html_options = array()) {

		$listData = CHtml::listData(self::model()->findAll(), 'id', 'nome');
		$listData = array('0'=>'Todos os Estados') + $listData;

		$html_options['empty'] = array('-1'=>'Estado');
		//$html_options['id'] = 'select-listagem4';
                 $html_options['class'] = 'select-search search-home';
                  //$html_options['style'] = 'width: 235px';

		echo CHtml::dropDownList('uf', $uf, $listData, $html_options);

	}
        
        /**
	 * Drop Down de Estados
	 * @param  string $uf [ID do estado selecionado]
	 * @return [type]     [description]
	 */
	public static function dropDown($uf = '', $html_options = array()) {

		$listData = CHtml::listData(self::model()->findAll(), 'id', 'nome');
		$listData = array('0'=>'Todos os Estados') + $listData;

		$html_options['empty'] = array('-1'=>'Estado');
		$html_options['id'] = 'select-listagem4';
                

		echo CHtml::dropDownList('uf', $uf, $listData, $html_options);

	}
}