<?php

Yii::import('application.models._base.BaseEmpresas');

class Empresas extends BaseEmpresas {

    // Status das Empresas/Estaleiros
    const INACTIVE = 0;
    const WAITING_PAYMENT = 1;
    const ACTIVE = 2;
    // Limite de resultados na busca
    const LIMIT_SEARCH = 50;
    const LIMIT_SEARCH_MOBILE = 6;
    const LIMIT_SEARCH_ESTALEIRO = 16;
    const LIMIT_SEARCH_MORE = 16;
    // Pasta de Uploads
    const PATH_IMAGES_EMPRESAS = "public/empresas";
    const PATH_IMAGES_ESTALEIROS = "public/estaleiros";

    // Status
    public static $_status = array(
        'CRIADO'        => 0,
        'PAGO'          => 1,
        'ATIVADO'       => 2,
        'DESATIVADO'    => 3,
        'VENDIDO'       => 4,
        'EXPIRADO'      => 6
    );

    // Status por ID
    public static $_status_by_id = array(
        0 => 'Criado',
        1 => 'Pago',
        2 => 'Ativo',
        3 => 'Desativado',
        4 => 'Vendido',
        6 => 'Expirado'
    );


    /**
     * Atributos extras
     */
    public $categoria_titulo;
    public $categoria_slug;
    

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        return array(
            'sitemap_empresas' => array('select' => 'slug, empresaCategorias.slug AS categoria_slug', 'with' => 'empresaCategorias', 'condition' => 't.status = :status AND t.macros_id = :macro AND empresaCategorias.status = 1', 'params' => array(':status' => Empresas::ACTIVE, ':macro' => Macros::$macro_by_slug['empresa'])),
            'sitemap_estaleiros' => array('select' => 'slug', 'condition' => 't.status = :status AND t.macros_id = :macro', 'params' => array(':status' => Empresas::ACTIVE, ':macro' => Macros::$macro_by_slug['estaleiro'])),
        );
    }

    public function relations() {

        $relations = parent::relations();
        $relations['turbinadas'] = array(self::HAS_MANY, 'EmpresasHasEmpresaRecursosAdicionais', 'empresas_id');

        return $relations;
    }

    public function beforeValidate() {

        /*
         * Gerando o SLUG
         * fazendo validacão no banco pra ver se o slug já existe
         */
        $this->slug = parent::slugifing($this->razao, $this);

        if ($this->isNewRecord) {

            if (Empresas::model()->exists('razao=:razao', array(':razao' => $this->razao))) {
                $this->addError('razao', 'Razão já existe!');
            }
            if (Empresas::model()->exists('email=:email', array(':email' => $this->email))) {
                $this->addError('email', 'Email já existe!');
            }

            if (!$this->empresa_categorias_id) {
                $this->addError('empresa_categorias_id', 'Preencha um categoria!');
            }
        }



        return parent::beforeValidate();
    }

    public function rules() {

        return array(
            array('razao, empresa_categorias_id, usuarios_id, macros_id, destaque, slug', 'required'),
            array('numero, empresa_categorias_id, usuarios_id, macros_id, status, destaque, embarcacao_macros_id', 'numerical', 'integerOnly' => true),
            array('email, razao, cnpj, cep, bairro, slug', 'length', 'max' => 45),
            array('email', 'email'),
            //array('cep, cnpj', 'numerical', 'integerOnly'=>true),
            array('logo, capa, maps, endereco, fanpage', 'length', 'max' => 300),
            array('telefone', 'length', 'max' => 20),
            array('video, minidescricao', 'length', 'max' => 150),
            array('descricao, nomefantasia', 'safe'),
            array('email, logo, capa, maps, cnpj, telefone, estados_id, cidades_id, cep, endereco, numero, bairro, fanpage, video, status, descricao, embarcacao_macros_id, minidescricao, complemento', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, email, razao, nomefantasia, logo, capa, maps, cnpj, telefone, estados_id, cidades_id, cep, endereco, numero, bairro, fanpage, video, empresa_categorias_id, usuarios_id, macros_id, embarcacao_macros_id, status, destaque, slug, descricao, minidescricao, complemento', 'safe', 'on' => 'search'),
            array('id, email, razao, cnpj, telefone, estados_id, cidades_id, cep, endereco, numero, bairro, fanpage, empresa_categorias_id, usuarios_id, macros_id, embarcacao_macros_id, status, destaque, slug, descricao, minidescricao, complemento', 'safe', 'on' => 'searchAdmin'),
            array('id, email, razao, logo, capa, maps, cnpj, telefone, estados_id, cidades_id, cep, endereco, numero, bairro, fanpage, video, empresa_categorias_id, usuarios_id, macros_id, embarcacao_macros_id, status, destaque, slug, descricao, minidescricao, complemento', 'safe', 'on' => 'searchAnunciosPagos'),
            array('id, email, razao, logo, capa, maps, cnpj, telefone, estados_id, cidades_id, cep, endereco, numero, bairro, fanpage, video, empresa_categorias_id, usuarios_id, macros_id, embarcacao_macros_id, status, destaque, slug, descricao, minidescricao, complemento', 'safe', 'on' => 'searchEstaleiros'),
        );
    }

    /**
     * Carrega anuncio relacionados a empresas ou estaleiros
     * @param  [type] $macro   [ID da macro (Empresa ou Estaleiro)]
     * @return [type]          [description]
     */
    public static function anunciosRelacionados($macro) {




        $criteria = new CDbCriteria();
        $criteria->with = array('empresasImpressoes');
        $criteria->condition = 't.status = 2 AND empresasImpressoes.status = 1 AND empresasImpressoes.views < empresasImpressoes.limitviews AND empresasImpressoes.limitdate > NOW()';
        $criteria->limit = 2;
        $criteria->together = true;
        $criteria->order = 'RAND()';



        $model = self::model()->findAll($criteria);

        EmpresasImpressoes::addViews($model);

        return $model;
    }

    public static function totalizarImpressoes($id_empresa) {

        $contadorCPM = 0;
        $limite = 0;


        // embarcação do ID <$id_embarcacao>
        if ($id_empresa != null) {

            $embImpressao = EmpresasImpressoes::model()->find('empresas_id=:embid', array(':embid' => $id_empresa));

            if ($embImpressao != null) {
                $contadorCPM = $embImpressao->views;
                $limite = $embImpressao->limitviews;
            }

            return array('impressoes' => $contadorCPM, 'limite' => $limite);
        }
    }

    /**
     * função que retorna o total de contatos de emnbarcações do usuario em questão
     * @param  $id_empresa => id da empresa
     * @return  numero inteiro do total de mensagens
     */
    public static function totalizarMensagens($id_empresa) {


        $empresa = Empresas::model()->findByPk($id_empresa);

        $user_id = $empresa->usuarios_id;

        if($empresa->macros_id != 3) {
            return Contatos::model()->count('usuarios_id_dest =:user and tipo =:tipo', array(':user' => $user_id, ':tipo' => Anuncio::$_tipo_contato["GUIA_DE_EMPRESAS"]));
        }
        else {
            return Contatos::model()->count('usuarios_id_dest =:user and tipo =:tipo', array(':user' => $user_id, ':tipo' => Anuncio::$_tipo_contato["ESTALEIRO"]));
        }

    }

    /**
     * Método que carrega mais anúncios de uma empresa/estaleiro
     * @param  [type] $id    [ID da empresa/estaleiro]
     * @param  [type] $limit [Limite de anuncios a serem carregados]
     * @return [type]        [Model de anuncios]
     */
    public static function embarcacoes($id, $limit = 3) {

        $criteria = new CDbCriteria();
        $criteria->with = array('embarcacoes');
        //$criteria->limit = $limit;
        $criteria->condition = 't.empresas_id = :empresa_id AND embarcacoes.status = :status';
        $criteria->params = array(':empresa_id' => $id, ':status' => Anuncio::$_status_anuncio['ANUNCIO_ATIVADO']);

        $anuncios = UsuariosEmbarcacoes::model()->findAll($criteria);

        return $anuncios;
    }

    /*
      Atualiza todas as empresas e planos que venceram
      ou seja, que passaradam da data fim
     */

    public static function atualizarEmpresasVencidas() {

        /* verificar se há planos vencidos e atualizar */
        /* Yii::app()->db->createCommand('update empresas
          inner join plano_usuarios
          on plano_usuarios.id = empresas.plano_usuarios_id
          set empresas.status = 4, plano_usuarios.status = 0
          where plano_usuarios.fim <= now()')->query(); */


        // achar embarcações que estão com o plano vencido
        $criteria = new CDbCriteria;
        $criteria->with = 'planoUsuarios';
        $criteria->condition = 'planoUsuarios.fim <= now() and t.status = 2';
        $criteria->limit = 100;
        $empresas = Empresas::model()->findAll($criteria);

        foreach ($empresas as $emp) {
            $emp->status = 4;
            $planoVelho = PlanoUsuarios::model()->findByPk($emp->planoUsuarios->id);
            $planoVelho->status = 0;

            if ($planoVelho->update()) {

                $plano_usuarios_id = $emp->planoUsuarios->id;

                $planoRenovado = PlanosUsuariosRenovados::model()
                        ->find('plano_usuarios_id_atual=:planoatual and status = 2', array(':planoatual' => $plano_usuarios_id));

                if ($planoRenovado != null) {

                    // existe um plano a ser renovado, vamos atualizar o ID do plano renovado
                    // e transferir para a embarcação em questão
                    $planoNovo = PlanoUsuarios::model()->findByPk($planoRenovado->plano_usuarios_id_renovado);
                    $planoNovo->status = 2;

                    if ($planoNovo->update()) {
                        $emp->plano_usuarios_id = $planoRenovado->plano_usuarios_id_renovado;
                        $emp->status = 2;

                    }
                }
            }

             $emp->update();
        }
    }

    /**
     * Método que exibe a thumbnail da empresa/estaleiro
     * @param  [type]  $model       [Model da empresa/estaleiro]
     * @param  array   $array_image [Array HTML da image]
     * @param  array   $array_link  [Array HTML do link]
     * @param  boolean $link        [FALSE = retorna IMG, TRUE = retorna o link montado]
     * @return [type]               [description]
     */
    public static function getThumb($model, $path = Empresas::PATH_IMAGES_EMPRESAS, $link = false, $array_image = array(), $array_link = array()) {

        if ($model->logo != null) {
            $url = Yii::app()->baseUrl . '/' . $path . '/' . $model->logo;
        } else {
            $url = Yii::app()->theme->baseUrl . '/img/sem_foto_bb.jpg';
        }

        $array_image += array('title'=>$model->razao);
        $image = CHtml::image($url, $model->razao, $array_image);

        // Se for Link, retorna o link completo
        if ($link === true) {
            return CHtml::link($image, self::mountUrl($model, $model->macros_id), $array_link);
        } else { // Se não retorna só a IMG
            return $image;
        }
    }

    /* obter o link da pagina do estaleiro através da embarcação */

    public static function getPaginaEstaleiro($embarcacao_estaleiro_id) {

        $id_empresa = UsuariosEmbarcacoes::model()->find('embarcacoes_id=:embarcacoes_id', array(':embarcacoes_id' => $embarcacao_estaleiro_id))->empresas_id;
        return Empresas::mountUrl(Empresas::model()->findByPk($id_empresa), Macros::$macro_by_slug['estaleiro']);
    }

    /**
     * Retorna o Path da imagem
     * @param  [type] $image [Imagem]
     * @return [type]        [description]
     */
    public static function getPath($image = null, $path = Empresas::PATH_IMAGES_EMPRESAS) {

        if ($image == null) {
            return Yii::app()->theme->baseUrl . '/img/sem_foto_bb.jpg';
        } else {
            return Yii::app()->baseUrl . '/' . $path . '/' . $image;
        }
    }

    /**
     * Monta URL de Empresa
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    public static function mountUrl($model, $macro) {

        if ($macro == Macros::$macro_by_slug['empresa']) {

            if (isset($model->empresaCategorias) && !empty($model->empresaCategorias)) {
                return Yii::app()->createUrl('guia-de-empresas/' . $model->empresaCategorias->slug . '/' . $model->slug);
            } else {
                return Yii::app()->createUrl('guia-de-empresas/' . $model->slug . '/detalhe');
            }
        } else if ($macro == Macros::$macro_by_slug['estaleiro']) {

            // SE DESCOMENTAR, OS ESTALEIROS CADASTRADOS COM EMBARCACAO_MACROS_ID != NULL, VAO DAR PAU NA PAG DE DETALHE
            /* if (isset($model->embarcacaoMacros) && !empty($model->embarcacaoMacros)) {
              return Yii::app()->createUrl('estaleiros/'.$model->embarcacaoMacros->slug.'/'.$model->slug);
              } else {
              return Yii::app()->createUrl('estaleiros/' . $model->slug);
              } */
              if($model != null) {
                    return Yii::app()->createUrl('estaleiros/' . $model->slug);    
              }

              return "estaleiros/";
            
        }
    }

    /**
     * Checa se existe turbinada e se foi paga
     * @param  [type] $model [Model]
     * @param  [type] $flag  [Flag da turbinada]
     * @return [type]        [description]
     */
    public static function checkTurbo($model, $flag) {


        $return = null;



        foreach ($model->turbinadas as $key => $value) {

            // Se existe a turbinada
            if ($value->empresaRecursosAdicionais->flag == $flag) {

                if(Yii::app()->user->id == $model->usuarios_id)
                    return true;

                // Se foi paga
                if ($value->status == 1) {

                    $return = true;
                } else {

                    $return = false;
                }
            }
        }

        return $return;
    }

     public static function checkTurboNaoPago($model, $flag) {


        foreach ($model->turbinadas as $key => $value) {

            // Se existe a turbinada
            if ($value->empresaRecursosAdicionais->flag == $flag) {

               return true;
            }
        }

        return false;
    }

    // retorna o estaleiro de acordo com a embarcação passada
    public function retornarPorEmbarc($id_embarcacao) {

        $usuarios_embarcs = UsuariosEmbarcacoes::model()->find("embarcacoes_id=:embarcacoes_id", array(":embarcacoes_id"=>$id_embarcacao));

        if($usuarios_embarcs != null) {

            if(Empresas::model()->findByPk($usuarios_embarcs->empresas_id) != null) {
                return Empresas::model()->findByPk($usuarios_embarcs->empresas_id);
            }
            return null;
        }

        return null;
    }

    // retorna o nome do estaleiro de acordo com a embarcação passada
    public function retornarNomePorEmbarc($id_embarcacao) {

        $usuarios_embarcs = UsuariosEmbarcacoes::model()->find("embarcacoes_id=:embarcacoes_id", array(":embarcacoes_id"=>$id_embarcacao));

        if($usuarios_embarcs != null) {

            if(Empresas::model()->findByPk($usuarios_embarcs->empresas_id) != null) {
                return Empresas::model()->findByPk($usuarios_embarcs->empresas_id)->razao;
            }
            return "Null";
        }

        return "Null";
    }

    // grid de estaleiros (todos)
    public function searchEstaleiros() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'macros_id = 3';
        $criteria->compare('id', $this->id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('razao', $this->razao, true);
        $criteria->compare('logo', $this->logo, true);
        $criteria->compare('capa', $this->capa, true);
        $criteria->compare('maps', $this->maps, true);
        $criteria->compare('cnpj', $this->cnpj, true);
        $criteria->compare('telefone', $this->telefone, true);
        $criteria->compare('estados_id', $this->estados_id);
        $criteria->compare('cidades_id', $this->cidades_id);
        $criteria->compare('cep', $this->cep, true);
        $criteria->compare('endereco', $this->endereco, true);
        $criteria->compare('numero', $this->numero);
        $criteria->compare('bairro', $this->bairro, true);
        $criteria->compare('fanpage', $this->fanpage, true);
        $criteria->compare('video', $this->video, true);
        $criteria->compare('empresa_categorias_id', $this->empresa_categorias_id);
        $criteria->compare('usuarios_id', $this->usuarios_id);
        $criteria->compare('macros_id', $this->macros_id);
        $criteria->compare('status', $this->status);
        $criteria->compare('destaque', $this->destaque);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('minidescricao', $this->minidescricao, true);
        $criteria->compare('embarcacao_macros_id', $this->embarcacao_macros_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    // grid todas as empresas
    public function searchAdmin() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'macros_id = 2';
        $criteria->compare('id', $this->id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('razao', $this->razao, true);
        $criteria->compare('cnpj', $this->cnpj, true);
        $criteria->compare('telefone', $this->telefone, true);
        $criteria->compare('estados_id', $this->estados_id);
        $criteria->compare('cidades_id', $this->cidades_id);
        $criteria->compare('cep', $this->cep, true);
        $criteria->compare('endereco', $this->endereco, true);
        $criteria->compare('numero', $this->numero);
        $criteria->compare('bairro', $this->bairro, true);
        $criteria->compare('fanpage', $this->fanpage, true);
        $criteria->compare('empresa_categorias_id', $this->empresa_categorias_id);
        $criteria->compare('usuarios_id', $this->usuarios_id);
        $criteria->compare('status', $this->status);
        $criteria->compare('destaque', $this->destaque);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('minidescricao', $this->minidescricao, true);
        $criteria->compare('embarcacao_macros_id', $this->embarcacao_macros_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    // grid todas as empresas
    public function search() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'macros_id = 2 AND (status = 2 OR status = 4)';
        $criteria->compare('id', $this->id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('razao', $this->razao, true);
        $criteria->compare('logo', $this->logo, true);
        $criteria->compare('capa', $this->capa, true);
        $criteria->compare('maps', $this->maps, true);
        $criteria->compare('cnpj', $this->cnpj, true);
        $criteria->compare('telefone', $this->telefone, true);
        $criteria->compare('estados_id', $this->estados_id);
        $criteria->compare('cidades_id', $this->cidades_id);
        $criteria->compare('cep', $this->cep, true);
        $criteria->compare('endereco', $this->endereco, true);
        $criteria->compare('numero', $this->numero);
        $criteria->compare('bairro', $this->bairro, true);
        $criteria->compare('fanpage', $this->fanpage, true);
        $criteria->compare('video', $this->video, true);
        $criteria->compare('empresa_categorias_id', $this->empresa_categorias_id);
        $criteria->compare('usuarios_id', $this->usuarios_id);
        $criteria->compare('macros_id', $this->macros_id);
        $criteria->compare('status', $this->status);
        $criteria->compare('destaque', $this->destaque);
        $criteria->compare('slug', $this->slug, true);
        $criteria->compare('descricao', $this->descricao, true);
        $criteria->compare('minidescricao', $this->minidescricao, true);
        $criteria->compare('embarcacao_macros_id', $this->embarcacao_macros_id);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

    // grid anuncios (de empresa) pagos
    public function searchAnunciosPagos() {
        $criteria = new CDbCriteria;
        $criteria->condition = 'status = 1 AND macros_id = 2';
        $criteria->compare('id', $this->id);
        $criteria->compare('email', $this->email, true);
        $criteria->compare('razao', $this->razao, true);
        $criteria->compare('cnpj', $this->cnpj, true);
        $criteria->compare('empresa_categorias_id', $this->empresa_categorias_id);
        $criteria->compare('usuarios_id', $this->usuarios_id);
        $criteria->compare('status', $this->status);

        $criteria->order = 'id desc';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
        ));
    }

}
