<?php

Yii::import('application.models._base.BaseEmbarcacaoModelos');

class EmbarcacaoModelos extends BaseEmbarcacaoModelos {

    /**
     * Atributos extras
     */
    // Tamanho minimos em pés
    public $minsize;
    // Tamanho máximo em pés
    public $maxsize;
    public $fabricante_slug;
    public $macro_slug_url;

    // Atributos do Tipo
    public $tipo_titulo;

    public static function model($className = __CLASS__) {
        return parent::model($className);
    }

    public function scopes() {
        return array(
            'sitemap' => array(
                'select' => array(
                    'slug',
                    new CDbExpression("(CASE
                    WHEN t.embarcacao_macros_id = 1 THEN 'jet-skis-a-venda'
                    WHEN t.embarcacao_macros_id = 2 THEN 'lanchas-a-venda'
                    WHEN t.embarcacao_macros_id = 3 THEN 'veleiros-a-venda'
                    WHEN t.embarcacao_macros_id = 4 THEN 'barcos-pesca-a-venda'
                    END) AS macro_slug_url"),
                    'embarcacaoFabricantes.slug AS fabricante_slug'),
                'with' => array('embarcacoes', 'embarcacaoFabricantes'),
                'condition' => 't.status = 1 AND embarcacaoFabricantes.status = 1 and embarcacoes.status = 2'
            ),
        );
    }

    public function relations() {

        $relations = parent::relations();
        $relations['emb_active'] = array(self::HAS_MANY, 'Embarcacoes', 'embarcacao_modelos_id', 'condition' => 'status=2');

        return $relations;
    }

    public function rules() {
        $rules = parent::rules();

        $rules[] = array('tanquecombustivel, tanqueagua, consumo, ncamarotes, nbanheiros', 'length', 'max' => 8);
        $rules[] = array('tamanho, passageiros, acomodacoes, comprimento, boca, calado, pedireito, pesocasco, consumo', 'length', 'max' => 8);
        $rules[] = array('ncamarotes, nbanheiros', 'length', 'max' => 3);
        $rules[] = array('status', 'length', 'max' => 1);
        $rules[] = array('tipo_titulo', 'safe', 'on'=>'search');

        return $rules;
    }

      public static function listarAtivos() {

      $criteria = new CDbCriteria;
      $criteria->order = "titulo asc";
      $criteria->condition = 'status = 1';
      $modelos = self::model()->findAll($criteria);
      return $modelos;
    }

    public function attributeLabels() {

        $array = parent::attributeLabels();

        $array['tanquecombustivel'] = Yii::t('app', 'Tanque de Combustível');
        $array['tanqueagua'] = Yii::t('app', 'Tanque de Água');
        $array['ncamarotes'] = Yii::t('app', 'Número de Camarotes');
        $array['nbanheiros'] = Yii::t('app', 'Número de Banheiros');
        $array['acomodacoes'] = Yii::t('app', 'Acomodacões');
        $array['pedireito'] = Yii::t('app', 'Pé Direito');
        $array['pesocasco'] = Yii::t('app', 'Peso do Casco');
        $array['embarcacao_fabricantes_id'] = Yii::t('app', 'Fabricante');
        $array['embarcacao_macros_id'] = Yii::t('app', 'Categoria da Embarcacão');
        $array['embarcacao_tipos_id'] = Yii::t('app', 'Tipo de Embarcacão');
        $array['tipo_titulo'] = Yii::t('app', 'Título do Tipo');

        return $array;
    }

    public function beforeSave() {

        /* if(EmbarcacaoModelos::model()->exists('titulo = :titulo', array(':titulo'=>$this->titulo))) {
          $this->addError('titulo', 'Já existe um modelo com este nome!');
          } */

        if ($this->embarcacao_macros_id == '-1') {
            $this->addError('embarcacao_macros_id', 'Favor selecione uma categoria');
        }

        if ($this->embarcacao_fabricantes_id == '-1') {
            $this->addError('embarcacao_fabricantes_id', 'Favor selecione um fabricante');
        }

        if ($this->embarcacao_tipos_id == '-1') {
            $this->addError('embarcacao_tipos_id', 'Favor selecione um tipo de embarcação');
        }


        $this->boca = str_replace(',', '.', $this->boca);
        $this->pedireito = str_replace(',', '.', $this->pedireito);
        $this->pesocasco = str_replace(',', '.', $this->pesocasco);
        $this->calado = str_replace(',', '.', $this->calado);
        $this->comprimento = str_replace(',', '.', $this->comprimento);
        $this->consumo = str_replace(',', '.', $this->consumo);
        $this->tanqueagua = str_replace(',', '.', $this->tanqueagua);
        $this->tanquecombustivel = str_replace(',', '.', $this->tanquecombustivel);
        $this->tamanho = str_replace(',', '.', $this->tamanho);

        return parent::beforeSave();
    }

