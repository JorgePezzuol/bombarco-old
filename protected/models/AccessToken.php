<?php

Yii::import('application.models._base.BaseAccessToken');

class AccessToken extends BaseAccessToken
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}