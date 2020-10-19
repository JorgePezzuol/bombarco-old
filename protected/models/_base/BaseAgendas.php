<?php

/**
 * This is the model base class for the table "agendas".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "Agendas".
 *
 * Columns in table "agendas" available as properties of the model,
 * followed by relations of table "agendas" available as properties of the model.
 *
 * @property integer $id
 * @property string $titulo
 * @property string $slug
 * @property string $texto
 * @property string $local
 * @property string $data_inicio
 * @property string $data_fim
 * @property string $imagem
 * @property string $fanpage
 *
 * @property AgendaImagens[] $agendaImagens
 * @property Tags[] $tags
 */
abstract class BaseAgendas extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'agendas';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Agendas|Agendases', $n);
	}

	public static function representingColumn() {
		return 'titulo';
	}

	public function rules() {
		return array(
			array('titulo, slug, data_inicio', 'required'),
			array('titulo, slug, local', 'length', 'max'=>150),
			array('imagem', 'length', 'max'=>100),
			array('fanpage', 'length', 'max'=>250),
			array('texto, data_fim', 'safe'),
			array('texto, local, data_fim, imagem, fanpage', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, titulo, slug, texto, local, data_inicio, data_fim, imagem, fanpage', 'safe', 'on'=>'search'),
		);
	}

	public function relations() {
		return array(
			'agendaImagens' => array(self::HAS_MANY, 'AgendaImagens', 'agendas_id'),
			'tags' => array(self::MANY_MANY, 'Tags', 'agendas_has_tags(agendas_id, tags_id)'),
		);
	}

	public function pivotModels() {
		return array(
			'tags' => 'AgendasHasTags',
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'titulo' => Yii::t('app', 'Titulo'),
			'slug' => Yii::t('app', 'Slug'),
			'texto' => Yii::t('app', 'Texto'),
			'local' => Yii::t('app', 'Local'),
			'data_inicio' => Yii::t('app', 'Data Inicio'),
			'data_fim' => Yii::t('app', 'Data Fim'),
			'imagem' => Yii::t('app', 'Imagem'),
			'fanpage' => Yii::t('app', 'Fanpage'),
			'agendaImagens' => null,
			'tags' => null,
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('titulo', $this->titulo, true);
		$criteria->compare('slug', $this->slug, true);
		$criteria->compare('texto', $this->texto, true);
		$criteria->compare('local', $this->local, true);
		$criteria->compare('data_inicio', $this->data_inicio, true);
		$criteria->compare('data_fim', $this->data_fim, true);
		$criteria->compare('imagem', $this->imagem, true);
		$criteria->compare('fanpage', $this->fanpage, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}