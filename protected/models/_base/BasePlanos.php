<?php

/**
 * This is the model base class for the table "planos".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Planos".
 *
 * Columns in table "planos" available as properties of the model,
 * followed by relations of table "planos" available as properties of the model.
 *
 * @property integer $id
 * @property integer $macros_id
 * @property string $flag
 * @property string $titulo
 * @property string $duracaomeses
 * @property string $limitepreco
 * @property string $valor
 * @property integer $qntpermitida
 * @property integer $status
 * @property integer $gratuito
 *
 * @property PlanoUsuarios[] $planoUsuarioses
 * @property Macros $macros
 */
abstract class BasePlanos extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'planos';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Planos|Planoses', $n);
	}

	public static function representingColumn() {
		return 'titulo';
	}

	public function rules() {
		return array(
			array('macros_id, titulo', 'required'),
			array('macros_id, qntpermitida, status, gratuito', 'numerical', 'integerOnly'=>true),
			array('flag', 'length', 'max'=>30),
			array('titulo', 'length', 'max'=>150),
			array('duracaomeses', 'length', 'max'=>45),
			array('limitepreco, valor', 'length', 'max'=>10),
			array('flag, duracaomeses, limitepreco, valor, qntpermitida, status, gratuito', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, macros_id, flag, titulo, duracaomeses, limitepreco, valor, qntpermitida, status, gratuito', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'planoUsuarioses' => array(self::HAS_MANY, 'PlanoUsuarios', 'planos_id'),
			'macros' => array(self::BELONGS_TO, 'Macros', 'macros_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'macros_id' => null,
			'flag' => Yii::t('app', 'Flag'),
			'titulo' => Yii::t('app', 'Titulo'),
			'duracaomeses' => Yii::t('app', 'Duracaomeses'),
			'limitepreco' => Yii::t('app', 'Limitepreco'),
			'valor' => Yii::t('app', 'Valor'),
			'qntpermitida' => Yii::t('app', 'Qntpermitida'),
			'status' => Yii::t('app', 'Status'),
			'gratuito' => Yii::t('app', 'Gratuito'),
			'planoUsuarioses' => null,
			'macros' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('macros_id', $this->macros_id);
		$criteria->compare('flag', $this->flag, true);
		$criteria->compare('titulo', $this->titulo, true);
		$criteria->compare('duracaomeses', $this->duracaomeses, true);
		$criteria->compare('limitepreco', $this->limitepreco, true);
		$criteria->compare('valor', $this->valor, true);
		$criteria->compare('qntpermitida', $this->qntpermitida);
		$criteria->compare('status', $this->status);
		$criteria->compare('gratuito', $this->gratuito);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}