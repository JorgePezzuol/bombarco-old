<?php

/**
 * This is the model base class for the table "zeromilhas_views_modelos".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ZeromilhasViewsModelos".
 *
 * Columns in table "zeromilhas_views_modelos" available as properties of the model,
 * followed by relations of table "zeromilhas_views_modelos" available as properties of the model.
 *
 * @property integer $id
 * @property integer $id_modelo
 * @property string $data
 *
 * @property EmbarcacaoModelos $idModelo
 */
abstract class BaseZeromilhasViewsModelos extends GxActiveRecord {

	public $total;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'zeromilhas_views_modelos';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'ZeromilhasViewsModelos|ZeromilhasViewsModeloses', $n);
	}

	public static function representingColumn() {
		return 'data';
	}

	public function rules() {
		return array(
			array('id_modelo, total', 'numerical', 'integerOnly'=>true),
			array('data, total', 'safe'),
			array('id_modelo, data, total', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, id_modelo, data, total', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'embarcacao' => array(self::BELONGS_TO, 'Embarcacoes', 'id_modelo'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'id_modelo' => null,
			'data' => Yii::t('app', 'Data'),
			'modelo' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('id_modelo', $this->id_modelo);
		$criteria->compare('data', $this->data, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}