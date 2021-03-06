<?php

/**
 * This is the model base class for the table "contatos_parceiros".
 * DO NOT MODIFY THIS FILE! It is automatically generated by giix.
 * If any changes are necessary, you must set or override the required
 * property or method in class "ContatosParceiros".
 *
 * Columns in table "contatos_parceiros" available as properties of the model,
 * and there are no model relations.
 *
 * @property integer $id
 * @property string $email_de
 * @property string $email_para
 * @property string $tipo_parceiro
 * @property string $data
 * @property string $nome
 * @property string $telefone
 * @property string $link_embarcacao
 * @property string $mensagem
 *
 */
abstract class BaseContatosParceiros extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'contatos_parceiros';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'ContatosParceiros|ContatosParceiroses', $n);
	}

	public static function representingColumn() {
		return 'data';
	}

	public function rules() {
		return array(
			array('email_de, email_para, tipo_parceiro, nome, telefone, link_embarcacao', 'length', 'max'=>800),
			array('mensagem', 'safe'),
			array('email_de, email_para, tipo_parceiro, nome, telefone, link_embarcacao, mensagem', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, email_de, email_para, tipo_parceiro, data, nome, telefone, link_embarcacao, mensagem', 'safe', 'on'=>'search'),
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
			'email_de' => Yii::t('app', 'Email De'),
			'email_para' => Yii::t('app', 'Email Para'),
			'tipo_parceiro' => Yii::t('app', 'Tipo Parceiro'),
			'data' => Yii::t('app', 'Data'),
			'nome' => Yii::t('app', 'Nome'),
			'telefone' => Yii::t('app', 'Telefone'),
			'link_embarcacao' => Yii::t('app', 'Link Embarcacao'),
			'mensagem' => Yii::t('app', 'Mensagem'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('email_de', $this->email_de, true);
		$criteria->compare('email_para', $this->email_para, true);
		$criteria->compare('tipo_parceiro', $this->tipo_parceiro, true);
		$criteria->compare('data', $this->data, true);
		$criteria->compare('nome', $this->nome, true);
		$criteria->compare('telefone', $this->telefone, true);
		$criteria->compare('link_embarcacao', $this->link_embarcacao, true);
		$criteria->compare('mensagem', $this->mensagem, true);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}