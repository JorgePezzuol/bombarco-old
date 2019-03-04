<?php

/**
 * This is the model base class for the table "usuarios_embarcacoes".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "UsuariosEmbarcacoes".
 *
 * Columns in table "usuarios_embarcacoes" available as properties of the model,
 * followed by relations of table "usuarios_embarcacoes" available as properties of the model.
 *
 * @property integer $id
 * @property integer $empresas_id
 * @property integer $usuarios_id
 * @property integer $embarcacoes_id
 *
 * @property Empresas $empresas
 * @property Usuarios $usuarios
 * @property Embarcacoes $embarcacoes
 */
abstract class BaseUsuariosEmbarcacoes extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'usuarios_embarcacoes';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'UsuariosEmbarcacoes|UsuariosEmbarcacoes', $n);
	}

	public static function representingColumn() {
		return 'id';
	}

	public function rules() {
		return array(
			array('usuarios_id, embarcacoes_id', 'required'),
			array('empresas_id, usuarios_id, embarcacoes_id', 'numerical', 'integerOnly'=>true),
			array('empresas_id', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, empresas_id, usuarios_id, embarcacoes_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'empresas' => array(self::BELONGS_TO, 'Empresas', 'empresas_id'),
			'usuarios' => array(self::BELONGS_TO, 'Usuarios', 'usuarios_id'),
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
			'empresas_id' => null,
			'usuarios_id' => null,
			'embarcacoes_id' => null,
			'empresas' => null,
			'usuarios' => null,
			'embarcacoes' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('empresas_id', $this->empresas_id);
		$criteria->compare('usuarios_id', $this->usuarios_id);
		$criteria->compare('embarcacoes_id', $this->embarcacoes_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}