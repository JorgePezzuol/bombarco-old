<?php

/**
 * This is the model base class for the table "embarcacao_macros".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "EmbarcacaoMacros".
 *
 * Columns in table "embarcacao_macros" available as properties of the model,
 * followed by relations of table "embarcacao_macros" available as properties of the model.
 *
 * @property integer $id
 * @property string $titulo
 * @property string $alias
 *
 * @property AcessorioModelos[] $acessorioModeloses
 * @property AcessorioTipos[] $acessorioTiposes
 * @property Banners[] $banners
 * @property Conteudos[] $conteudoses
 * @property EmbarcacaoFabricantes[] $embarcacaoFabricantes
 * @property EmbarcacaoModelos[] $embarcacaoModeloses
 * @property EmbarcacaoModelosEditavel[] $embarcacaoModelosEditavels
 * @property EmbarcacaoTipos[] $embarcacaoTiposes
 * @property Embarcacoes[] $embarcacoes
 * @property Empresas[] $empresases
 * @property MotorModelos[] $motorModeloses
 */
abstract class BaseEmbarcacaoMacros extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'embarcacao_macros';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'EmbarcacaoMacros|EmbarcacaoMacroses', $n);
	}

	public static function representingColumn() {
		return 'titulo';
	}

	public function rules() {
		return array(
			array('titulo, alias', 'required'),
			array('titulo, alias', 'length', 'max'=>45),
			array('id, titulo, alias', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'acessorioModeloses' => array(self::HAS_MANY, 'AcessorioModelos', 'embarcacao_macros_id'),
			'acessorioTiposes' => array(self::HAS_MANY, 'AcessorioTipos', 'embarcacao_macros_id'),
			'banners' => array(self::HAS_MANY, 'Banners', 'embarcacao_macros_id'),
			'conteudoses' => array(self::HAS_MANY, 'Conteudos', 'embarcacao_macros_id'),
			'embarcacaoFabricantes' => array(self::HAS_MANY, 'EmbarcacaoFabricantes', 'embarcacao_macros_id'),
			'embarcacaoModeloses' => array(self::HAS_MANY, 'EmbarcacaoModelos', 'embarcacao_macros_id'),
			'embarcacaoModelosEditavels' => array(self::HAS_MANY, 'EmbarcacaoModelosEditavel', 'embarcacao_macros_id'),
			'embarcacaoTiposes' => array(self::HAS_MANY, 'EmbarcacaoTipos', 'embarcacao_macros_id'),
			'embarcacoes' => array(self::HAS_MANY, 'Embarcacoes', 'embarcacao_macros_id'),
			'empresases' => array(self::HAS_MANY, 'Empresas', 'embarcacao_macros_id'),
			'motorModeloses' => array(self::HAS_MANY, 'MotorModelos', 'embarcacao_macros_id'),
		);
	}

	public function pivotModels() {
		return array(
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'titulo' => Yii::t('app', 'Titulo'),
			'alias' => Yii::t('app', 'Alias'),
			'acessorioModeloses' => null,
			'acessorioTiposes' => null,
			'banners' => null,
			'conteudoses' => null,
			'embarcacaoFabricantes' => null,
			'embarcacaoModeloses' => null,
			'embarcacaoModelosEditavels' => null,
			'embarcacaoTiposes' => null,
			'embarcacoes' => null,
			'empresases' => null,
			'motorModeloses' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('titulo', $this->titulo, true);
		$criteria->compare('alias', $this->alias, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}