<?php

Yii::import('application.models._base.BaseConteudoSeo');

class ConteudoSeo extends BaseConteudoSeo
{
	public static function label($n = 1) {
		return Yii::t('app', 'SEO|SEO', $n);
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}