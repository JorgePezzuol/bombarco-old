<?php

Yii::import('application.models._base.BaseEmbarcacaoImagens');

class EmbarcacaoImagens extends BaseEmbarcacaoImagens {

    public function scopes() {
        return array(
            'sitemap_images' => array(
                'select' => 'imagem',
                'condition' => 't.status = :status',
                'params' => array(':status' => 1)
            ),
        );
    }

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    // $file = $_FILES["qqfile"]
    public static function salvarImagem($file) {

        $uploaddir = Yii::getPathOfAlias('webroot') . '/public/embarcacoes/';
        $nome_arquivo = uniqid().$file['name'];
        $nome_arquivo = str_replace(' ', '_', $nome_arquivo);
        $uploadfile = $uploaddir . $nome_arquivo;

        if(move_uploaded_file($file['tmp_name'], $uploadfile)) {
            return $nome_arquivo;
        }

        return null;
    }

    /**
     * Prepara a imagem para salvar
     * Retorna o model da imagem para continuar a transacão
     * @param  [type] $input_name    [description]
     * @param  [type] $embarcacao_id [description]
     * @return [type]                [description]
     */
    public static function prepareNewImage($input_name, $embarcacao_id, $turbo = 0) {

        if (CUploadedFile::getInstanceByName($input_name) != NULL) {

            // instancia da imagem
            $instance_image = CUploadedFile::getInstanceByName($input_name);

            $size = $instance_image->size / 1024;

            // se for mais que 1000 kb, informar erro
            if ($size > 1020 || $size < 20) {

                return false;
            }

            if ($instance_image->type != Anuncio::$_extensoes_permitidas['JPEG'] && $instance_image->type != Anuncio::$_extensoes_permitidas['JPG'] && $instance_image->type != Anuncio::$_extensoes_permitidas['PNG']) {
                return false;
            }

            // variavel que recebe o status que conterá a imagem
            $status = 0;

            // objeto relacionado as empresas que possuem fotos turbinadas				 		
            $imagemEmbarc = new EmbarcacaoImagens;
            if(!EmbarcacaoImagens::model()->exists('embarcacoes_id=:embarcacoes_id and principal = 1', array(':embarcacoes_id'=>$embarcacao_id))) {
                $imagemEmbarc->principal = 1;
            }
            $imagemEmbarc->embarcacoes_id = $embarcacao_id;
            $imagemEmbarc->imagem = Utils::genImageName($instance_image); // getrando nome novo
            $imagemEmbarc->turbo = $turbo;

            // verificar se ja tem o plano pago
            if ($turbo == 0) {
                if (Usuarios::hasPlanoAnuncioAtivo())
                    $status = 1;
            }

            // aqui é caso for turbinado, verificar se já tem o plano pago e o
            // turbo de img pago também
            else {
                // obter status do turbinado de imagem (se estiver pago, a imagem fica com status 1)
                $id_turbinado_foto = EmbarcacaoRecursosAdicionais::model()->find('flag = :flag', array(':flag' => 'fotos'));

                // registro do turbinado
                $embRecAdicional = EmbarcacoesHasEmbarcacaoRecursosAdicionais::model()
                        ->find('embarcacoes_id = :embarcacoes_id AND embarcacao_recursos_adicionais_id = :id_turbinado_foto', array(':embarcacoes_id' => $embarcacao_id, ':id_turbinado_foto' => $id_turbinado_foto));

                // verificar estado do turbinado
                if ($embRecAdicional != null) {
                    if (Usuarios::hasPlanoAnuncioAtivo() && $embRecAdicional->status == 1)
                        $status = 1;
                }
            }

            $imagemEmbarc->status = $status;

            $path = Yii::getPathOfAlias('webroot') . '/public/embarcacoes/';

            if ($instance_image->saveAs($path . $imagemEmbarc->imagem)) {
                return $imagemEmbarc;
            } else {
                return false;
            }
        }

        return null;
    }


    public function obterImgPrincipal($embarcacoes_id) {


        $img = EmbarcacaoImagens::model()->find("embarcacoes_id=:id AND principal = 1", array(":id"=>$embarcacoes_id));

        if($img != null) {

            return $img->imagem;
        }

        return null;
    }

    public function obterImgPrincipalAbs($embarcacoes_id) {


        $img = EmbarcacaoImagens::model()->find("embarcacoes_id=:id AND principal = 1", array(":id"=>$embarcacoes_id));

        if($img != null) {

            return Yii::app()->baseUrl . '/public/embarcacoes/' . $img->imagem;
        }

        else {

            $emb = Embarcacoes::model()->findByPk($embarcacoes_id);

            if($emb->imagemprincipal != null) {
                return Yii::app()->baseUrl . '/public/embarcacoes/' .$emb->imagemprincipal;
            }
        }

        return "/img/sem_foto_bb.jpg";
    }


    public static function atualizarImgPrincipal($id_img) {


        $nova_img_principal = EmbarcacaoImagens::model()->findByPk($id_img);

        if($nova_img_principal != null) {

            $embarcacoes_id = (int)$nova_img_principal->embarcacoes_id;
            $imagemprincipal = $nova_img_principal->imagem;

            $old_img_principal = EmbarcacaoImagens::model()->find("embarcacoes_id=:emb_id and principal = 1", array(":emb_id"=>$embarcacoes_id));
            $old_img_principal->principal = 0;
            if(!$old_img_principal->update()) {
                var_dump($emb->getErrors());
                exit;
            }

            $nova_img_principal->principal = 1;
            if(!$nova_img_principal->update()) {
                var_dump($emb->getErrors());
                exit;
            }


            $emb = Embarcacoes::model()->findByPk($embarcacoes_id);
            $emb->imagemprincipal = $imagemprincipal;

            if(!$emb->update()) {
                var_dump($emb->getErrors());
                exit;
            }
        }
    }



    
}
