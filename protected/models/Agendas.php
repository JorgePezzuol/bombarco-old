<?php

Yii::import('application.models._base.BaseAgendas');

class Agendas extends BaseAgendas
{

	const PATH_IMAGES = "public/agendas";
	const LIMIT_SEARCH = 12;

	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function scopes() {
		return array(
			'sitemap'=>array('select'=>'slug', 'condition'=>'', 'order'=>'data_inicio ASC'),
		);
	}


	public function afterFind() {

		/*$this->data_inicio = Yii::app()->dateFormatter->formatDateTime(
						        CDateTimeParser::parse(
						            $this->data_inicio, 'dd/MM/yyyy hh:mm:ss'
						        ), 'short', 'short'
						     );		

		$this->data_fim = Yii::app()->dateFormatter->formatDateTime(
						        CDateTimeParser::parse(
						            $this->data_fim, 'dd/MM/yyyy hh:mm:ss'
						        ), 'short', 'short'
						  );


		// Se não tiver hora definida, não aparece
		$this->data_inicio = str_replace(' 00:00:00', '', $this->data_inicio);
		$this->data_fim = str_replace(' 00:00:00', '', $this->data_fim);*/

		return parent::afterFind();
	}

	  // método que formata a data para exibir na view
    public static function formatDateTimeToView($datetime) {
        $tmp = strtotime($datetime);
        return date("d/m/Y", $tmp);
    }


	/**
	 * Monta a URL da Agenda
	 * @param  [type] $model [description]
	 * @return [type]        [description]
	 */
	public static function mountUrl($model) {
		return Yii::app()->createUrl("comunidade/agenda/".$model->slug);
	}

}