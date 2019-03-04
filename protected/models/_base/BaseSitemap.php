<?php

abstract class BaseSitemap extends GxActiveRecord {

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function tableName() {
		return 'sitemap';
	}

	public static function label($n = 1) {
		return Yii::t('app', 'Sitemap|Sitemaps', $n);
	}

	public static function representingColumn() {
		return 'loc';
	}

	public function rules() {
		return array(
			array('loc', 'required'),
			array('status', 'numerical', 'integerOnly'=>true),
			array('status, frequency, priority', 'default', 'setOnEmpty' => true, 'value' => null),
			array('id, loc, frequency, priority, status', 'safe', 'on'=>'search'),
		);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'loc' => Yii::t('app', 'URL'),
			'frequency' => Yii::t('app', 'Frequência'),
			'priority' => Yii::t('app', 'Prioridade'),
			'status' => Yii::t('app', 'Status'),
		);
	}

	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('loc', $this->loc, true);
		$criteria->compare('frequency', $this->frequency, true);
		$criteria->compare('priority', $this->priority);
		$criteria->compare('status', $this->status);

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}
}