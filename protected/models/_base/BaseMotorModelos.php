<?php

/**
 * This is the model base class for the table "motor_modelos".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "MotorModelos".
 *
 * Columns in table "motor_modelos" available as properties of the model,
 * followed by relations of table "motor_modelos" available as properties of the model.
 *
 * @property integer $id
 * @property integer $embarcacao_macros_id
 * @property integer $motor_fabricantes_id
 * @property integer $motor_tipos_id
 * @property string $titulo
 * @property string $potencia
 * @property integer $combustivel
 * @property integer $status
 * @property string $dataregistro
 *
 * @property EmbarcacaoMacros $embarcacaoMacros
 * @property MotorFabricantes $motorFabricantes
 * @property MotorTipos $motorTipos
 * @property Motores[] $motores
 */
abstract class BaseMotorModelos extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'motor_modelos';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'MotorModelos|MotorModeloses', $n);
	}

	public static function representingColumn() {
		return 'titulo';
	}

	public function rules() {
		return array(
			array('embarcacao_macros_id, motor_fabricantes_id, motor_tipos_id, titulo', 'required'),
			array('embarcacao_macros_id, motor_fabricantes_id, motor_tipos_id, combustivel, status', 'numerical', 'integerOnly'=>true),
			array('titulo', 'length', 'max'=>45),
			array('potencia', 'length', 'max'=>150),
			array('dataregistro', 'safe'),
			array('potencia, combustivel, status, dataregistro', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, embarcacao_macros_id, motor_fabricantes_id, motor_tipos_id, titulo, potencia, combustivel, status, dataregistro', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'embarcacaoMacros' => array(self::BELONGS_TO, 'EmbarcacaoMacros', 'embarcacao_macros_id'),
			'motorFabricantes' => array(self::BELONGS_TO, 'MotorFabricantes', 'motor_fabricantes_id'),
			'motorTipos' => array(self::BELONGS_TO, 'MotorTipos', 'motor_tipos_id'),
			'motores' => array(self::HAS_MANY, 'Motores', 'motor_modelos_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'embarcacao_macros_id' => null,
			'motor_fabricantes_id' => null,
			'motor_tipos_id' => null,
			'titulo' => Yii::t('app', 'Titulo'),
			'potencia' => Yii::t('app', 'Potencia'),
			'combustivel' => Yii::t('app', 'Combustivel'),
			'status' => Yii::t('app', 'Status'),
			'dataregistro' => Yii::t('app', 'Dataregistro'),
			'embarcacaoMacros' => null,
			'motorFabricantes' => null,
			'motorTipos' => null,
			'motores' => null,
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

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}