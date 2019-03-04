<?php

Yii::import('application.models._base.BaseEmbarcacoes');

class Embarcacoes extends BaseEmbarcacoes {

    // Status
    const INACTIVE = 0;
    const WAITING_PAYMENT = 1;
    const ACTIVE = 2;
    const DENIED = 3;
    const SOLD = 4;
    const PAUSED = 5;
    const EXPIRED = 6;

    // Limite de resultados na busca
    const LIMIT_SEARCH = 12;

    // pasta de upload
    const PATH_IMAGES = "public/embarcacoes";

    // Preco mínimo de uma embarcacao, por modelo
    public $minprice;
    // Preco máximo de uma embarcacao, por modelo
    public $maxprice;

    /**
     * Atributos extras
     */
    public $modelo_titulo;
    public $modelo_slug;
    public $macro_titulo;
    public $macro_estado;
    public $fabricante_titulo;
    public $fabricante_slug;
    public $embarcacao_slug;
    public $id_usuario;
    public static $_estado = array('N' => 'Novo', 'U' => 'Usado');
    public static $_estado_f = array('N' => 'Nova', 'U' => 'Usada');
    public $nome_usuario;
    public $flg_turbinado;
    public $gratuito;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        return array(
            'sitemap_jetskis' => array(
                'select' => array(
                    new CDbExpression("CONCAT(embarcacaoFabricantes.slug,'-',embarcacaoModelos.slug,'-',t.id) AS embarcacao_slug"),
                    new CDbExpression("IF(t.estado = 'U', 'jet-skis-usados', 'jet-skis-novos') AS macro_estado"),
                    'embarcacaoFabricantes.slug AS fabricante_slug',
                    'embarcacaoModelos.slug AS modelo_slug'
                ),
                'with' => array('embarcacaoModelos' => array('with' => 'embarcacaoFabricantes')),
                'condition' => 't.status = :status AND embarcacaoModelos.status = 1 AND embarcacaoFabricantes.status = 1 AND embarcacaoFabricantes.embarcacao_macros_id = :macro',
                'params' => array(':status' => Embarcacoes::ACTIVE, ':macro' => EmbarcacaoMacros::$macro_by_slug['jetski'])
            ),
            'sitemap_lanchas' => array(
                'select' => array(
                    new CDbExpression("CONCAT(embarcacaoFabricantes.slug,'-',embarcacaoModelos.slug,'-',t.id) AS embarcacao_slug"),
                    new CDbExpression("IF(t.estado = 'U', 'lanchas-usadas', 'lanchas-novas') AS macro_estado"),
                    'embarcacaoFabricantes.slug AS fabricante_slug',
                    'embarcacaoModelos.slug AS modelo_slug'
                ),
                'with' => array('embarcacaoModelos' => array('with' => 'embarcacaoFabricantes')),
                'condition' => 't.status = :status AND embarcacaoModelos.status = 1 AND embarcacaoFabricantes.status = 1 AND embarcacaoFabricantes.embarcacao_macros_id = :macro',
                'params' => array(':status' => Embarcacoes::ACTIVE, ':macro' => EmbarcacaoMacros::$macro_by_slug['lancha'])
            ),
            'sitemap_veleiros' => array(
                'select' => array(
                    new CDbExpression("CONCAT(embarcacaoFabricantes.slug,'-',embarcacaoModelos.slug,'-',t.id) AS embarcacao_slug"),
                    new CDbExpression("IF(t.estado = 'U', 'veleiros-usados', 'veleiros-novos') AS macro_estado"),
                    'embarcacaoFabricantes.slug AS fabricante_slug',
                    'embarcacaoModelos.slug AS modelo_slug'
                ),
                'with' => array('embarcacaoModelos' => array('with' => 'embarcacaoFabricantes')),
                'condition' => 't.status = :status AND embarcacaoModelos.status = 1 AND embarcacaoFabricantes.status = 1 AND embarcacaoFabricantes.embarcacao_macros_id = :macro',
                'params' => array(':status' => Embarcacoes::ACTIVE, ':macro' => EmbarcacaoMacros::$macro_by_slug['veleiro'])
            ),
            'sitemap_pesca' => array(
                'select' => array(
                    new CDbExpression("CONCAT(embarcacaoFabricantes.slug,'-',embarcacaoModelos.slug,'-',t.id) AS embarcacao_slug"),
                    new CDbExpression("IF(t.estado = 'U', 'barcos-pesca-usados', 'barcos-pesca-novos') AS macro_estado"),
                    'embarcacaoFabricantes.slug AS fabricante_slug',
                    'embarcacaoModelos.slug AS modelo_slug'
                ),
                'with' => array('embarcacaoModelos' => array('with' => 'embarcacaoFabricantes')),
                'condition' => 't.status = :status AND embarcacaoModelos.status = 1 AND embarcacaoFabricantes.status = 1 AND embarcacaoFabricantes.embarcacao_macros_id = :macro',
                'params' => array(':status' => Embarcacoes::ACTIVE, ':macro' => EmbarcacaoMacros::$macro_by_slug['barcos-pesca'])
            )
        );
    }

    public function rules() {

        return array(
            array('embarcacao_macros_id, embarcacao_modelos_id, estado, plano_usuarios_id', 'required'),
            array('embarcacao_macros_id, embarcacao_modelos_id, ano, qntmotores, destaque, plano_usuarios_id, status', 'numerical', 'integerOnly' => true),
            array('titulo, email', 'length', 'max' => 100),
            array('slug', 'length', 'max' => 125),
            array('valor', 'length', 'max' => 100),
            array('combustivel', 'length', 'max' => 100),
            array('estado', 'length', 'max' => 1),
            array('views', 'length', 'max' => 20),
            array('descricao, video', 'safe'),
            array('titulo, slug, ano, combustivel, valor, qntmotores, descricao, estados_id, cidades_id, views, estado, video, destaque, status, email', 'default', 'setOnEmpty' => true, 'value' => null),
            array('id, data_ativacao, embarcacao_macros_id, embarcacao_modelos_id, embarcacao_fabricantes_id, modelo_titulo, fabricante_titulo, titulo, slug, ano, estados_id, cidades_id, valor, estado, qntmotores, descricao, views, video, destaque, gratuito, plano_usuarios_id, status, email', 'safe', 'on' => 'search'),
            array('id, data_ativacao, embarcacao_macros_id, embarcacao_modelos_id, embarcacao_fabricantes_id, titulo, slug, ano, estados_id, cidades_id, valor, combustivel, estado, qntmotores, nome_usuario, descricao, views, video, destaque, plano_usuarios_id, status, email, gratuito', 'safe', 'on' => 'searchAdmin'),
            array('id, data_ativacao, embarcacao_macros_id, embarcacao_modelos_id, embarcacao_fabricantes_id, titulo, slug, ano, estados_id, cidades_id, valor, combustivel, nome_usuario, editado, gratuito, estado, qntmotores, descricao, video, destaque, plano_usuarios_id, status, email, flg_turbinado', 'safe', 'on' => 'searchAdminAnunciosParaValidar'),
            array('id, data_ativacao, embarcacao_macros_id, embarcacao_modelos_id, embarcacao_fabricantes_id, titulo, slug, ano, estados_id, cidades_id, valor, combustivel, estado, qntmotores, descricao, views, video, destaque, plano_usuarios_id, status, email', 'safe', 'on' => 'searchEmbarcacoesEstaleiro'),
            array('id, data_ativacao, embarcacao_macros_id, embarcacao_modelos_id, embarcacao_fabricantes_id, titulo, slug, ano, estados_id, cidades_id, valor, combustivel, estado, qntmotores, descricao, video, destaque, plano_usuarios_id, status, email', 'safe', 'on' => 'searchMinhasEmbarcsEstaleiro'),
            array('data_ativacao, modelo_titulo, macro_titulo, estado, ano, fabricante_titulo, titulo, valor, embarcacao_fabricantes_id, embarcacao_modelos_id, estados_id', 'safe', 'on' => 'favoritos'),
        );
    }

    public function relations() {

        $relations = parent::relations();
        $relations['turbinadas'] = array(self::HAS_MANY, 'EmbarcacoesHasEmbarcacaoRecursosAdicionais', 'embarcacoes_id');

        return $relations;
    }

    public static function representingColumn() {
        return 'embarcacaoModelos';
    }

    public function beforeValidate() {

        /*
         * Gerando o SLUG
         * fazendo validacão no banco pra ver se o slug já existe
         * se o titulo não estiver vazio
         */
        $this->slug = $this->slugifing();


        if ($this->embarcacao_modelos_id == "") {
            $this->addError('embarcacao_modelos_id', 'Selecione um modelo para embarcação');
        }

        if ($this->embarcacao_macros_id == null || $this->embarcacao_macros_id == "") {
            $this->addError('embarcacao_macros_id', 'Selecione uma categoria para embarcação');
        }

        /* if(!empty($this->valor)) {
          $this->valor = Utils::formataValor($this->valor);
          } */

        // se for vendedor ou embarc de empresa, deve validar outros campos
        /* if($this->macros_id == Macros::$macro_by_slug['vendedor'] || $this->macros_id == Macros::$macro_by_slug['empresa']) {

          if($this->cidades_id == '' || $this->cidades_id == 'empty') {
          $this->addError('cidades_id', 'Favor selecione uma cidade');
          }
          if($this->estados_id == '' || $this->estados_id == null) {
          $this->addError('cidades_id', 'Favor selecione o UF');
          }
          } */


        return parent::beforeValidate();
    }

    /* Função que retorna "Nâo informado" caso o valor passado seja 0.00 */

    public static function exibirValorView($valor) {
        if ($valor == '0.00') {
            return 'Não informado';
        }
        return Utils::formataValorView($valor);
    }

    /* Função que retorna "Nâo informado" caso o valor passado seja 0.00 */

    public static function exibirAnoView($ano) {
        if ($ano == 0) {
            return 'N';
        }
        return $ano;
    }

    /* retorna todas as embarcs do anunciante em questão (mobile) */
    /* "usuarios_id" => id do dono dos anuncios e "embarcacoes_id" => embarcação que não é para ser buscada e "status" => 2) */

    public static function maisDesseAnunciante_mobile($usuarios_id, $embarcacoes_id, $offset) {

        $criteria = new CDbCriteria;
        $criteria->join = 'INNER JOIN usuarios_embarcacoes ON usuarios_embarcacoes.embarcacoes_id = t.id';
        $criteria->condition = 'usuarios_embarcacoes.usuarios_id =:user AND usuarios_embarcacoes.embarcacoes_id != :embarcacoes_id AND t.status = :status AND t.macros_id != 3';
        $criteria->params = array(':user' => $usuarios_id, ':embarcacoes_id' => $embarcacoes_id, ':status' => Embarcacoes::ACTIVE);
        $criteria->limit = 3;

        if ($offset != null) {
            $criteria->offset = $offset;
        }

        return Embarcacoes::model()->findAll($criteria);
    }

    // grid padrao de embarcacoes
    // status 4 => vendido , status 7 = deletado (ver Anuncio.php)
    public function search() {

        $criteria = new CDbCriteria;

        $criteria->with = array('planoUsuarios', 'usuariosEmbarcacoes', 'embarcacaoModelos', 'embarcacaoMacros');
        $criteria->together = true;
        $criteria->condition = 'usuariosEmbarcacoes.usuarios_id = :user AND macros_id != 3 AND t.status != 4 AND t.status != 7';
        $criteria->params = array(':user' => Yii::app()->user->getId());

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.embarcacao_macros_id', $this->embarcacao_macros_id);
        $criteria->compare('t.embarcacao_modelos_id', $this->embarcacao_modelos_id);
        $criteria->compare('t.embarcacao_fabricantes_id', $this->embarcacao_fabricantes_id);
        $criteria->compare('t.status', $this->status);

        $ordem = 'FIELD(t.status, 2, 5, 0, 1, 4, 6, 3), t.dataregistro DESC';

        if($this->valor != null && $this->valor != "") {

            if ($this->valor == 0)
                //$criteria->order = 't.valor desc';
                $ordem = 't.valor desc';

            if ($this->valor == 1)
                //$criteria->order = 't.valor asc';
                $ordem = 't.valor asc';
        }

        if($this->views != null && $this->views != "") {
            if ($this->views == 0)
                //$criteria->order = 't.views desc';
                $ordem = 't.views desc';

            if ($this->views == 1)
                //$criteria->order = 't.views asc';
                $ordem = 't.views asc';
        }



        /*if ($this->views == null) {

            if ($this->valor == 0)
                $criteria->order = 't.valor desc';

            if ($this->valor == 1)
                $criteria->order = 't.valor asc';

            if ($this->valor == -1)
                $criteria->order = 't.id desc';

        } else {

            if ($this->views == 0)
                $criteria->order = 't.views desc';

            if ($this->views == 1)
                $criteria->order = 't.views asc';

            if ($this->views == -1)
                $criteria->order = 't.id desc';
        }*/

        $criteria->compare('embarcacaoModelos.titulo', $this->modelo_titulo, true);
        $criteria->compare('embarcacaoMacros.titulo', $this->macro_titulo, true);
        $criteria->compare('embarcacaoFabricantes.titulo', $this->fabricante_titulo, true);

        $criteria->order = $ordem;

        // Status order
        //$criteria->addCondition('t.status IN (0, 1, 2, 3, 4, 5, 6)');
        /*$criteria->order = 'CASE WHEN t.status = 2 THEN 1 END,';
        $criteria->order .= 'CASE WHEN t.status = 1 THEN 2 END,';
        $criteria->order .= 'CASE WHEN t.status = 4 THEN 3 END,';
        $criteria->order .= 'CASE WHEN t.status = 6 THEN 4 END,';
        $criteria->order .= 'CASE WHEN t.status = 5 THEN 5 END,';
        $criteria->order .= 'CASE WHEN t.status = 3 THEN 6 END,';
        $criteria->order .= 'CASE WHEN t.status = 0 THEN 7 END';*/
        //$criteria->order = 'FIELD(t.status, 2, 5, 0, 1, 4, 6, 3), t.dataregistro DESC';
        //$criteria->order = 't.status DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            )
        ));
    }

        // grid padrao de embarcacoes
    public function searchVendidos() {

        $criteria = new CDbCriteria;

        $criteria->with = array('planoUsuarios', 'usuariosEmbarcacoes', 'embarcacaoModelos', 'embarcacaoMacros');
        $criteria->together = true;
        $criteria->condition = 'usuariosEmbarcacoes.usuarios_id = :user AND macros_id != 3 AND t.status = 4';
        $criteria->params = array(':user' => Yii::app()->user->getId());

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.embarcacao_macros_id', $this->embarcacao_macros_id);
        $criteria->compare('t.embarcacao_modelos_id', $this->embarcacao_modelos_id);
        $criteria->compare('t.embarcacao_fabricantes_id', $this->embarcacao_fabricantes_id);
        $criteria->compare('t.status', $this->status);

        /*if ($this->views == null) {

            if ($this->valor == 0)
                $criteria->order = 't.valor desc';

            if ($this->valor == 1)
                $criteria->order = 't.valor asc';

            if ($this->valor == -1)
                $criteria->order = 't.id desc';

        } else {

            if ($this->views == 0)
                $criteria->order = 't.views desc';

            if ($this->views == 1)
                $criteria->order = 't.views asc';

            if ($this->views == -1)
                $criteria->order = 't.id desc';
        }*/

        $criteria->compare('embarcacaoModelos.titulo', $this->modelo_titulo, true);
        $criteria->compare('embarcacaoMacros.titulo', $this->macro_titulo, true);
        $criteria->compare('embarcacaoFabricantes.titulo', $this->fabricante_titulo, true);

        // Status order
        //$criteria->addCondition('t.status IN (0, 1, 2, 3, 4, 5, 6)');
        /*$criteria->order = 'CASE WHEN t.status = 2 THEN 1 END,';
        $criteria->order .= 'CASE WHEN t.status = 1 THEN 2 END,';
        $criteria->order .= 'CASE WHEN t.status = 4 THEN 3 END,';
        $criteria->order .= 'CASE WHEN t.status = 6 THEN 4 END,';
        $criteria->order .= 'CASE WHEN t.status = 5 THEN 5 END,';
        $criteria->order .= 'CASE WHEN t.status = 3 THEN 6 END,';
        $criteria->order .= 'CASE WHEN t.status = 0 THEN 7 END';*/
        $criteria->order = 'FIELD(t.status, 2, 5, 0, 1, 4, 6, 3), t.dataregistro DESC';
        //$criteria->order = 't.status DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            )
        ));
    }

    // grid embarcacoes de todos os estaleiros
    public function searchEmbarcacoesEstaleiro() {

        $criteria = new CDbCriteria;

        $criteria->with = array('planoUsuarios', 'usuariosEmbarcacoes', 'embarcacaoFabricantes', 'embarcacaoModelos', 'embarcacaoMacros');
        $criteria->together = true;
        $criteria->condition = 'macros_id = 3';

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.embarcacao_macros_id', $this->embarcacao_macros_id);
        $criteria->compare('t.embarcacao_modelos_id', $this->embarcacao_modelos_id);
        $criteria->compare('t.embarcacao_fabricantes_id', $this->embarcacao_fabricantes_id);
        $criteria->compare('t.titulo', $this->titulo, true);
        $criteria->compare('t.slug', $this->slug, true);
        $criteria->compare('t.ano', $this->ano);
        $criteria->compare('t.estados_id', $this->estados_id);
        $criteria->compare('t.cidades_id', $this->cidades_id);
        $criteria->compare('t.valor', $this->valor, true);
        $criteria->compare('t.estado', $this->estado, true);
        $criteria->compare('t.qntmotores', $this->qntmotores);
        $criteria->compare('t.descricao', $this->descricao, true);
        $criteria->compare('t.views', $this->views, true);
        $criteria->compare('t.video', $this->video, true);
        $criteria->compare('t.destaque', $this->destaque);
        $criteria->compare('t.plano_usuarios_id', $this->plano_usuarios_id);
        $criteria->compare('t.status', $this->status);

        $criteria->compare('t.email', $this->email);
        $criteria->compare('embarcacaoFabricantes.titulo', $this->fabricante_titulo, true);

        $criteria->compare('embarcacaoModelos.titulo', $this->modelo_titulo, true);
        $criteria->compare('embarcacaoMacros.titulo', $this->macro_titulo, true);

        // status pago, vendido ou ativo
        $criteria->addCondition('t.status = 4 OR t.status = 2 OR t.status = 6');

        $criteria->order = 't.dataregistro DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            )
        ));
    }

    // grid embarcacoes de estaleiro do usuario logado
    public function searchMinhasEmbarcsEstaleiro() {

        $criteria = new CDbCriteria;

        $criteria->with = array('planoUsuarios', 'usuariosEmbarcacoes', 'embarcacaoModelos', 'embarcacaoMacros');
        $criteria->together = true;
        $criteria->condition = 'usuariosEmbarcacoes.usuarios_id = :user AND macros_id = 3';
        $criteria->params = array(':user' => Yii::app()->user->getId());

        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.embarcacao_macros_id', $this->embarcacao_macros_id);
        $criteria->compare('t.embarcacao_modelos_id', $this->embarcacao_modelos_id);
        $criteria->compare('t.embarcacao_fabricantes_id', $this->embarcacao_fabricantes_id);
        $criteria->compare('t.status', $this->status);


        if ($this->views == "-1") {
            if ($this->valor == 0) {
                $criteria->order = 't.valor desc';
            }

            if ($this->valor == 1) {
                $criteria->order = 't.valor asc';
            }

            if ($this->valor == -1) {
                $criteria->order = 't.id desc';
            }
        } else {
            if ($this->views == 0) {
                $criteria->order = 't.views desc';
            }

            if ($this->views == 1) {
                $criteria->order = 't.views asc';
            }

            if ($this->views == -1) {
                $criteria->order = 't.dataregistro desc';
            }
        }




        $criteria->compare('embarcacaoModelos.titulo', $this->modelo_titulo, true);
        $criteria->compare('embarcacaoMacros.titulo', $this->macro_titulo, true);
        $criteria->compare('embarcacaoFabricantes.titulo', $this->fabricante_titulo, true);

        // status pago, vendido ou ativo
        //$criteria->addCondition('t.status = 1 OR t.status = 4 OR t.status = 2 OR t.status = 5');
        //$criteria->order = 't.id DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            )
        ));
    }

    // grid embarcacoes em geral
    public function searchAdmin() {

        $criteria = new CDbCriteria;

        $criteria->with = array('usuariosEmbarcacoes', 'embarcacaoFabricantes', 'embarcacaoModelos', 'embarcacaoMacros', 'planoUsuarios');
        $criteria->together = true;
        $criteria->condition = 'macros_id != 3';

        $criteria->compare('t.id', $this->id);
        $criteria->compare('planoUsuarios.gratuito', $this->gratuito, true);
        $criteria->compare('t.embarcacao_macros_id', $this->embarcacao_macros_id);
        $criteria->compare('t.embarcacao_modelos_id', $this->embarcacao_modelos_id);
        $criteria->compare('t.embarcacao_fabricantes_id', $this->embarcacao_fabricantes_id);
        $criteria->compare('t.ano', $this->ano);
        $criteria->compare('t.estados_id', $this->estados_id);
        $criteria->compare('t.cidades_id', $this->cidades_id);
        $criteria->compare('t.valor', $this->valor, true);
        $criteria->compare('t.estado', $this->estado, true);
        $criteria->compare('t.views', $this->views, true);
        $criteria->compare('t.status', $this->status);
        $criteria->compare('t.editado', $this->editado);

        $criteria->compare('embarcacaoModelos.titulo', $this->modelo_titulo, true);
        $criteria->compare('embarcacaoMacros.titulo', $this->macro_titulo, true);

        $criteria->compare('t.email', $this->email, true);
        $criteria->compare('embarcacaoFabricantes.titulo', $this->fabricante_titulo, true);

        $criteria->addCondition('t.status != 7');

        $criteria->order = 't.dataregistro DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 5,
            )
        ));
    }

    // grid anuncios pagos de embarcação
    public function searchAdminAnunciosParaValidar() {

        $criteria = new CDbCriteria;

        $criteria->with = array('usuariosEmbarcacoes', 'embarcacaoFabricantes', 'embarcacaoModelos', 'embarcacaoMacros', 'planoUsuarios');
        $criteria->together = true;
        //$criteria->condition = 'macros_id != 3';

        $criteria->compare('t.editado', $this->editado);
        $criteria->compare('planoUsuarios.gratuito', $this->gratuito, true);
        $criteria->compare('t.id', $this->id);
        $criteria->compare('t.embarcacao_macros_id', $this->embarcacao_macros_id);
        $criteria->compare('t.embarcacao_modelos_id', $this->embarcacao_modelos_id);
        $criteria->compare('t.ano', $this->ano);
        $criteria->compare('t.estados_id', $this->estados_id);
        $criteria->compare('t.cidades_id', $this->cidades_id);
        $criteria->compare('t.valor', $this->valor, true);
        $criteria->compare('t.estado', $this->estado, true);
        $criteria->compare('t.status', $this->status);


        $criteria->compare('t.email', $this->email);
        $criteria->compare('embarcacaoFabricantes.titulo', $this->fabricante_titulo, true);

        $criteria->compare('embarcacaoModelos.titulo', $this->modelo_titulo, true);
        $criteria->compare('embarcacaoMacros.titulo', $this->macro_titulo, true);

        // status pago ou barrado
        $criteria->addCondition('t.status = 1');

        $criteria->order = 't.dataregistro DESC';

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            )
        ));
    }

    /*
      método que "engana" o search do grid view
      ao digitar no campo texto de modelo ou fabricante de embarcação,
      o model seta como ID oq digitamos, mas oq teria de ser feito é uma busca com oq digitamos
      para obter o ID do fabricante ou modelo
     */

    public static function pesquisarMarcaOuModeloEmbarcacaoGrid($model, $busca, $flag) {

        $q = new CDbCriteria(array(
            'condition' => "titulo LIKE :busca",
            'params' => array(':busca' => '%' . $busca . '%')
        ));

        if ($flag == 'marca') {
            return EmbarcacaoFabricantes::model()->find($q)->id;
        } else {
            return EmbarcacaoModelos::model()->find($q)->id;
        }
    }

    // método que retorna todos os estados dos barcos favoritados
    public static function localizacoesMeusFavoritos() {
        $criteria = new CDbCriteria;
        $criteria->with = array('embarcacoes' => array('with' => 'embarcacoesFavoritasUsuarios'));
        $criteria->condition = 'embarcacoesFavoritasUsuarios.usuarios_id =:user';
        $criteria->params = array(':user' => Yii::app()->user->id);
        return GxHtml::listDataEx(Estados::model()->findAll($criteria));
    }

    public static function listarAnosFavoritos() {

        $criteria = new CDbCriteria;
        $criteria->with = array('with' => 'embarcacoesFavoritasUsuarios');
        $criteria->condition = 'embarcacoesFavoritasUsuarios.usuarios_id =:user';
        $criteria->params = array(':user' => Yii::app()->user->id);
        $criteria->select = 'ano';
        $emb = Embarcacoes::model()->findAll($criteria);

        $anos = array();
        foreach ($emb as $e) {
            $anos[$e->ano] = $e->ano;
        }

        return $anos;
    }

    // grid embarcacoes favoritadas do usuario
    public function favoritos() {

        $criteria = new CDbCriteria;

        $criteria->with = array('embarcacoesFavoritasUsuarios');
        $criteria->together = true;
        $criteria->condition = 'embarcacoesFavoritasUsuarios.usuarios_id = :user';
        $criteria->params = array(':user' => Yii::app()->user->getId());

        $criteria->compare('t.embarcacao_macros_id', $this->embarcacao_macros_id);
        $criteria->compare('t.embarcacao_modelos_id', $this->embarcacao_modelos_id);
        $criteria->compare('t.embarcacao_fabricantes_id', $this->embarcacao_fabricantes_id);
        $criteria->compare('t.estados_id', $this->estados_id);
        $criteria->compare('t.estado', $this->estado);
        $criteria->compare('t.ano', $this->ano);

        if ($this->valor == 0) {
            $criteria->order = 'valor desc';
        }

        if ($this->valor == 1) {
            $criteria->order = 'valor asc';
        }

        $criteria->compare('embarcacaoModelos.titulo', $this->modelo_titulo, true);
        $criteria->compare('embarcacaoFabricantes.titulo', $this->fabricante_titulo, true);
        $criteria->compare('embarcacaoMacros.titulo', $this->macro_titulo, true);

        return new CActiveDataProvider($this, array(
            'criteria' => $criteria,
            'pagination' => array(
                'pageSize' => 10,
            )
        ));
    }

    /**
     * Método que retorna o preco Máximo e Mínino de um certo modelo de embarcacao
     * @param  [type] $modelo_id [ID do modelo]
     * @return [type]            [Array com o preco MAX e MIN]
     */
    public static function selectRanges($modelo_id) {

        $criteria = new CDbCriteria();
        $criteria->select = 'MIN(valor) AS minprice, MAX(valor) AS maxprice';
        $criteria->condition = 'embarcacao_modelos_id = :modelo';
        $criteria->params = array(':modelo' => $modelo_id);

        $range = self::model()->find($criteria);

        return json_encode(array('minprice' => $range->minprice, 'maxprice' => $range->maxprice));
    }


    /**
     * Carrega anuncio relacionado de embarcacao
     * @param  [type] $macro   [ID da macro]
     * @param  [type] $modelo  [ID do modelo]
     * @param  [type] $usuario [ID do usuario]
     * @return [type]          [description]
     */
    public static function anunciosPatrocinados($macro = null) {

        $criteria = new CDbCriteria();
        $criteria->with = array('usuariosEmbarcacoes', 'embarcacaoImagens', 'embarcacaoImpressoes');
        $criteria->condition = 't.status = :status AND embarcacaoImpressoes.status = 1 AND embarcacaoImpressoes.views < embarcacaoImpressoes.limitviews';
        $criteria->limit = 2;
        $criteria->together = true;
        $criteria->order = 'RAND()';

        $params = array();
        $params[':macro_estaleiros'] = Macros::$macro_by_slug['estaleiro'];
        $params[':status'] = self::ACTIVE;

        if ($macro != null) {
            $criteria->with['embarcacaoModelos'] = array(
                                                        'with'=>'embarcacaoFabricantes',
                                                        'condition'=>'embarcacaoFabricantes.embarcacao_macros_id = :macro','params'=>array(':macro'=>$macro)
                                                    );
            //$criteria->addCondition('t.embarcacao_macros_id = :macro');
            //$params[':macro'] = $macro;
        }

        $criteria->params = $params;
        $model = self::model()->findAll($criteria);
        EmbarcacaoImpressoes::addViews($model);

        return $model;
    }


    /**
     * Carrega anuncio relacionado de embarcacao
     * @param  [type] $macro   [ID da macro]
     * @param  [type] $modelo  [ID do modelo]
     * @param  [type] $usuario [ID do usuario]
     * @return [type]          [description]
     */
    public static function anunciosRelacionados($macro = null, $modelo = null, $usuario = null) {
        $criteria = new CDbCriteria();
        $criteria->with = array('usuariosEmbarcacoes', 'embarcacaoImagens', 'embarcacaoImpressoes');
        //$criteria->condition = 't.status = :status AND t.macros_id != :macro_estaleiros AND embarcacaoImpressoes.status = 1 AND embarcacaoImpressoes.views < embarcacaoImpressoes.limitviews AND embarcacaoImpressoes.limitdate > NOW()';
        $criteria->condition = 't.status = :status AND t.macros_id != :macro_estaleiros AND embarcacaoImpressoes.status = 1 AND embarcacaoImpressoes.views < embarcacaoImpressoes.limitviews';
        $criteria->limit = 3;
        $criteria->together = true;
        $criteria->order = 'RAND(UNIX_TIMESTAMP(NOW()))';

        $params = array();
        $params[':macro_estaleiros'] = Macros::$macro_by_slug['estaleiro'];
        $params[':status'] = self::ACTIVE;

        if ($macro != null) {
            $criteria->with['embarcacaoModelos'] = array(
                                                        'with'=>'embarcacaoFabricantes',
                                                        'condition'=>'embarcacaoFabricantes.embarcacao_macros_id = :macro','params'=>array(':macro'=>$macro)
                                                    );
            //$criteria->addCondition('t.embarcacao_macros_id = :macro');
            //$params[':macro'] = $macro;
        }

        if ($modelo != null) {
            $criteria->addCondition('t.embarcacao_modelos_id = :modelo');
            $params[':modelo'] = $modelo;
        }

        if ($usuario != null) {
            $criteria->addCondition('usuariosEmbarcacoes.usuarios_id = :usuario');
            $params[':usuario'] = $usuario;
        }

        $criteria->params = $params;
        $model = self::model()->findAll($criteria);
        EmbarcacaoImpressoes::addViews($model);

        return $model;
    }

    /**
     * Método que carrega embarcacões, para CPM
     * @param  [type] $macro   [description]
     * @param  [type] $modelo  [description]
     * @param  [type] $usuario [description]
     * @return [type]          [description]
     */
    public static function cpm($macro = null, $modelo = null, $usuario = null) {

        $criteria = new CDbCriteria();
        $criteria->with = array('usuariosEmbarcacoes', 'embarcacaoImagens', 'embarcacaoImpressoes', 'planoUsuarios');
        $criteria->condition = 't.status = :status AND t.macros_id != :macro_estaleiros AND embarcacaoImpressoes.status = 1 AND embarcacaoImpressoes.views < embarcacaoImpressoes.limitviews AND planoUsuarios.fim > NOW() AND planoUsuarios.status = 2';
        $criteria->limit = 20;
        $criteria->together = true;
        $criteria->order = 'RAND()';

        $params = array();
        $params[':macro_estaleiros'] = Macros::$macro_by_slug['estaleiro'];
        $params[':status'] = self::ACTIVE;

        if ($macro != null) {
            $criteria->addCondition('t.embarcacao_macros_id = :macro');
            $params[':macro'] = $macro;
        }

        if ($modelo != null) {
            $criteria->addCondition('t.embarcacao_modelos_id = :modelo');
            $params[':modelo'] = $modelo;
        }

        if ($usuario != null) {
            $criteria->addCondition('usuariosEmbarcacoes.usuarios_id = :usuario');
            $params[':usuario'] = $usuario;
        }

        $criteria->params = $params;
        $model = self::model()->findAll($criteria);
        EmbarcacaoImpressoes::addViews($model);

        return $model;
    }

    // retorna o numero de turbinadas q o usuario tem 
    public static function retornarQtdeTurbinadas($id) {

        $embarc = self::model()->findByPk($id);
        $cont_turbo = 0;

        if(self::checkTurboNaoPago($embarc, "titulo")) {
            $cont_turbo += 1;
        }

        if(self::checkTurboNaoPago($embarc, "video")) {
            $cont_turbo += 1;
        }

        if(self::checkTurboNaoPago($embarc, "destaque_busca")) {
            $cont_turbo += 1;
        }

        if(self::checkTurboNaoPago($embarc, "fotos")) {
            $cont_turbo += 1;
        }

        if(self::checkCpm($id)) {
            $cont_turbo +=1;
        }

        return $cont_turbo;
    }



    // checa se tem cpm
    // true => possui cpm e não pode pedir mais
    // false => nao possui cpm ou se possui ja atingiu o limite
    public static function checkCpm($embarcacao_id) {

            // ver se tem turbinada, e ver se passouo do limite de views ja
            $cpm = EmbarcacaoImpressoes::model()->find("embarcacoes_id=:embarcacoes_id", array(":embarcacoes_id"=>$embarcacao_id));

            if($cpm != null) {

                if($cpm->views >= $cpm->limitviews) {

                    return false;
                }

                else {

                    return true;
                }
            }


            return false;

            
    }

    /**
     * Método que retorna embarcacões favoritas
     * @param  [type] $macro   [ID da macro]
     * @param  [type] $modelo  [description]
     * @param  [type] $usuario [description]
     * @return [type]          [description]
     */
    public static function maisFavoritadas($macro = null, $modelo = null, $usuario = null) {

        $criteria = new CDbCriteria();
        $criteria->with = array('embarcacoesIdEmbarcacao', 'usuarios');
        $criteria->condition = 'embarcacoesIdEmbarcacao.status = 1 AND embarcacoesIdEmbarcacao.macros_id != :macro_estaleiros';
        $criteria->limit = 4;
        $criteria->group = 'embarcacoes_id_embarcacao';
        $criteria->order = 'COUNT(embarcacoes_id_embarcacao) DESC';

        $params = array();

        $params[':macro_estaleiros'] = Macros::$macro_by_slug['estaleiro'];

        if ($macro != null) {
            $criteria->addCondition('embarcacoesIdEmbarcacao.embarcacao_macros_id = :macro');
            $params[':macro'] = $macro;
        }

        if ($modelo != null) {
            $criteria->addCondition('embarcacoesIdEmbarcacao.embarcacao_modelos_id = :modelo');
            $params[':modelo'] = $modelo;
        }

        if ($usuario != null) {
            $criteria->addCondition('usuarios.usuarios_id = :usuario');
            $params[':usuario'] = $usuario;
        }

        $criteria->params = $params;

        $model = EmbarcacoesFavoritasUsuario::model()->findAll($criteria);

        return $model;
    }

    /**
     * Método que exibe a thumbnail da embarcacão
     * @param  [type]  $model       [Model da embarcacão]
     * @param  array   $array_image [Array HTML da image]
     * @param  array   $array_link  [Array HTML do link]
     * @param  boolean $link        [FALSE = retorna IMG, TRUE = retorna o link montado]
     * @return [type]               [description]
     */
    public static function getThumb($model, $array_image = array(), $link = false, $array_link = array(), $guid = null) {
        //if (count($model->embarcacaoImagens) > 0) {
        if (EmbarcacaoImagens::obterImgPrincipal($model->id) != null) {
            //$url = self::getPath($model->embarcacaoImagens[0]->imagem);
            $url = self::getPath(EmbarcacaoImagens::obterImgPrincipal($model->id));
        } else {
            $url = self::getPath();
        }


        if (Yii::app()->theme->name == 'mobile') {
            $thumb = @Yii::app()->easyImage->thumbSrcOf($url, array('scaleAndCrop' => array('width' => 75, 'height' => 75)));
        } else {

            $thumb = @Yii::app()->easyImage->thumbSrcOf($url, array('scaleAndCrop' => array('width' => 225, 'height' => 150)));
        }

        //$thumb = "http://www.bombarco.com.br/assets/easyimage/a/a45e8a437d8c75ebe8b10924dc5ac60f.jpeg";

        $array_image += array('title'=>self::getAlt($model));
        $image = CHtml::image($thumb, self::getAlt($model), $array_image);

        // Se for Link, retorna o link completo
        if (Yii::app()->theme->name == 'mobile') {
            return $image;
        } else {

            if ($link === true) {
                return CHtml::link($image, self::mountUrl($model, $guid), $array_link);
            } else { // Se não retorna só a IMG
                return $image;
            }
        }
    }

    /**
     * Retorna o Path da imagem
     * @param  [type] $image [Imagem]
     * @return [type]        [description]
     */
    public static function getPath($image = null) {

        if ($image == null) {
            return Yii::getPathOfAlias('webroot') . '/themes/bombarco/img/sem_foto_bb.jpg';
        } else {
            return Yii::getPathOfAlias('webroot') . '/' . self::PATH_IMAGES . '/' . $image;
        }
    }


    /**
     * Return Image URL
     * @param  [type] $image [description]
     * @return [type]        [description]
     */
    public static function getImageUrl($image = null) {
        if ($image == null) {
            return Yii::app()->createAbsoluteUrl('/themes/bombarco/img/sem_foto_bb.jpg');
        } else {
            return Yii::app()->createAbsoluteUrl('/' . self::PATH_IMAGES . '/' . $image);
        }
    }


    /**
     * Método que monta o Slug da Embarcacão
     * para a URL
     * @param  [type] $model [Model da embarcacão]
     * @return [type]        [description]
     */
    public static function mountUrl($model, $guid = null) {

        $macros = array(
            0 => array('slug' => 'sem-macro', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            1 => array('slug' => 'jet-skis', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            2 => array('slug' => 'lanchas', 'condition' => array('N' => 'novas', 'U' => 'usadas')),
            3 => array('slug' => 'veleiros', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            4 => array('slug' => 'barcos-pesca', 'condition' => array('N' => 'novos', 'U' => 'usados')),
        );

        //$slug = $model->embarcacaoModelos->embarcacaoFabricantes->slug . '-' . $model->embarcacaoModelos->slug . '-' . $model->id;
        $slug = trim($model->slug) . '-' . $model->id;

        $macro_id = $model->embarcacaoModelos->embarcacaoFabricantes->embarcacao_macros_id;

        if(!is_null($guid) || $model->macros_id == 3){

          $url = Zeromilhas::gerarLinkDetalhe($model->id, $model->slug);
          //$url = 'estaleiros/';
          //$url .= $guid . '/';
          //$url .= $model->slug . '/';
          //$id = explode("-", $slug);
          //$url .= end($id);
          $link = $url;
        }else{

          $url = 'embarcacoes/';
          $url .= $macros[$macro_id]['slug'] . '-a-venda/';
          $url .= $macros[$macro_id]['slug'] . '-' . $macros[$macro_id]['condition'][$model->estado] . '/';
          //$url .= $model->embarcacaoModelos->embarcacaoFabricantes->slug . '/';
          //$url .= $model->embarcacaoModelos->slug . '/';
          $url .= $slug;

          $link = preg_replace("/\s/", "-", Yii::app()->createUrl($url));
        }



        
        return $link;
    }

    // SOH EH USADO NO https://www.bombarco.com.br/embarcacoes/adminSlugs
    public static function mountUrl_slugs($model) {

        $macros = array(
            0 => array('slug' => 'sem-macro', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            1 => array('slug' => 'jet-skis', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            2 => array('slug' => 'lanchas', 'condition' => array('N' => 'novas', 'U' => 'usadas')),
            3 => array('slug' => 'veleiros', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            4 => array('slug' => 'barcos-pesca', 'condition' => array('N' => 'novos', 'U' => 'usados')),
        );

        $macro_id = $model->embarcacaoModelos->embarcacaoFabricantes->embarcacao_macros_id;
        
        $url = 'embarcacoes/';
        $url .= $macros[$macro_id]['slug'] . '-a-venda/';
        $url .= $macros[$macro_id]['slug'] . '-' . $macros[$macro_id]['condition'][$model->estado] . '/';

        $link = preg_replace("/\s/", "-", Yii::app()->createUrl($url));
                
        return $link;
    }


    /**
     * Método que monta a URL absoluta
     * @param  [type] $model [description]
     * @return [type]        [description]
     */
    public static function mountAbsoluteUrl($model) {

        $macros = array(
            0 => array('slug' => 'sem-macro', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            1 => array('slug' => 'jet-skis', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            2 => array('slug' => 'lanchas', 'condition' => array('N' => 'novas', 'U' => 'usadas')),
            3 => array('slug' => 'veleiros', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            4 => array('slug' => 'barcos-pesca', 'condition' => array('N' => 'novos', 'U' => 'usados')),
        );

        //$slug = $model->embarcacaoModelos->embarcacaoFabricantes->slug . '-' . $model->embarcacaoModelos->slug . '-' . $model->id;
        $slug = trim($model->slug) . '-' . $model->id;

        $macro_id = $model->embarcacaoModelos->embarcacaoFabricantes->embarcacao_macros_id;

        $url = 'embarcacoes/';
        $url .= $macros[$macro_id]['slug'] . '-a-venda/';
        $url .= $macros[$macro_id]['slug'] . '-' . $macros[$macro_id]['condition'][$model->estado] . '/';
        $url .= $model->embarcacaoModelos->embarcacaoFabricantes->slug . '/';
        $url .= $model->embarcacaoModelos->slug . '/';
        $url .= $slug;

        $link = preg_replace("/\s/", "-", Yii::app()->createAbsoluteUrl($url));
        return $link;
    }


    /**
     * Seleciona embarcacões de um Estaleiro/Empresa
     * @param  [type]  $id   [description]
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public static function fromBusiness($id, $page = 0) {

        $offset = $page * self::LIMIT_SEARCH;

        $array_with = array(
            'usuariosEmbarcacoes' => array(
                'condition' => 'empresas_id = ' . $id
            ),
            'embarcacaoModelos'
        );

        return Embarcacoes::model()->with($array_with)->together()->findAllByAttributes(array('status' => self::ACTIVE), array('limit' => self::LIMIT_SEARCH, 'offset' => $offset, 'order' => 'embarcacaoModelos.tamanho DESC'));
    }

    /**
     * Seleciona embarcacões de um Estaleiro/Empresa
     * @param  [type]  $id   [description]
     * @param  integer $page [description]
     * @return [type]        [description]
     */
    public static function estaleiro($id, $page = 0) {

        $offset = $page * self::LIMIT_SEARCH;

        $array_with = array(
            'usuariosEmbarcacoes' => array(
                'condition' => 'empresas_id = ' . $id
            ),
            'embarcacaoModelos'
        );

        return Embarcacoes::model()->with($array_with)->together()->findAllByAttributes(array('status' => self::ACTIVE, 'macros_id' => 3), array('limit' => self::LIMIT_SEARCH, 'offset' => $offset, 'order' => 'embarcacaoModelos.tamanho DESC'));
    }


    // retorna o obj da embarc a partir do ID do plano usuarios individual
    public static function buscarEmbarcPeloPlano($plano_usuarios_id) {

            $embarc = Embarcacoes::model()->find("plano_usuarios_id=:plano_usuarios_id", array(":plano_usuarios_id"=>$plano_usuarios_id));

            if($embarc != null) {
                return $embarc;
            }

            return null;
    }


    /*
      Atualiza todas as embarcações e planos que venceram
      ou seja, que passaradam da data fim
     */

    public static function atualizarAnunciosVencidos() {

        // achar embarcações que estão com o plano vencido
        $criteria = new CDbCriteria;
        $criteria->with = 'planoUsuarios';
        $criteria->condition = 'planoUsuarios.fim <= now() and t.status = 2 and planoUsuarios.gratuito <> 1';
        $criteria->limit = 100;
        $embarcacoes = Embarcacoes::model()->findAll($criteria);

        // loop por cada embarcação
        foreach ($embarcacoes as $emb) {

            // desativar plano da embarcação e embarcação
            $emb->status = Anuncio::$_status_anuncio["ANUNCIO_EXPIRADO"];
            $planoVelho = PlanoUsuarios::model()->findByPk($emb->planoUsuarios->id);
            $planoVelho->status = Anuncio::$_status_plano["FINALIZADO"];

            if ($planoVelho->update()) {
                // verificar se há algum plano a ser renovado para esta embarcação
                $plano_usuarios_id = $emb->planoUsuarios->id;

                $planoRenovado = PlanosUsuariosRenovados::model()
                        ->find('plano_usuarios_id_atual=:planoatual and status = :status', array(':planoatual' => $plano_usuarios_id, ':status'=>Anuncio::$_status_plano["RENOVACAO_PAGA"]));

                // achou plano a ser renovado
                if ($planoRenovado != null) {

                    // existe um plano a ser renovado, vamos atualizar o ID do plano renovado
                    // e transferir para a embarcação em questão
                    $planoNovo = PlanoUsuarios::model()->findByPk($planoRenovado->plano_usuarios_id_renovado);
                    $planoNovo->status = Anuncio::$_status_plano["PAGO"];

                    if ($planoNovo->update()) {
                        $emb->plano_usuarios_id = $planoRenovado->plano_usuarios_id_renovado;
                        $emb->status = 2;
                        $planoRenovado->status = Anuncio::$_status_plano["RENOVACAO_CONCLUIDA"];
                        $planoRenovado->update();
                    }
                }
            }

            $emb->update();
        }
    }

    /**
     * Checa se existe turbinada e se foi paga
     * @param  [type] $model [Model]
     * @param  [type] $flag  [Flag da turbinada]
     * @return [t
     * ype]        [description]
     */
    public static function checkTurbo($model, $flag) {

        $user = UsuariosEmbarcacoes::model()->find('embarcacoes_id=:emb_id', array(':emb_id' => $model->id));

        foreach ($model->turbinadas as $key => $value) {

            // Se existe a turbinada
            if ($value->embarcacaoRecursosAdicionais->flag == $flag) {

                // Se for o dono, logado e navegando
                // retorna TRUE para mostrar a turbinada dele
                /*if ($user != null) {
                    if ($user->usuarios_id == Yii::app()->user->id)
                        return true;
                }*/

                // Se foi paga
                if ($value->status == 1)
                    return true;
            }
        }

        return false;
    }

    public static function checkTurboNaoPago($model, $flag) {

        foreach ($model->turbinadas as $key => $value) {

            // Se existe a turbinada
            if ($value->embarcacaoRecursosAdicionais->flag == $flag) {

                return true;
            }
        }

        return false;
    }

    // passar o ID do usuario e retonar true se for o dono da embarc,
    // caso ao contrario retorna false
    public static function checarSeEhDono($usuarios_id, $embarcacoes_id) {

        if(UsuariosEmbarcacoes::model()->find("usuarios_id=:usuarios_id AND embarcacoes_id=:embarcacoes_id", array(":usuarios_id"=>$usuarios_id, ":embarcacoes_id"=>$embarcacoes_id)) != null) {

            return true;
        }

        return false;
    }

    /**
     * função que retorna o total de contatos de emnbarcações do usuario em questão
     * @param  $id_usuario ID do dono das emnbarcações
     * @param  $id_embarcacao : se for null é o total de todas as embarcações, senão é só dessa
     * @param  $macro : se é de anuncio ou estaleiro
     * @return  numero inteiro do total de mensagens
     */
    public static function totalizarMensagens($id_usuario, $id_embarcacao = null, $macro) {


        // embarcação do ID <$id_embarcacao>
        if ($id_embarcacao != null) {

            $tipo = "X";
            if($macro != 'anuncio') {
                $tipo = "S";
            }
            return Contatos::model()
                            ->with('embarcacoes')
                            ->count('usuarios_id_dest=:user and tipo=:tipo and embarcacoes.id=:embid', array(':user' => $id_usuario, ':tipo' => $tipo, ':embid' => $id_embarcacao));
        }

        // todas as embarcações
        else {

            if ($macro == 'anuncio') {
                return Contatos::model()
                                ->with('embarcacoes')
                                ->count('usuarios_id_dest=:user and tipo=:tipo and embarcacoes.macros_id != 3', array(':user' => $id_usuario, ':tipo' => 'X'));
            } else {

                return Contatos::model()
                                ->with('embarcacoes')
                                ->count('usuarios_id_dest=:user and tipo=:tipo and embarcacoes.macros_id = 3', array(':user' => $id_usuario, ':tipo' => 'S'));
            }
        }
    }

    /**
     * função que retorna o total de cliques/visualizações de embarcações de classificado do usuario em questão
     * @param  $id_usuario ID do dono das embarcações
     * @param  $id_embarcacao : se for null é o total de todas as embarcações, senão é só dessa,
     * @param  $macro : anuncio ou catalogo
     * @return  numero inteiro de cliques
     */
    public static function totalizarCliques($id_usuario, $id_embarcacao = null, $macro) {

        $contadorCliques = 0;

        // embarcação do ID <$id_embarcacao_
        if ($id_embarcacao != null) {

            return Embarcacoes::model()->findByPk($id_embarcacao)->views;
        }

        // todas as embarcações
        else {



            if ($macro == 'anuncio') {

                $embarcacoes = Embarcacoes::model()->with('usuariosEmbarcacoes')
                        ->findAll('usuariosEmbarcacoes.usuarios_id=:user and t.macros_id != 3 and t.status != :status_deletado', array(':user' => $id_usuario, ":status_deletado" => Anuncio::$_status_anuncio["ANUNCIO_DELETADO"]));
            } else {


                $embarcacoes = Embarcacoes::model()->with('usuariosEmbarcacoes')
                        ->findAll('usuariosEmbarcacoes.usuarios_id=:user and t.macros_id = 3 and t.status != :status_deletado', array(':user' => $id_usuario, ":status_deletado" => Anuncio::$_status_anuncio["ANUNCIO_DELETADO"]));
            }


            foreach ($embarcacoes as $emb) {
                $contadorCliques += $emb->views;
            }

            return $contadorCliques;
        }
    }

    /**
     * função que retorna o total de cliques no vertelefone de embarcações de classificado do usuario em questão
     * @param  $id_usuario ID do dono das embarcações
     * @param  $id_embarcacao : se for null é o total de todas as embarcações, senão é só dessa
     * @return  numero inteiro de cliques
     */
    public static function totalizarVerTelefone($id_usuario, $id_embarcacao = null) {

        $contadorCliques = 0;

        // embarcação do ID <$id_embarcacao_
        if ($id_embarcacao != null) {

            return Embarcacoes::model()->findByPk($id_embarcacao)->vertelefone;
        }

        // todas as embarcações
        else {

            $embarcacoes = Embarcacoes::model()->with('usuariosEmbarcacoes')
                    ->findAll('usuariosEmbarcacoes.usuarios_id=:user', array(':user' => $id_usuario));

            foreach ($embarcacoes as $emb) {
                $contadorCliques += $emb->vertelefone;
            }

            return $contadorCliques;
        }
    }

    /**
     * função que retorna o total de impressões (caso tenha contrado CPM para as embarcações) do usuario em questão
     * @param  $id_usuario ID do dono das embarcações
     * @param  $id_embarcacao : se for null é o total de todas as embarcações, senão é só dessa
     * @return  numero inteiro de impressoes
     */
    public static function totalizarImpressoesClassificados($id_usuario, $id_embarcacao = null) {

        $contadorCPM = 0;
        $limite = 0;

        // embarcação do ID <$id_embarcacao>
        if ($id_embarcacao != null) {

            $embImpressao = EmbarcacaoImpressoes::model()->find('embarcacoes_id=:embid', array(':embid' => $id_embarcacao));

            if ($embImpressao != null) {
                $contadorCPM = $embImpressao->views;
                $limite = $embImpressao->limitviews;
            }

            return array('impressoes' => $contadorCPM, 'limite' => $limite);
        }

        // total de impressoes de todas as embarcações
        else {
            // embarcações do usuario de ID <$id_usuario> que possuem CPM
            $embarcacoes = Embarcacoes::model()
                    ->with(array('embarcacaoImpressoes' => array('joinType' => 'INNER JOIN'),
                        'usuariosEmbarcacoes' => array('joinType' => 'INNER JOIN')))
                    ->findAll('usuariosEmbarcacoes.usuarios_id=:user', array(':user' => $id_usuario));

            foreach ($embarcacoes as $emb) {

                foreach ($emb['embarcacaoImpressoes'] as $embImpressao) {

                    $contadorCPM += $embImpressao->views;
                    $limite += $embImpressao->limitviews;
                }
            }

            return array('impressoes' => $contadorCPM, 'limite' => $limite);
        }
    }

    public function attributeLabels() {
        return array(
            'id' => Yii::t('app', 'ID'),
            'embarcacao_macros_id' => 'Categoria',
            'embarcacao_modelos_id' => 'Modelo',
            'titulo' => Yii::t('app', 'Titulo'),
            'slug' => Yii::t('app', 'Slug'),
            'ano' => Yii::t('app', 'Ano'),
            'estados_id' => 'UF',
            'cidades_id' => 'Cidade',
            'valor' => Yii::t('app', 'Valor'),
            'editado' => Yii::t('app', 'Status'),
            'estado' => Yii::t('app', 'Novo ou Usado'),
            'qntmotores' => Yii::t('app', 'Qntmotores'),
            'descricao' => Yii::t('app', 'Descricao'),
            'views' => Yii::t('app', 'Views'),
            'video' => Yii::t('app', 'Video'),
            'destaque' => Yii::t('app', 'Destaque'),
            'plano_usuarios_id' => null,
            'status' => Yii::t('app', 'Status'),
            'email' => Yii::t('app', 'Email'),
            'macros_id' => null,
            'contatoses' => null,
            'conteudoses' => null,
            'macros_id' => null,
            'contatoses' => null,
            'embarcacaoAcessorioses' => null,
            'embarcacaoImagens' => null,
            'embarcacaoImpressoes' => null,
            'embarcacaoItensAdicionaises' => null,
            'embarcacaoMetricases' => null,
            'embarcacaoSeos' => null,
            'macros' => null,
            'cidades' => null,
            'embarcacaoMacros' => null,
            'embarcacaoModelos' => null,
            'estados' => null,
            'planoUsuarios' => null,
            'embarcacoesFavoritasUsuarios' => null,
            'usuarioses' => null,
            'embarcacaoRecursosAdicionaises' => null,
            'motores' => null,
            'usuariosEmbarcacoes' => null,
        );
    }


    public static function getSrcCrop($url) {
        $url = self::getPath($url);
        return @Yii::app()->easyImage->thumbSrcOf($url, array('scaleAndCrop' => array('width' => 320, 'height' => 212 ) ) );
    }


    public static function getAlt($model) {
        return $model->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $model->embarcacaoModelos->titulo;
    }

    public static function getAlt2($id) {
        $model = Embarcacoes::model()->findByPk($id);
        return $model->embarcacaoModelos->embarcacaoFabricantes->titulo . ' ' . $model->embarcacaoModelos->titulo;
    }


    /**
     * [slugifing description]
     * @return [type] [description]
     */
    public function slugifing($t= null, $a=null) {

        if (empty($this->titulo)) {
            $slug = $this->embarcacaoModelos->embarcacaoFabricantes->titulo . '-' . $this->embarcacaoModelos->titulo;
            $slug = str_replace(' ', '-', $slug);
        } else {
            $slug = Utils::slugify($this->titulo);
            $slug = str_replace(' ', '-', $slug);
        }

        // verifica se existe esse slug no banco
        // e não é o próprio item
        $criteria = new CDbCriteria();
        $criteria->addCondition('t.slug LIKE :slug AND t.embarcacao_modelos_id = :modelo');
        $criteria->params = array(':slug'=>$slug.'%', ':modelo'=>$this->embarcacao_modelos_id);

        // Se existir ID, então é Update
        if (!empty($this->id)) {
            $criteria->addCondition('t.id != :id');
            $criteria->params[':id'] = $this->id;
        }

        // conta os resultados
        $count = self::model()->count($criteria);
        if ($count > 0) {
            // aumenta o contador para concatenar um valor a mais
            $count++;

            // add o valor da soma de resultado ao slug
            // para se tornar único
            $slug .= '-' . $count;
        }

        return $slug;
    }


    public function getPagamento() {

        $id_plano = $this->planoUsuarios->id;
        $pedido = Ordens::model()->find('id_item = :id_item', array(':id_item'=>$id_plano));
        if (!empty($pedido)) {
            $transacao = Transacoes::model()->findByPk($pedido->transacoes_id);

            if (!empty($transacao)) {
                return $transacao->formapagamento;
            }
        }

        return null;
    }


    public function getReference() {

        $id_plano = $this->planoUsuarios->id;
        $pedido = Ordens::model()->find('id_item = :id_item', array(':id_item'=>$id_plano));

        if (!empty($pedido)) {
            $transacao = Transacoes::model()->findByPk($pedido->transacoes_id);

            if (!empty($transacao)) {
                return $transacao->tid_externo;
            }
        }

        return null;
    }

    // retorna ultimo ID cadastrado no bano
    public static function retornarUltimoId() {

        $criteria = new CDbCriteria;
        $criteria->select = 'max(id) as id';
        return Embarcacoes::model()->find($criteria)->id;
    }

    public static function gerarId() {

        $id_max = 9999999;
        $id_min = Embarcacoes::retornarUltimoId() + 1;

        $flg = false;

        do {

            $id = mt_rand($id_min, $id_max);

            if(Embarcacoes::model()->findByPk($id) == null) {
                $flg = true;
            }

        } while($flg == false);

        return $id;   
    }

}
