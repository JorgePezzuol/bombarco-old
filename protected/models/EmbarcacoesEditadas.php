<?php

Yii::import('application.models._base.BaseEmbarcacoesEditadas');

class EmbarcacoesEditadas extends BaseEmbarcacoesEditadas
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	// passa o obj embarcacao e vemos se possui os dados editados
	public static function isEditada($embarc, $tipo_dado) {

		$editado = EmbarcacoesEditadas::model()
		->find("embarcacoes_id=:embarcacoes_id AND plano_usuariosid=:plano_usuariosid AND tipo_dado=:tipo_dado", 
		array(":embarcacoes_id"=>$embarc->id, ":plano_usuariosid"=>$embarc->plano_usuarios_id, ":tipo_dado"=>$tipo_dado));

		if($editado != null) {
			return true;
		}

		return false;
		
	}
}