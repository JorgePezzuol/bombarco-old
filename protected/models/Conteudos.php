<?php

Yii::import('application.models._base.BaseConteudos');

class Conteudos extends BaseConteudos
{
	/*
		Atributos extras
	 */
	public $titulo_categoria;
	public $slug_categoria;

	// Constantes
	const PATH_IMAGES = "public/conteudos";
	const LIMIT_SEARCH = 12;

	// Categorias de conteúdos
	public static $categorias_by_slug = array('noticias'=>'N', 'blog'=>'B', 'primeiro_barco'=>'P', 'teste'=>'T');
	public static $categorias_by_char = array('N'=>'noticias', 'B'=>'blog', 'P'=>'primeiro-barco', 'T'=>'teste-bombarco');

	public static function label($n = 1) {
		return Yii::t('app', 'Conteudo|Conteudos', $n);
	}

	public function attributeLabels() {
		return array(
			'id' => Yii::t('app', 'ID'),
			'macro' => Yii::t('app', 'Macro'),
			'titulo' => Yii::t('app', 'Titulo'),
			'texto' => Yii::t('app', 'Texto'),
			'facebook' => Yii::t('app', 'Facebook'),
			'video' => Yii::t('app', 'Video'),
			'status' => Yii::t('app', 'Habilitado'),
			'conteudo_categorias_id' => null,
			'usuarios_id' => null,
			'embarcacoes_id' => null,
			'conteudoImagens' => null,
			'conteudoCategorias' => null,
			'usuarios' => null,
			'embarcacoes' => null,
		);
	}

	// macros
	public static $macros = array('N' => 'Notícias', 'B' => 'Blog', 'P' => 'Primeiro Barco', 'T' => 'Teste Bom Barco');

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function scopes() {
		return array(
			'sitemap_noticias'=>array('select'=>'id, slug', 'condition'=>'status = 1 AND macro = "N"', 'order'=>'data ASC'),
			'sitemap_primeiro_barco'=>array('select'=>'id, slug', 'condition'=>'status = 1 AND macro = "P"', 'order'=>'data ASC'),
			'sitemap_blog'=>array('select'=>'id, slug, conteudoCategorias.slug AS slug_categoria', 'with'=>'conteudoCategorias', 'condition'=>'status = 1 AND t.macro = "B"', 'order'=>'data ASC'),
			'sitemap_teste'=>array('select'=>'id, slug', 'condition'=>'status = 1 AND macro = "T"', 'order'=>'data ASC'),
		);
	}

	public function beforeValidate() {

		/*
		 * Gerando o SLUG
		 * fazendo validacão no banco pra ver se o slug já existe
		 */		
		if($this->isNewRecord)
		$this->slug = parent::slugifing($this->titulo, $this);

		return parent::beforeValidate();
	}


	/**
	 * Trata os dados após pegar no banco
	 * @return [type] [description]
	 */
	public function afterFind() {

		// tratando a data
		$this->data = str_replace(' 00:00:00', '', date("d/m/Y H:i:s", strtotime($this->data)));

		return parent::afterFind();

	}

		// método que formata a data para salvar no banco
	public static function formatDateTimeToDb($datetime) {
        $tmp = strtotime(str_replace("/", "-", $datetime));
        return date("Y-m-d H:i:s", $tmp);
    }

    // método que formata a data para exibir na view
    public static function formatDateTimeToView($datetime) {
        $tmp = strtotime($datetime);
        return date("d/m/Y", $tmp);
    }


	/**
	 * Método que exibe a thumbnail do conteúdo
	 * @param  [type]  $model       [Model da empresa/estaleiro]
	 * @param  array   $array_image [Array HTML da image]
	 * @param  array   $array_link  [Array HTML do link]
	 * @param  boolean $link        [FALSE = retorna IMG, TRUE = retorna o link montado]
	 * @param  [type] $slug_route   [rota da comunidade]
	 * @return [type]               [description]
	 */
	public static function getThumb($model, $array_image = array(), $link = false, $slug_route = 'noticias', $array_link = array()) {		

		if (count($model->conteudoImagens) > 0) {
			$url = Yii::getPathOfAlias('webroot') . '/' . self::PATH_IMAGES . '/' . $model->conteudoImagens[0]->imagem;
		} else {
			$url = Yii::getPathOfAlias('webroot') . '/themes/bombarco/' . Utils::IMAGE_FAKE;
		}
		
		$thumb = @Yii::app()->easyImage->thumbSrcOf($url, array('scaleAndCrop'=>array('width'=>225, 'height'=>225)));
		$image = CHtml::image($thumb, $model->titulo, $array_image);

		// Se for Link, retorna o link completo
		if ($link === true) {
			return CHtml::link($image, Yii::app()->createUrl(self::mountUrl($model)), $array_link);
		} else { // Se não retorna só a IMG
			return $image;
		}
		
	}


