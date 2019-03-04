<?php

Yii::import('application.models._base.BaseMotorModelos');

class MotorModelos extends BaseMotorModelos
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function beforeSave() {

		if($this->isNewRecord && self::model()->exists('titulo=:titulo and motor_fabricantes_id =:motor_fabricantes_id and potencia=:potencia', array(':titulo'=>$this->titulo, ':motor_fabricantes_id'=>$this->motor_fabricantes_id, ':potencia'=>$this->potencia))) {
			$this->addError('titulo', 'Modelo de motor já existe!');
			return false;
		}

		return parent::beforeSave();
	}

	public function beforeValidate() {

		if($this->motor_fabricantes_id == "") {
			$this->addError('motor_fabricantes_id', 'Selecione um fabricante de motor válido');
		}

		if($this->embarcacao_macros_id == "") {
			$this->addError('embarcacao_macros_id', 'Selecione uma categoria de embarcação válida');

		}

		return parent::beforeValidate();
	}

	public static function getDropDownPotencia() {

		$model = self::model()->findAll('id=:id', array(':id'=>$motor_marcas_id+1));

		echo CHtml::dropDownList('Embarcacoes_motor_potencia','', $model,
			array(
				'prompt'=>'Potência',
				'ajax' => array(
					'type'=>'POST', 
					'url'=>Yii::app()->createUrl('utils/loadMotoresModelos'),
					'update'=>'#'.$nomeCampoModelosMotor,
					'data'=>array('motor_marcas_id'=>'js:$("#Embarcacoes_motor_modelo").val()')
				)
			)
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('embarcacao_macros_id', $this->embarcacao_macros_id);
		$criteria->compare('motor_fabricantes_id', $this->motor_fabricantes_id);
		$criteria->compare('motor_tipos_id', $this->motor_tipos_id);
		$criteria->compare('titulo', $this->titulo, true);
		$criteria->compare('potencia', $this->potencia, true);
		$criteria->compare('combustivel', $this->combustivel);
		$criteria->compare('status', $this->status);
		$criteria->compare('dataregistro', $this->dataregistro, true);
		$criteria->order = 'id desc';

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}