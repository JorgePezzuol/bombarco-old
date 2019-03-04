<?php

Yii::import('application.models._base.BaseSitemap');

class Sitemap extends BaseSitemap
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}


	/**
	 * Monta o array de URLs avulsas
	 * @return [type] [description]
	 */
	public function getSitemap() {

		$urls = self::model()->findAllByAttributes(array('status' => 1));
		$map = array();

		foreach ($urls as $key => $value) {
			
			$map[] = array(
                        'loc' => $value->loc,
                        'frequency' => (empty($value->frequency)) ? 'daily' : $value->frequency,
                        'priority' => (empty($value->priority)) ? '1' : $value->priority
                    );
		}

		return $map;
	}


}