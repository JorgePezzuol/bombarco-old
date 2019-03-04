<?php

Yii::import('application.models._base.BaseEmpresaImagens');
Yii::import('application.models.Anuncio');

class EmpresaImagens extends BaseEmpresaImagens
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function scopes() {
		return array(
			'sitemap_images' => array(
                'select' => 'imagem',
                'condition' => 't.status = :status',
                'params' => array(':status' => 1)
            ),
		);
	}

	/**
	 * Prepara a imagem para salvar
	 * Retorna o model da imagem para continuar a transacão
	 * @param  [type] $input_name    [description]
	 * @param  [type] $embarcacao_id [description]
	 * @return [type]                [description]
	 */
	public static function prepareNewImage($input_name, $empresa_id) {

		if(CUploadedFile::getInstanceByName($input_name) != null) {

		
			// instancia da imagem
			$instance_image = CUploadedFile::getInstanceByName($input_name);

			$size = $instance_image->size / 1024;

			// se for mais que 1000 kb, informar erro
			if($size > 1020 || $size < 20) {

				return false;
			}

			if($instance_image->type != Anuncio::$_extensoes_permitidas['JPEG'] && $instance_image->type != Anuncio::$_extensoes_permitidas['JPG']
				&& $instance_image->type != Anuncio::$_extensoes_permitidas['PNG']) {
				return false;
			}

			// variável que vai guardar o status da imagem
			$status = Anuncio::$_status['INATIVA'];

			// verificar se o turbinado de fotos da empresa já está pago,
			// isto influeciará no status
			$empRecAdicional = EmpresasHasEmpresaRecursosAdicionais::model()
			->find('empresas_id =: empresas_id AND empresa_recursos_adicionais_id =: emp_rec_id', 
				array(':empresas_id' => $empresa_id, ':emp_rec_id' => Anuncio::$__turbinados_empresa['FOTOS']));


			if($empRecAdicional != null && $empRecAdicional->status == Anuncio::$_status['ATIVA'])
				$status = Anuncio::$_status['ATIVA']; 
	 		
	 		// objeto relacionado as empresas que possuem fotos turbinadas				 		
	 		$imagemEmbarc = new EmpresaImagens;
	 		$imagemEmbarc->empresas_id = $empresa_id;
	 		$imagemEmbarc->imagem = Utils::genImageName($instance_image);// getrando nome novo
	 		$imagemEmbarc->status = $status;

	 		$path = Yii::getPathOfAlias('webroot') . '/empresas-imagens/';

	 		if($instance_image->saveAs($path . $imagemEmbarc->imagem)) {
	 			return $imagemEmbarc;
	 		} else {
	 			return false;
	 		}

	 	}

	 	return null;

	}


}