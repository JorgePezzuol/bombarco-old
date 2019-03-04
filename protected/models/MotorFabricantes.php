<?php

Yii::import('application.models._base.BaseMotorFabricantes');

class MotorFabricantes extends BaseMotorFabricantes
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function beforeSave() {

		if($this->scenario == 'update') {

			$this->isNewRecord = false;

			if($this->titulo != $this->oldAttributes['titulo']){

				$this->slug = MotorFabricantes::gerarSlug($this);
		    }
		}

		else {

			if(self::model()->exists('titulo=:titulo', array(':titulo'=>$this->titulo))) {
				$this->addError('titulo', 'Marca do motor já existe!');
				return false;
			}
		}
	
		return parent::beforeSave();
	}

	public static function gerarSlug($motorFabricante) {

		$slug = preg_replace('#[ -]+#', '-', $motorFabricante->titulo);

		$existe = MotorFabricantes::model()->exists("slug = :slug", array(":slug" => $slug));
        
        if($existe) {
            for($i = 2; $i < 1000; $i++) {
                $slug_ = "";
                $slug_ = $slug."-".$i;
                $existe = MotorFabricantes::model()->exists("slug = :slug", array(":slug" => $slug_));
                if($existe) {
                    continue;
                }
                $slug = $slug_;
                break;
            }
        }

        return $slug;
	}

	public static function getDropDown($nomeCampoUf, $nomeCampoModelosMotor = null) {

		$model = self::model()->findAll('status = 1 order by titulo asc');

		echo CHtml::dropDownList($nomeCampoUf,'', $model,
			array(
				'prompt'=>'Marcas',
				'class'=>'motor_fabricante',
				'ajax' => array(
					'type'=>'POST', 
					'url'=>Yii::app()->createUrl('utils/loadMotorModelos'),
					'update'=>'#'.$nomeCampoModelosMotor,
					'data'=>array('motor_fabricantes_id'=>'js:this.value')
				)
			)
		);
	}

	public static function dropDown($input_name, $input_id, $placeholder = 'Selecione', $selected = '', $html_options = array()) {

		$criteria = new CDbCriteria();
        $criteria->condition = "t.status = 1";
        $criteria->order = "titulo asc";
 
        $marcas = MotorFabricantes::model()->findAll($criteria);

        $data = CHtml::listData($marcas,'slug','titulo');

        $html_options['id'] = $input_id;
        $html_options['empty'] = array(""=>$placeholder);

        return CHtml::dropDownList($input_name, $selected, $data, $html_options);
    }
}