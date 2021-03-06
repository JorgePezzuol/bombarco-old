<?php

/**
 * This is the model base class for the table "verificacoes_transacoes_boleto".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "VerificacoesTransacoesBoleto".
 *
 * Columns in table "verificacoes_transacoes_boleto" available as properties of the model,
 * followed by relations of table "verificacoes_transacoes_boleto" available as properties of the model.
 *
 * @property integer $id
 * @property integer $transacoes_id
 * @property string $hora
 *
 * @property Transacoes $transacoes
 */
abstract class BaseVerificacoesTransacoesBoleto extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'verificacoes_transacoes_boleto';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'VerificacoesTransacoesBoleto|VerificacoesTransacoesBoletos', $n);
	}

	public static function representingColumn() {
		return 'hora';
	}

	public function rules() {
		return array(
			array('transacoes_id, hora', 'required'),
			array('transacoes_id', 'numerical', 'integerOnly'=>true),
			array('id, transacoes_id, hora', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'transacoes' => array(self::BELONGS_TO, 'Transacoes', 'transacoes_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'transacoes_id' => null,
			'hora' => Yii::t('app', 'Hora'),
			'transacoes' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('transacoes_id', $this->transacoes_id);
		$criteria->compare('hora', $this->hora, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}