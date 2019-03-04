<?php

/**
 * This is the model base class for the table "conteudos_has_tags".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ConteudosHasTags".
 *
 * Columns in table "conteudos_has_tags" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $conteudos_id
 * @property integer $tags_id
 *
 */
abstract class BaseConteudosHasTags extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'conteudos_has_tags';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'ConteudosHasTags|ConteudosHasTags', $n);
	}

	public static function representingColumn() {
		return array(
			'conteudos_id',
			'tags_id',
		);
	}

	public function rules() {
		return array(
			array('conteudos_id, tags_id', 'required'),
			array('conteudos_id, tags_id', 'numerical', 'integerOnly'=>true),
			array('conteudos_id, tags_id', 'safe', 'on'=>'search'),
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
			'conteudos_id' => null,
			'tags_id' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('conteudos_id', $this->conteudos_id);
		$criteria->compare('tags_id', $this->tags_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}