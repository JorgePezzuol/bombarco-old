<?php

Yii::import('application.models._base.BaseAzpayLog');

class AzpayLog extends BaseAzpayLog
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}