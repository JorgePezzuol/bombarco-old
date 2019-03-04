<?php

/**
 * This is the model base class for the table "plano_usuarios".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "PlanoUsuarios".
 *
 * Columns in table "plano_usuarios" available as properties of the model,
 * followed by relations of table "plano_usuarios" available as properties of the model.
 *
 * @property integer $id
 * @property string $inicio
 * @property string $fim
 * @property integer $qntpermitida
 * @property string $valor
 * @property integer $status
 * @property integer $planos_id
 * @property integer $usuarios_id
 *
 * @property Embarcacoes[] $embarcacoes
 * @property Planos $planos
 * @property Usuarios $usuarios
 */
abstract class BasePlanoUsuarios extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'plano_usuarios';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'PlanoUsuarios|PlanoUsuarioses', $n);
	}

	public static function representingColumn() {
		return 'inicio';
	}

	public function rules() {
		return array(
			array('qntpermitida, status, planos_id, usuarios_id', 'required'),
			array('qntpermitida, status, planos_id, usuarios_id, gratuito', 'numerical', 'integerOnly'=>true),
			array('valor', 'length', 'max'=>45),
			array('inicio, fim', 'safe'),
			array('inicio, fim, valor', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, inicio, fim, qntpermitida, valor, status, planos_id, usuarios_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'embarcacoes' => array(self::HAS_MANY, 'Embarcacoes', 'plano_usuarios_id'),
			'planos' => array(self::BELONGS_TO, 'Planos', 'planos_id'),
			'usuarios' => array(self::BELONGS_TO, 'Usuarios', 'usuarios_id'),
			'motores' => array(self::HAS_MANY, 'MotorAnuncio', 'plano_usuarios_id')

		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'inicio' => Yii::t('app', 'Inicio'),
			'fim' => Yii::t('app', 'Fim'),
			'qntpermitida' => Yii::t('app', 'Qntpermitida'),
			'valor' => Yii::t('app', 'Valor'),
			'status' => Yii::t('app', 'Status'),
			'planos_id' => null,
			'usuarios_id' => null,
			'embarcacoes' => null,
			'planos' => null,
			'usuarios' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('inicio', $this->inicio, true);
		$criteria->compare('fim', $this->fim, true);
		$criteria->compare('qntpermitida', $this->qntpermitida);
		$criteria->compare('valor', $this->valor, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('planos_id', $this->planos_id);
		$criteria->compare('usuarios_id', $this->usuarios_id);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}