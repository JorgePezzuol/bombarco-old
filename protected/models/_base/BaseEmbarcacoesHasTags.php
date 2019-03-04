<?php

/**
 * This is the model base class for the table "embarcacoes_has_tags".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EmbarcacoesHasTags".
 *
 * Columns in table "embarcacoes_has_tags" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $embarcacoes_id
 * @property integer $tags_id
 *
 */
abstract class BaseEmbarcacoesHasTags extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'embarcacoes_has_tags';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'EmbarcacoesHasTags|EmbarcacoesHasTags', $n);
	}

	public static function representingColumn() {
		return array(
			'embarcacoes_id',
			'tags_id',
		);
	}

	public function rules() {
		return array(
			array('embarcacoes_id, tags_id', 'required'),
			array('embarcacoes_id, tags_id', 'numerical', 'integerOnly'=>true),
			array('embarcacoes_id, tags_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'embarcacoes_id' => null,
			'tags_id' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('embarcacoes_id', $this->embarcacoes_id);
		$criteria->compare('tags_id', $this->tags_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}