<?php

Yii::import('application.models._base.BasePlanos');

class Planos extends BasePlanos
{

	public $titulo_dropdown;

	/**
	 * Flags que representam os tipos dos Planos
	 * @var array
	 */
	public static $_flags = array(
		'INDIVIDUAL' 	=> 'anuncio_individual',
		'EMBARCACOES' 	=> 'plano_embarcacao',
		'EMPRESA' 		=> 'plano_empresa',
		'ESTALEIRO' 	=> 'plano_estaleiro',
	);

	public static function model($className=__CLASS__) {

		return parent::model($className);
	}

	public function scopes() {
		return array(
			'non_individual' => array(
					'condition' => 'flag != :macro',
					'params' => array(':macro'=>Planos::$_flags['INDIVIDUAL'])
				)
		);
	}


	public function afterFind() {

		// Título para dropdowns
		$this->titulo_dropdown = (isset($this->macros)) ? $this->macros->titulo . ': ' . $this->titulo : null;

		return parent::afterFind();
	}


	// Método que lista informações de ANÚNCIOS da tabela planos
	public static function listarPlanosDeAnuncios() {
		$criteria = new CDbCriteria();
		$criteria->select = 'id, duracaomeses, limitepreco, valor, qntpermitida';
		$criteria->condition = 'flag = "anuncio_individual" OR flag = "plano_embarcacao" AND status = 1';
		return Planos::model()->findAll($criteria);
	}


	// Método que retorna um array que contém todos os planos e as informações
	// dos mesmos (planos de anuncio de embarcação)
	public static function validarPlanoDeAnuncio($id) {

		$planosDeAnuncio = Planos::model()->findByPk($id);

		if( ($planosDeAnuncio != null) && ($planosDeAnuncio->flag == 'plano_embarcacao' || $planosDeAnuncio->flag == 'anuncio_individual') ) {
			return $planosDeAnuncio;
		}

		return null;
	}


	// Método que retorna um array que contém todos os planos e as informações
	// dos mesmos (plano de empresa)
	public static function validarPlanoDeEmpresa($id) {

		$planoEmpresa = Planos::model()->findByPk($id);

		if($planoEmpresa != null && $planoEmpresa->flag == 'plano_empresa') {
			return $planoEmpresa;
		}

		return null;
	}

	// Método que retorna um array que contém todos os planos e as informações
	// dos mesmos (plano de estaleiro) 
	public static function validarPlanosEstaleiro($id) {

		$planoEstaleiro = Planos::model()->findByPk($id);

		if($planoEstaleiro != null && $planoEstaleiro->flag == 'plano_estaleiro') {
			return $planoEstaleiro;
		}

		return null;

	}

	// método que verifica se o ID do plano passado cai no plano de anuncio individual
	// (os IDs dos planos individuais são do 1 até o 12)
	public static function isAnuncioIndividual($id) {

		$plano = self::model()->findByPk($id);

		if($plano != null) {
			if($plano->flag == 'anuncio_individual') 
				return true;
			else
				return false;
		}

		return false;
	}

	public static function isPlanoEstaleiro($id) {

		$plano = self::model()->findByPk($id);

		if($plano != null) {
			if($plano->flag == 'plano_estaleiro') 
				return true;
			else
				return false;
		}

		return false;

	}

	public function isPlanoAnuncio($id) {

		$plano = self::model()->findByPk($id);

		if($plano != null) {
			if($plano->flag == 'plano_embarcacao') 
				return true;
			else
				return false;
		}

		return false;
	}



	public static function dropDownPlanos($input_name, $macro = 'vendedor', $html_options = array()) {

		$model = self::model()->findAll('macros_id = :macro', array(':macro'=>Macros::$macro_by_slug[$macro]));

		$listData = CHtml::listData($model, 'id', 'titulo');
		$html_options['prompt'] = 'Selecione o Plano';

		echo CHtml::dropDownList($input_name, '', $listData, $html_options);
	}

	public static function listarPlanos($macro) {

		return CHtml::listData(self::model()->findAll('macros_id = :macro', array(':macro'=>Macros::$macro_by_slug[$macro])), 'id', 'titulo');
	}


	/**
	 * Método que monta um array para data-attributes de <option>
	 * Usado no cadastro/edição de planos
	 * @return [type] [description]
	 */
	public static function arrayOptionsPlanos() {

		$planos = self::model()->findAll();
		$data_array = array();

		foreach ($planos as $key => $value) {
			
			$data_array[$value->id] = array(
				'data-time' => $value->duracaomeses,
				'data-qnt' => $value->qntpermitida,
				'data-macro' => $value->macros_id
			);
		}

		return $data_array;
	}

}