<?php

Yii::import('application.models._base.BaseRedirects');

class Redirects extends BaseRedirects
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}