		// lista as thumbs das noticias na home (index.php)
	public static function getThumbIndex($model, $array_image = array(), $link = false, $slug_route = 'noticias', $array_link = array()) {		

		if (count($model->conteudoImagens) > 0) {
			$url = Yii::getPathOfAlias('webroot') . '/' . self::PATH_IMAGES . '/' . $model->conteudoImagens[0]->imagem;
		} else {
			$url = Yii::getPathOfAlias('webroot') . '/themes/bombarco/' . Utils::IMAGE_FAKE;
		}
		
		$thumb = @Yii::app()->easyImage->thumbSrcOf($url, array('scaleAndCrop'=>array('width'=>200, 'height'=>120)));
		$image = CHtml::image($thumb, $model->titulo, $array_image);

		// Se for Link, retorna o link completo
		if ($link === true) {
			return CHtml::link($image, Yii::app()->createUrl(self::mountUrl($model)), $array_link);
		} else { // Se não retorna só a IMG
			return $image;
		}
		
	}

	// lista as thumbs do raio x na home (index.php)
	public static function getThumbRaioX($model, $width, $height) {		

		if (count($model->conteudoImagens) > 0) {
			$url = Yii::getPathOfAlias('webroot') . '/' . self::PATH_IMAGES . '/' . $model->conteudoImagens[0]->imagem;
		} else {
			$url = Yii::getPathOfAlias('webroot') . '/themes/bombarco/' . Utils::IMAGE_FAKE;
		}
		

		$thumb = @Yii::app()->easyImage->thumbSrcOf($url, array('scaleAndCrop'=>array('width'=>$width, 'height'=>$height)));

		return $thumb;
		
	}

	/**
	 * Monta a URL do Conteúdo
	 * @param  [type] $model [description]
	 * @return [type]        [description]
	 */
	public static function mountUrl($model, $slug_content = null) {

		$slug = self::$categorias_by_char[$model->macro];

		if ($model->macro == 'B') {
			$categoria = (isset($model->conteudoCategorias) && $model->conteudoCategorias != null) ? $model->conteudoCategorias->slug . '/' : '';
			$url = 'comunidade/' . $slug . '/' . $categoria . $model->slug;
		} else {
			$url = 'comunidade/' . $slug . '/' . $model->slug;
		}		

		return Yii::app()->createUrl($url);
	}



	/**
	 * Retorna o Path da imagem
	 * @param  [type] $image [Imagem]
	 * @return [type]        [description]
	 */
	public static function getPath($image = null) {

		if ($image == null) {
			return Yii::app()->theme->baseUrl . '/img/sem_foto_bb.jpg';
		} else {
			return Yii::app()->baseUrl . '/' . self::PATH_IMAGES . '/' . $image;
		}

	}


	// grid
	public function search() {
		$criteria = new CDbCriteria;

		$criteria->compare('id', $this->id);
		$criteria->compare('macro', $this->macro, true);
		$criteria->compare('titulo', $this->titulo, true);
		$criteria->compare('texto', $this->texto, true);
		$criteria->compare('facebook', $this->facebook, true);
		$criteria->compare('video', $this->video, true);
		$criteria->compare('status', $this->status);
		$criteria->compare('conteudo_categorias_id', $this->conteudo_categorias_id);
		$criteria->compare('usuarios_id', $this->usuarios_id);
		$criteria->compare('embarcacoes_id', $this->embarcacoes_id);
		$criteria->compare('macros_id', $this->macros_id);
		$criteria->compare('embarcacao_macros_id', $this->embarcacao_macros_id);
		$criteria->compare('slug', $this->slug, true);
		$criteria->compare('data', $this->data, true);

		$criteria->order ='t.id desc';

		return new CActiveDataProvider($this, array(
			'criteria' => $criteria,
		));
	}


}