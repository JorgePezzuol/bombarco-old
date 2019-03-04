<?php

Yii::import('application.models._base.BaseBombarcoshopFotos');

class BombarcoshopFotos extends BaseBombarcoshopFotos
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function salvarImagem($file) {

		$uploaddir = Yii::getPathOfAlias('webroot') . '/public/bombarcoshop/';
        $nome_arquivo = uniqid().$file['name'];
        $uploadfile = $uploaddir . $nome_arquivo;

        if(move_uploaded_file($file['tmp_name'], $uploadfile)) {
            return $nome_arquivo;
        }

        Yii::app()->user->setFlash('error','Erro ao salvar a imagem');
        return null;
	}
}