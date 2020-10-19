<?php

/**
 * This is the model base class for the table "empresas_has_empresa_recursos_adicionais".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EmpresasHasEmpresaRecursosAdicionais".
 *
 * Columns in table "empresas_has_empresa_recursos_adicionais" available as properties of the model,
 * followed by relations of table "empresas_has_empresa_recursos_adicionais" available as properties of the model.
 *
 * @property integer $id
 * @property integer $empresas_id
 * @property integer $empresa_recursos_adicionais_id
 * @property integer $status
 *
 * @property Empresas $empresas
 * @property EmpresaRecursosAdicionais $empresaRecursosAdicionais
 */
abstract class BaseEmpresasHasEmpresaRecursosAdicionais extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'empresas_has_empresa_recursos_adicionais';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'EmpresasHasEmpresaRecursosAdicionais|EmpresasHasEmpresaRecursosAdicionaises', $n);
	}

	public static function representingColumn() {
		return array(
			'id',
			'empresas_id',
			'empresa_recursos_adicionais_id',
		);
	}

	public function rules() {
		return array(
			array('empresas_id, empresa_recursos_adicionais_id', 'required'),
			array('empresas_id, empresa_recursos_adicionais_id, status', 'numerical', 'integerOnly'=>true),
			array('status', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, empresas_id, empresa_recursos_adicionais_id, status', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'empresas' => array(self::BELONGS_TO, 'Empresas', 'empresas_id'),
			'empresaRecursosAdicionais' => array(self::BELONGS_TO, 'EmpresaRecursosAdicionais', 'empresa_recursos_adicionais_id'),
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
			'empresa_recursos_adicionais_id' => null,
			'status' => Yii::t('app', 'Status'),
			'empresas' => null,
			'empresaRecursosAdicionais' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('empresas_id', $this->empresas_id);
		$criteria->compare('empresa_recursos_adicionais_id', $this->empresa_recursos_adicionais_id);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}