    public function beforeValidate() {

      // Gerando o SLUG
      $this->slug = parent::slugifing($this->titulo, $this);

      if ($this->isNewRecord) {

            $nomeModelo = $this->titulo;
            $id_fab = $this->embarcacaoFabricantes->id;

            // verificar se existe
            if (EmbarcacaoModelos::model()->exists('embarcacao_fabricantes_id=:id AND titulo=:titulo and status = 1', array(':id' => $id_fab, ':titulo' => $nomeModelo)))
                $this->addError('embarcacao_fabricantes_id', 'Modelo já existe!');
      }

        return parent::beforeValidate();
    }


    public function afterFind() {

      // Se tiver Tipo, retorna o título para view
      if (!empty($this->embarcacaoTipos))
        $this->tipo_titulo = $this->embarcacaoTipos->titulo;

      return parent::afterFind();
    }

    /**
     * Retorna um DropDown de Modelos
     * a partir do ID de Fabricantes
     * @param  [type] $fabricante_slug [description]
     * @return [type]             [description]
     */
    public static function selectBusca($fabricante_slug) {

        $fabricante = EmbarcacaoFabricantes::model()->findByAttributes(array('slug' => $fabricante_slug));
        $modelos = self::model()->findAll('embarcacao_fabricantes_id = :id ORDER BY titulo ASC', array(':id' => $fabricante->id));
        $data = CHtml::listData($modelos, 'slug', 'titulo');

        // ordenação natural
        natsort($data);

        return CHtml::dropDownList('modelo', null, $data, array('id' => 'model', 'empty' => array('-1' => 'Modelo')));
    }


    /**
     * Seleciona todos os modelos a partir do fabricante
     * @param  [type]  $fabricante_id [description]
     * @param  boolean $listData      [description]
     * @return [type]                 [description]
     */
    public static function selectAllFromFabricante($fabricante_id, $listData = false) {

      //$modelos = self::model()->findAllByAttributes(array('embarcacao_fabricantes_id'=>$fabricante_id, 'status'=>1), array('order'=>'titulo ASC'));
      $modelos = self::model()->findAllByAttributes(array('embarcacao_fabricantes_id'=>$fabricante_id), array('order'=>'titulo ASC'));

      if ($listData) {
        $data = CHtml::listData($modelos,'id','titulo');
        natsort($data);
        return $data;
      }
      
      return $modelos;
    }


    /**
     * Método que devolve um array contendo todos os modelos de embarcações
     * do anunciante em questão.
     * @param  [int] $usuarios_id [id do anunciante]
     * @param [string] [macro] [anuncio ou catálogo]
     * @return [array]             [modelos de embarcação do anunciante]
     */
    public static function filtrarPelosMeusModelos($usuarios_id, $macro) {

        /*
          select * from embarcacao_modelos
          INNER JOIN embarcacoes ON embarcacoes.embarcacao_modelos_id = embarcacao_modelos.id
          INNER JOIN usuarios_embarcacoes ON usuarios_embarcacoes.embarcacoes_id = embarcacoes.id
          AND usuarios_embarcacoes.usuarios_id = 3561
          AND (embarcacoes.status = 1 OR embarcacoes.status = 2 OR embarcacoes.status = 4)
         */

        // criteria, traz todos os modelos de embarcação do fabricante com status de aguardando pagamento,
        // ativo ou vendido
        $criteria = new CDbCriteria;
        $criteria->join = 'INNER JOIN embarcacoes ON embarcacoes.embarcacao_modelos_id = t.id ';
        $criteria->join .= 'INNER JOIN usuarios_embarcacoes ON usuarios_embarcacoes.embarcacoes_id = embarcacoes.id';

        // soh embarcações de anuncios
        if ($macro == 'anuncio') {
            $criteria->condition = 'usuarios_embarcacoes.usuarios_id = :usuarios_id AND embarcacoes.macros_id != 3';
        }

        // soh embarcs de estaleiro
        else {
            $criteria->condition = 'usuarios_embarcacoes.usuarios_id = :usuarios_id AND embarcacoes.macros_id = 3';
        }


        $criteria->params = array(':usuarios_id' => $usuarios_id);
        $modelos = self::model()->findAll($criteria);

        // retorna modelos
        return $modelos;
    }

