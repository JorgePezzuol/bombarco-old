<?php

Yii::import('application.models._base.BaseConteudoImagens');

class ConteudoImagens extends BaseConteudoImagens
{

	public function scopes() {
		return array(
			'sitemap_images' => array(
                'select' => 'imagem',
            ),
		);
	}

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}
}