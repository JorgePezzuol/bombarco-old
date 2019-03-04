<?php

/**
 * This is the model base class for the table "bombarcoshop_produtos_fotos".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "BombarcoshopFotos".
 *
 * Columns in table "bombarcoshop_produtos_fotos" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property integer $id_produto
 * @property string $imagem
 * @property integer $principal
 * @property integer $status
 *
 */
abstract class BaseBombarcoshopFotos extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'bombarcoshop_produtos_fotos';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'BombarcoshopFotos|BombarcoshopFotoses', $n);
	}

	public static function representingColumn() {
		return 'imagem';
	}

	public function rules() {
		return array(
			array('id_produto, imagem', 'required'),
			array('id_produto, principal, status', 'numerical', 'integerOnly'=>true),
			array('imagem', 'length', 'max'=>120),
			array('principal, status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, id_produto, imagem, principal, status', 'safe', 'on'=>'search'),
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
			'id' => Yii::t('app', 'ID'),
			'id_produto' => Yii::t('app', 'Id Produto'),
			'imagem' => Yii::t('app', 'Imagem'),
			'principal' => Yii::t('app', 'Principal'),
			'status' => Yii::t('app', 'Status'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('id_produto', $this->id_produto);
		$criteria->compare('imagem', $this->imagem, true);
		$criteria->compare('principal', $this->principal);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}