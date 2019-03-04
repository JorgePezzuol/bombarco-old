<?php

Yii::import('application.models._base.BaseBombarcoshopTransacoes');

class BombarcoshopTransacoes extends BaseBombarcoshopTransacoes
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	// a principio sera usado para autorizar o download do e-book
	public static function gerarTidInterno($length) {

		$characters = '123456789';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}
}