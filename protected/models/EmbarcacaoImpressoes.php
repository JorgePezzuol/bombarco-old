<?php

Yii::import('application.models._base.BaseEmbarcacaoImpressoes');

class EmbarcacaoImpressoes extends BaseEmbarcacaoImpressoes
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function beforeSave() {

		// muultiplicar por 1000 o limit de views
		//$this->limitviews = $this->limitviews * 1000;

		if($this->isNewRecord) {
			$this->views = 0;
			$this->clicks = 0;	
		}
		

		return parent::beforeSave();
	}


	/**
	 * Soma impressões
	 * Se não atingiu o limite de impressões, nem o limite da data
	 * @param [type] $model [Model resultado]
	 */
	public static function addViews($model) {

		if ($model != null && count($model) > 0) {

			$ids = array();
			foreach ($model as $key => $value) {
				$ids[] = $value->id;
			}

			self::model()->updateCounters(array('views' => 1), 'limitviews > views AND embarcacoes_id IN ( ' . implode(',',$ids) . ' )');	

		}		

	}

}