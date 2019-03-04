<?php

Yii::import('application.models._base.BaseEmbarcacaoFabricantes');

class EmbarcacaoFabricantes extends BaseEmbarcacaoFabricantes
{

	/**
	 * Atributos extras
	 */
	public $macro_slug_url;

	public static function model($className=__CLASS__) {
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
					),
				'with' => 'embarcacoes',
				'condition'=>'t.status = 1 and embarcacoes.status = 2',
			),

		);
	}

	public function beforeSave() {

		/*if($this->isNewRecord) {
			if(self::model()->exists('titulo=:titulo AND embarcacao_macros_id=:embarcacao_macros_id',
				array(':titulo'=>$this->titulo, ':embarcacao_macros_id'=>$this->embarcacao_macros_id))) {
				$this->addError('titulo', 'Fabricante já existe!');
				return false;
			}
		}*/

		return parent::beforeSave();
	}

	public function beforeValidate() {

		// Gerando o SLUG
		$this->slug = $this->slugifing();

		return parent::beforeValidate();
	}

	/**
	 * Retorna um DropDown de Fabricantes
	 * @return [type] [description]
	 */
	public static function selectBusca() {

		$fabricantes = self::model()->findAll(array('order'=>'titulo ASC'));
		$data = CHtml::listData($fabricantes,'slug','titulo');

		return CHtml::dropDownList('marca', null, $data, array('id'=>'brand', 'empty'=>array('-1'=>'Marcas')));
	}

	/**
	 * Retorna o DropDown de Fabricantes ativos para o cadastro de modelos
	 * @param  [type] $input_name  [NAME do input]
	 * @param  [type] $input_id    [ID do input]
	 * @param  [type] $id          [ID da Macro]
	 * @param  string $placeholder [Texto do primeiro option]
	 * @return [type]              [description]
	 */
	public static function dropDownFormModelo($input_name, $input_id, $id = null, $placeholder = 'Selecione', $selected = '', $html_options = array()) {

		$fabricantes = self::model()->findAll('status=:status AND embarcacao_macros_id=:emb_id ORDER BY titulo ASC', array(':status'=>1, 'emb_id'=>$id));

		$data = CHtml::listData($fabricantes,'id','titulo');

		// Add opção TODOS
		$data = array('0'=>'Todas as marcas') + $data;

		$html_options['id'] = $input_id;
		$html_options['empty'] = array('-1'=>$placeholder);

		return CHtml::dropDownList($input_name, $selected, $data, $html_options);
	}



	/**
	 * Seleciona todos os fabricantes a partir da Macro
	 * @param  [type]  $macro_id [description]
	 * @param  boolean $listData [description]
	 * @return [type]            [description]
	 */
	public static function selectAllFromMacro($macro_id, $listData = false) {

		$fabricantes = self::model()->findAllByAttributes(array('embarcacao_macros_id'=>$macro_id, 'status'=>1), array('order'=>'titulo ASC'));

		if ($listData)
			return CHtml::listData($fabricantes,'id','titulo');

		return $fabricantes;
	}



	/**
	 * Método que devolve um array contendo todos os fabricantes de embarcações
	 * do anunciante em questão.
	 * @param  [int] $usuarios_id [id do anunciante]
	 *  * @param [string] [macro] [anuncio ou catálogo]
	 * @return [array]             [fabricantes de embarcação do anunciante]
	 */
	public static function filtrarPelosMeusFabricantes($usuarios_id, $macro) {

		/*
			select * from embarcacao_fabricantes
			INNER JOIN embarcacoes ON embarcacoes.embarcacao_fabricantes_id = embarcacao_fabricantes.id
			INNER JOIN usuarios_embarcacoes ON usuarios_embarcacoes.embarcacoes_id = embarcacoes.id
			AND usuarios_embarcacoes.usuarios_id = 3561
			AND (embarcacoes.status = 1 OR embarcacoes.status = 2 OR embarcacoes.status = 4)
		 */

		// criteria, traz todos os modelos de embarcação do fabricante com status de aguardando pagamento,
		// ativo ou vendido
		$criteria = new CDbCriteria;
		$criteria->join      = 'INNER JOIN embarcacoes ON embarcacoes.embarcacao_fabricantes_id = t.id ';
		$criteria->join     .= 'INNER JOIN usuarios_embarcacoes ON usuarios_embarcacoes.embarcacoes_id = embarcacoes.id';
		// soh embarcações de anuncios
		if($macro == 'anuncio') {
			$criteria->condition = 'usuarios_embarcacoes.usuarios_id = :usuarios_id AND embarcacoes.macros_id != 3';
		}

		// soh embarcs de estaleiro
		else {
			$criteria->condition = 'usuarios_embarcacoes.usuarios_id = :usuarios_id AND embarcacoes.macros_id = 3';
		}

		$criteria->params    = array(':usuarios_id'=>$usuarios_id);
		$fabricantes = self::model()->findAll($criteria);

		// retorna fabricantes
		return $fabricantes;
	}

	public static function listarAtivos() {

		$criteria = new CDbCriteria;@@
		$criteria->order = "titulo asc";
		$criteria->condition = 'status = 1';
		$fabricantes = self::model()->findAll($criteria);
		return $fabricantes;
	}

	/**
	 * Método que devolve um array contendo todos os fabricantes de embarcações
	 * favoritadas do usuario.
	 * @param  [int] $usuarios_id [id do anunciante]
	 * @param [string] [macro] [anuncio ou catálogo]
	 * @return [array]             [modelos de embarcação do anunciante]
	 */
	public static function filtrarPelosMeusFabricantesFavoritos() {

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
		$criteria->join      = 'INNER JOIN embarcacoes ON embarcacoes.embarcacao_fabricantes_id = t.id ';
		$criteria->join     .= 'INNER JOIN embarcacoes_favoritas_usuario ON embarcacoes_favoritas_usuario.embarcacoes_id_embarcacao = embarcacoes.id';
		$criteria->condition = 'embarcacoes_favoritas_usuario.usuarios_id = :usuarios_id';
		$criteria->params    = array(':usuarios_id'=>Yii::app()->user->id);
		$fabricantes = self::model()->findAll($criteria);

		// retorna fabricantes
		return GxHtml::listDataEx($fabricantes);
	}


	/**
	 * @param  [int] $usuarios_id [id do anunciante]
	 * @return [array]             [modelos de embarcação do anunciante]
	 */
	public static function listarFabricantesTabela() {

		/*
			SELECT * FROM embarcacao_fabricantes
			inner join
			tabela_embarcacoes
			on
			tabela_embarcacoes.embarcacao_fabricantes_id = embarcacao_fabricantes.id
		 * Método que devolve um array contendo todos os fabricantes de embarcações
	 * ativos cadastrados na tabela bombarco.
	 */

		$criteria = new CDbCriteria;
		$criteria->join = 'INNER JOIN tabela_embarcacoes ON tabela_embarcacoes.embarcacao_fabricantes_id = t.id ';
		$criteria->condition = "tabela_embarcacoes.status = 1";
		$fabricantes = self::model()->findAll($criteria);

		// retorna modelos
		return $fabricantes;
	}

		/**
	 * Retorna o DropDown de Fabricantes
	 * @param  int $macro [Macro da embarcação para filtrar trultado]
	 * @return array
	 */
	public static function fabricantesTabelaSlug($macro = null) {

		$criteria = new CDbCriteria;
		$criteria->join = 'INNER JOIN tabela_embarcacoes ON tabela_embarcacoes.embarcacao_fabricantes_id = t.id';
		$criteria->order = 't.titulo ASC';
		$criteria->condition = 'tabela_embarcacoes.status = 1';

		if (!empty($macro)){
			$criteria->condition = 't.embarcacao_macros_id = :macro and tabela_embarcacoes.status = 1';
			$criteria->params = array(':macro'=>$macro);
		}

		$fabricantes = self::model()->findAll($criteria);
		return CHtml::listData($fabricantes,'slug','titulo');
	}

	public static function dropDown_() {

		$with = array('embarcacaoModeloses'=>array(
			'with'=>array(
				'embarcacoes'=>array(
					'with' => 'planoUsuarios'
					)
				)
			)
		);

		// Condições:
		// Fabricante ativo (t.status = 1)
		// Modelo ativo (embarcacaoModeloses.status = 1)
		// Embarcação ativa (embarcacoes.status = :status_emb)
		// Embarcação não pode ser de Estaleiro (embarcacoes.macros_id != :macro_estaleiros)
		// O Plano deve estar ativo (planoUsuarios.status = 1)
		// O Plano deve ter iniciado (planoUsuarios.inicio < NOW())
		// O Plano não pode ter acabado (planoUsuarios.fim > NOW())
		$condition = 't.status = 1
					  AND embarcacaoModeloses.status = 1
					  AND embarcacoes.status = :status_emb
					  AND embarcacoes.macros_id = :macro_estaleiros
					  AND planoUsuarios.status = 2';

		$params = array(':status_emb'=>Embarcacoes::ACTIVE, ':macro_estaleiros'=>Macros::$macro_by_slug['estaleiro']);

		$fabricantes = self::model()->with($with)->findAll($condition, $params, array('distinct'=>true, "order"=>"t.titulo asc"));

		return $fabricantes;
	}


	/**
	 * Retorna o DropDown de Fabricantes
	 * @param  [type] $input_name  [NAME do input]
	 * @param  [type] $input_id    [ID do input]
	 * @param  [type] $id          [ID da Macro]
	 * @param  string $placeholder [Texto do primeiro option]
	 * @return [type]              [description]
	 */
	public static function dropDown($input_name, $input_id, $id = null, $placeholder = 'Selecione', $selected = '', $html_options = array()) {

		$with = array('embarcacaoModeloses'=>array(
			'with'=>array(
				'embarcacoes'=>array(
					'with' => 'planoUsuarios'
					)
				)
			)
		);

		// Condições:
		// Fabricante ativo (t.status = 1)
		// Modelo ativo (embarcacaoModeloses.status = 1)
		// Embarcação ativa (embarcacoes.status = :status_emb)
		// Embarcação não pode ser de Estaleiro (embarcacoes.macros_id != :macro_estaleiros)
		// O Plano deve estar ativo (planoUsuarios.status = 1)
		// O Plano deve ter iniciado (planoUsuarios.inicio < NOW())
		// O Plano não pode ter acabado (planoUsuarios.fim > NOW())
		$condition = 't.status = 1
					  AND embarcacaoModeloses.status = 1
					  AND embarcacoes.status = :status_emb
					  AND embarcacoes.macros_id != :macro_estaleiros
					  AND planoUsuarios.status = 2';

		$params = array(':status_emb'=>Embarcacoes::ACTIVE, ':macro_estaleiros'=>Macros::$macro_by_slug['estaleiro']);

		if ($id == null) {
			$fabricantes = self::model()->with($with)->findAll($condition, $params);
		} else {

			// Condição para filtrar de uma Macro
			$condition .= ' AND t.embarcacao_macros_id = :id';
			$params[':id'] = $id;
			$fabricantes = self::model()->with($with)->findAll($condition, $params, array("order"=>"t.titulo asc"));

		}

		// colocar em rodem alfabetica
		//asort($fabricantes, SORT_STRING);

		// Varrendo fabricantes que não tem modelos ou embarcacões
		/*foreach ($fabricantes as $key => $value) {

			// Se existirem Modelos
			if (count($value->embarcacaoModeloses) > 1) {

				// Quantos modelos deste fabricante tem embarcacões
				$check_qnt = 0;

				foreach ($value->embarcacaoModeloses as $key2 => $value2) {

					// Se existirem embarcacões deste modelo, pula para o próximo fabricante
					if (count($value2->embarcacoes) > 0) {
						$check_qnt++;
						continue 2;
					}
				}
				// Se não existe nenhuma embarcacão
				// dentro de nenhum modelo deste Fabricante
				// remove ele
				if ($check_qnt == 0)
					unset($fabricantes[$key]);

			} else {// Se não remove Fabricante
				unset($fabricantes[$key]);
			}
		}*/

		$data = CHtml::listData($fabricantes,'id','titulo');

		// Add opção TODOS
		//$data = array('0'=>'Todas as marcas') + $data;

		$html_options['id'] = $input_id;
		$html_options['empty'] = array('0'=>$placeholder);

		return CHtml::dropDownList($input_name, $selected, $data, $html_options);
	}

	/**
	 * Retorna o DropDown de Fabricantes
	 * @param  int $macro [Macro da embarcação para filtrar trultado]
	 * @return array
	 */
	public static function fabricantesTabela($macro = null) {

		$criteria = new CDbCriteria;
		$criteria->join = 'INNER JOIN tabela_embarcacoes ON tabela_embarcacoes.embarcacao_fabricantes_id = t.id ';
		$criteria->order = 't.titulo ASC';

		if (!empty($macro)){
			$criteria->condition = 't.embarcacao_macros_id = :macro';
			$criteria->params = array(':macro'=>$macro);
		}

		$fabricantes = self::model()->findAll($criteria);

		return CHtml::listData($fabricantes,'id','titulo');
	}


	/**
	 * Método que monta o Slug do Fabricante
	 * para a URL
	 * @param  [type] $model [Model da embarcacão]
	 * @return [type]        [description]
	 */
	public static function mountUrl($model) {

		$macros = array(
			1 => array('slug'=>'jet-skis', 'condition'=>array('N'=>'novos','U'=>'usados')),
			2 => array('slug'=>'lanchas', 'condition'=>array('N'=>'novas','U'=>'usadas')),
			3 => array('slug'=>'veleiros', 'condition'=>array('N'=>'novos','U'=>'usados')),
			4 => array('slug'=>'barcos-pesca', 'condition'=>array('N'=>'novos','U'=>'usados')),
		);

		$url = 'embarcacoes/' . $macros[$model->embarcacaoModelos->embarcacaoFabricantes->embarcacao_macros_id]['slug'] . '-a-venda/' . $model->embarcacaoModelos->embarcacaoFabricantes->slug;

		return Yii::app()->createUrl($url);

	}


	/**
	 * [slugifing description]
	 * @return [type] [description]
	 */
	public function slugifing($t =null, $a=null) {
		
		// executa o slugify
		$slug = Utils::slugify($this->titulo);

		// verifica se existe esse slug no banco
		// e não é o próprio item
		$criteria = new CDbCriteria();
		$criteria->addCondition('t.slug LIKE :slug AND t.embarcacao_macros_id = :macro');
		$criteria->params = array(':slug'=>$slug.'%', ':macro'=>$this->embarcacao_macros_id);

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
}