    /**
     * Método que devolve um array contendo todos os modelos de embarcações
     * favoritadas do usuario.
     * @param  [int] $usuarios_id [id do anunciante]
     * @param [string] [macro] [anuncio ou catálogo]
     * @return [array]             [modelos de embarcação do anunciante]
     */
    public static function filtrarPelosMeusModelosFavoritos() {

        /*
          select * from embarcacao_modelos
          INNER JOIN embarcacoes ON embarcacoes.embarcacao_modelos_id = embarcacao_modelos.id
          INNER JOIN usuarios_embarcacoes ON usuarios_embarcacoes.embarcacoes_id = embarcacoes.id
          AND usuarios_embarcacoes.usuarios_id = 3561
          AND (embarcacoes.status = 1 OR embarcacoes.status = 2 OR embarcacoes.status = 4)
         */

        // criteria, traz todos os modelos de embarcação do fabricante com status de aguardando pagamento,
        // ativo ou vendido
        $criteria = new CDbCriteria;
        $criteria->join = 'INNER JOIN embarcacoes ON embarcacoes.embarcacao_modelos_id = t.id ';
        $criteria->join .= 'INNER JOIN embarcacoes_favoritas_usuario ON embarcacoes_favoritas_usuario.embarcacoes_id_embarcacao = embarcacoes.id';
        $criteria->condition = 'embarcacoes_favoritas_usuario.usuarios_id = :usuarios_id';
        $criteria->params = array(':usuarios_id' => Yii::app()->user->id);
        $modelos = self::model()->findAll($criteria);

        // retorna modelos
        return GxHtml::listDataEx($modelos);
    }

    /**
     * Método que devolve um array contendo todos os modelos de embarcações
     * ativos cadastrados na tabela bombarco.
     * @param  [int] $usuarios_id [id do anunciante]
     * @return [array]             [modelos de embarcação do anunciante]
     */
    public static function listarModelosTabela() {

        /*
          SELECT * FROM embarcacao_fabricantes
          inner join
          tabela_embarcacoes
          on
          tabela_embarcacoes.embarcacao_fabricantes_id = embarcacao_fabricantes.id
         */

        $criteria = new CDbCriteria;
        $criteria->join = 'INNER JOIN tabela_embarcacoes ON tabela_embarcacoes.embarcacao_modelos_id = t.id ';
        $criteria->condition = "tabela_embarcacoes.status = 1";
        $criteria->order = "titulo asc";
        $modelos = self::model()->findAll($criteria);

        // retorna modelos
        return $modelos;
    }

