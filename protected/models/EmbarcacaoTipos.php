<?php

Yii::import('application.models._base.BaseEmbarcacaoTipos');

class EmbarcacaoTipos extends BaseEmbarcacaoTipos
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function attributeLabels() {

		$attributeLabels = parent::attributeLabels();
		$attributeLabels['embarcacao_macros_id'] = 'Categoria';

		return $attributeLabels;
	}

	public function beforeValidate() {

		/*
		 * Gerando o SLUG
		 * fazendo validacão no banco pra ver se o slug já existe
		 */		
		$this->slug = parent::slugifing($this->titulo, $this);

		return parent::beforeValidate();
	}


	/**
	 * Retorna o DropDown de Tipos
	 * @param  [type] $id [ID da Macro para filtrar]
	 * @return [type]           [description]
	 */
	public static function dropDown($input_name, $input_id, $id = null, $placeholder = 'Selecione', $selected = '', $html_options = array()) {

		if ($id == null) {
			$fabricantes = self::model()->findAll();
		} else {
			$fabricantes = self::model()->findAll('embarcacao_macros_id = :id', array(':id'=>$id));
		}

		$data = CHtml::listData($fabricantes,'id','titulo');
		$html_options['id'] = $input_id;
		$html_options['empty'] = array('-1' => $placeholder);

		return CHtml::dropDownList($input_name, $selected, $data, $html_options);
	}


	/**
	 * Retorna a lista de Tipos
	 * @param  [type] $id_macro [description]
	 * @return [type]           [description]
	 */
	public static function listTypes($id_macro = null, $tipos_checkeds = null) {

		if ($id_macro == null) {
			$tipos = self::model()->findAll();
		} else {
			$tipos = self::model()->findAll('embarcacao_macros_id = :id', array(':id'=>$id_macro));
		}

		$list = '';

		foreach ($tipos as $key => $value) {

			$checked = '';

			if ($tipos_checkeds != null && $tipos != null && in_array($value->slug, $tipos_checkeds)) {
				$checked = 'checked';
			}
			
			$list .= '<li class="category-listagem–linha-mf">		
	 					
	 					<div class="checkbox1-l1">
							<input type="checkbox" name="tipos[]" id="cb-list-l1" class="checkl1" value="' . $value->slug . '" ' . $checked . '>
						</div>	
						
						<div class="div-text-checkbox-linha-mf">
							<span class="text-checkbox-linha-mf">' . $value->titulo . '</span>
						</div>

					</li>';

		}

		return $list;

	}

}