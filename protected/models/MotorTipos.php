<?php

Yii::import('application.models._base.BaseMotorTipos');

class MotorTipos extends BaseMotorTipos
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function beforeSave() {


		if($this->scenario == 'update') {

			$this->isNewRecord = false;

			if($this->titulo != $this->oldAttributes['titulo']){

				$this->slug = MotorTipos::gerarSlug($this);
		    }
		}

		else {
			if(self::model()->exists('titulo=:titulo', array(':titulo'=>$this->titulo))) {
				$this->addError('titulo', 'Tipo de motor já existe!');
				return false;
			}	
		}

		
	
		return parent::beforeSave();
	}

	public static function gerarSlug($motorTipos) {

		$slug = preg_replace('#[ -]+#', '-', $motorTipos->titulo);

		$existe = MotorTipos::model()->exists("slug = :slug", array(":slug" => $slug));
        
        if($existe) {
            for($i = 2; $i < 1000; $i++) {
                $slug_ = "";
                $slug_ = $slug."-".$i;
                $existe = MotorTipos::model()->exists("slug = :slug", array(":slug" => $slug_));
                if($existe) {
                    continue;
                }
                $slug = $slug_;
                break;
            }
        }

        return $slug;
	}

	public static function dropDown($input_name, $input_id, $placeholder = 'Selecione', $selected = '', $html_options = array()) {

        $condition = "t.status = :status";
        $params = array(":status" => 1);
        $marcas = MotorTipos::model()->findAll($condition, $params, array("order"=>"t.titulo asc"));

        $data = CHtml::listData($marcas,'slug','titulo');

        $html_options['id'] = $input_id;
        $html_options['empty'] = array(""=>$placeholder);

        return CHtml::dropDownList($input_name, $selected, $data, $html_options);
    }
}