<?php

/**
 * This is the model base class for the table "embarcacao_metricas".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EmbarcacaoMetricas".
 *
 * Columns in table "embarcacao_metricas" available as properties of the model,
 * followed by relations of table "embarcacao_metricas" available as properties of the model.
 *
 * @property integer $id
 * @property integer $embarcacoes_id
 * @property string $titulo
 * @property string $valor
 * @property string $ultimo
 *
 * @property Embarcacoes $embarcacoes
 */
abstract class BaseEmbarcacaoMetricas extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'embarcacao_metricas';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'EmbarcacaoMetricas|EmbarcacaoMetricases', $n);
	}

	public static function representingColumn() {
		return 'titulo';
	}

	public function rules() {
		return array(
			array('embarcacoes_id, titulo, ultimo', 'required'),
			array('embarcacoes_id', 'numerical', 'integerOnly'=>true),
			array('titulo', 'length', 'max'=>45),
			array('valor', 'length', 'max'=>20),
			array('valor', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, embarcacoes_id, titulo, valor, ultimo', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'embarcacoes' => array(self::BELONGS_TO, 'Embarcacoes', 'embarcacoes_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'embarcacoes_id' => null,
			'titulo' => Yii::t('app', 'Titulo'),
			'valor' => Yii::t('app', 'Valor'),
			'ultimo' => Yii::t('app', 'Ultimo'),
			'embarcacoes' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('embarcacoes_id', $this->embarcacoes_id);
		$criteria->compare('titulo', $this->titulo, true);
		$criteria->compare('valor', $this->valor, true);
		$criteria->compare('ultimo', $this->ultimo, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}