    /**
     * Retorna o DropDown de Modelos
     * A partir do Fabricante
     * @param  [type] $input_name  [NAME do input]
     * @param  [type] $input_id    [ID no input]
     * @param  [type] $id          [ID do Fabricante]
     * @param  string $placeholder [Texto do primeiro option]
     * @param  string $selected    [Option selecionado]
     * @return string              [HTML do Select]
     */
    public static function dropDown($input_name, $input_id, $id = null, $placeholder = 'Selecione', $selected = '', $html_options = array()) {

        $criteria = new CDbCriteria();
        $criteria->with = array('embarcacoes' => array('with' => 'planoUsuarios'));
        $criteria->condition = 't.status = 1
                                AND embarcacoes.status = :status_emb
                                AND embarcacoes.macros_id != :macro_estaleiros
                                AND planoUsuarios.status = 2';
                                //AND planoUsuarios.inicio < NOW()
                                //AND planoUsuarios.fim > NOW()'
        $criteria->params = array(':status_emb' => Embarcacoes::ACTIVE, ':macro_estaleiros' => Macros::$macro_by_slug['estaleiro']);
        $criteria->order = 't.titulo ASC';


        // Condições:
        // Modelo ativo (embarcacaoModeloses.status = 1)
        // Embarcação ativa (embarcacoes.status = :status_emb)
        // Embarcação não pode ser de Estaleiro (embarcacoes.macros_id != :macro_estaleiros)
        // O Plano deve estar ativo (planoUsuarios.status = 1)
        // O Plano deve ter iniciado (planoUsuarios.inicio < NOW())
        // O Plano não pode ter acabado (planoUsuarios.fim > NOW())		
        if ($id == null) {
            $modelos = self::model()->with($with)->findAll($condition, $params);
        } else {

            // Condição para filtrar de um Fabricante
            $criteria->addCondition('t.embarcacao_fabricantes_id = :id');
            $criteria->params[':id'] = $id;
            $modelos = self::model()->findAll($criteria);
        }

        // Varrendo Modelos para remover os que não tem embarcacões cadastradas
        /* foreach ($modelos as $key => $value) {

          // Se não existirem embarcacões deste modelo
          if (count($value->embarcacoes) == 0) {
          unset($modelos[$key]);// Remove este fabricante
          }

          } */

        $data = CHtml::listData($modelos, 'id', 'titulo');

        // ordenação natural
        natsort($data);

        // Add opção TODOS
        /*if (count($data) >= 1) {
            $data = array('0' => 'Todos os modelos') + $data;
        }*/

        $html_options['id'] = $input_id;
        $html_options['empty'] = array('0' => $placeholder);

        return CHtml::dropDownList($input_name, $selected, $data, $html_options);
    }

    /**
     * Método que retorna o tamanho Máximo e Mínino de um certo modelo
     * @param  [type] $macro_id      [ID da macro]
     * @param  [type] $fabricante_id [ID do fabricante]
     * @return [type]                [description]
     */
    public static function selectSizeRanges($macro_id, $fabricante_id = null) {

        $condition = '';
        $params = array();

        $condition .= 'embarcacao_macros_id = :macro';
        $params[':macro'] = $macro_id;

        if ($fabricante_id != null) {
            $condition .= ' AND embarcacao_fabricantes_id = :fabricante';
            $params[':fabricante'] = $fabricante_id;
        }

        $criteria = new CDbCriteria();
        $criteria->select = 'MIN(tamanho) AS minsize, MAX(tamanho) AS maxsize';
        $criteria->condition = $condition;
        $criteria->params = $params;
        $range = self::model()->find($criteria);

        return json_encode(array('min' => $range->minsize, 'max' => $range->maxsize));
    }

    /**
     * Método que monta o Slug do Modelo
     * para a URL
     * @param  [type] $model [Model da embarcacão]
     * @return [type]        [description]
     */
    public static function mountUrl($model) {

        $macros = array(
            1 => array('slug' => 'jet-skis', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            2 => array('slug' => 'lanchas', 'condition' => array('N' => 'novas', 'U' => 'usadas')),
            3 => array('slug' => 'veleiros', 'condition' => array('N' => 'novos', 'U' => 'usados')),
            4 => array('slug' => 'barcos-pesca', 'condition' => array('N' => 'novos', 'U' => 'usados')),
        );

        $url = 'embarcacoes/' . $macros[$model->embarcacaoModelos->embarcacaoFabricantes->embarcacao_macros_id]['slug'] . '-a-venda/' . $model->embarcacaoModelos->embarcacaoFabricantes->slug . '/' . $model->embarcacaoModelos->slug;

        return Yii::app()->createUrl($url);
    }


    /**
     * Slug
     * @return [type] [description]
     */
  public function slugifing($t=null, $a=null) {

    // executa o slugify
    $slug = Utils::slugify($this->titulo);

    // verifica se existe esse slug no banco
    // e não é o próprio item
    $criteria = new CDbCriteria();
    $criteria->addCondition('t.slug LIKE :slug AND t.embarcacao_fabricantes_id = :fab');
    $criteria->params = array(':slug'=>$slug.'%', ':fab'=>$this->embarcacao_fabricantes_id);

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



  public static function teste($data) {
    // parei aqui

    return Editable::source(EmbarcacaoModelos::model()->findAll(':status=:status AND embarcacao_macros_id =:emb',array(':status'=>1, ':emb'=>$data->embarcacao_macros_id)), 'id', 'titulo');
  } 
}
