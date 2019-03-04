<?php

class EmbarcacaoModelosController extends GxController {

	public function init() {
		Yii::app()->getClientScript()->registerScriptFile(Yii::app()->baseUrl . '/js/admin_embarcacoes_modelos.js', CClientScript::POS_END);
	}

	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
				array('allow', 
						'actions'=>array('index','view','admin','delete','minicreate','create','update','changestatus', 'AJAXModelo', 'AJAXFromId'),
										                'expression'=> function() {
	                    if(Yii::app()->user->isAtendimento() || Yii::app()->user->isAdmin()) {
	                        return true;
	                    }
	                    return false;
	                }
				),
				array('allow',
					'actions' => array('AJAXfromFabricante'),
					'users'=>array('*')
				),
				array('allow',
					'actions'=>array('validarNomeModelo'),
					'users'=>array('@'),
				),
				array('deny', 
					'users'=>array('*'),
					),
				);
	}

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'EmbarcacaoModelos'),
		));
	}

	public function actionCreate() {
		$model = new EmbarcacaoModelos;

		if (isset($_POST['EmbarcacaoModelos'])) {

			$model->setAttributes($_POST['EmbarcacaoModelos']);
			$model->status = 1;

			try {
				if ($model->save()) {
					
					if (Yii::app()->getRequest()->getIsAjaxRequest())
						Yii::app()->end();

					$this->redirect(array('view', 'id' => $model->id));
				}

			} catch (Exception $e) {
				$model->addError('embarcacao_macros_id', 'Ocorreu um erro ao cadastrar');
			}
			
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'EmbarcacaoModelos');


		if (isset($_POST['EmbarcacaoModelos'])) {
			$model->setAttributes($_POST['EmbarcacaoModelos']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$fabricantes = CHtml::listData(EmbarcacaoFabricantes::model()->findAll('embarcacao_macros_id = :id AND status = 1', array(':id'=>$model->embarcacao_macros_id)),'id','titulo');
		$tipos = CHtml::listData(EmbarcacaoTipos::model()->findAll('embarcacao_macros_id = :id', array(':id'=>$model->embarcacao_macros_id)),'id','titulo');

		$this->render('update', array(
					'model' => $model,
					'fabricantes' => $fabricantes,
					'tipos' => $tipos
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'EmbarcacaoModelos')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionIndex() {
		$dataProvider = new CActiveDataProvider('EmbarcacaoModelos');
		$this->render('index', array(
			'dataProvider' => $dataProvider,
		));
	}

	public function actionAdmin() {
		$model = new EmbarcacaoModelos('search');
		$model->unsetAttributes();

		if (isset($_GET['EmbarcacaoModelos']))
			$model->setAttributes($_GET['EmbarcacaoModelos']);

		$this->render('admin', array(
			'model' => $model,
		));
	}


	/**
	 * Action que altera o Status
	 * Se estiver Ativado, desativa
	 * Se estiver Desativado, ativa
	 * @param  [type] $id [ID do Modelo]
	 * @return [type]     [description]
	 */
	public function actionChangeStatus($id) {

		$model = EmbarcacaoModelos::model()->findByPk($id);

		if ($model->status == 0) {
			$model->status = 1;
		} else if ($model->status == 1) {
			$model->status = 0;
		}

		$model->update();
		$this->redirect(Yii::app()->request->urlReferrer);

	}

		/*
	* validar se modelo ja existe baseado no titulo e no id do fab
	* return 1 => mode existe
	*		 0 => modelo não existe
	*/
	public function actionValidarNomeModelo() {

		/*$nomeModelo = $_POST['nomeModelo'];
		$id_fab = EmbarcacaoFabricantes::model()->findByPk((int)$_POST['fabricante'])->id;

		$modelo = EmbarcacaoModelos::model()->find('titulo=:titulo', array(':titulo'=>$nomeModelo));


		// verificar se existe
		if(EmbarcacaoModelos::model()
			->exists('embarcacao_fabricantes_id=:id AND titulo=:titulo and status = 1', 
				array(':id'=>$id_fab, ':titulo'=>$nomeModelo))) {
			echo '-1';
		}

		else {

			echo '0';
		}*/

		echo '0';

	}



	/**
     * Carrega todos os fabricantes a partir da Macro
     * AJAX
     * @return [type] [description]
     */
    public function actionAJAXfromFabricante() {

        $fabricante = Yii::app()->request->getPost('fabricante_id');

        if (!empty($fabricante)) {
            echo CJSON::encode(EmbarcacaoModelos::selectAllFromFabricante($fabricante));
            exit();
        }

        echo null;
        exit();
    }


    public function actionAJAXfromId() {

    	$id = Yii::app()->request->getPost('modelo_id');
        $fabricante = EmbarcacaoModelos::model()->findByPk($id)->embarcacao_fabricantes_id;

        if (!empty($fabricante)) {
            echo CJSON::encode(EmbarcacaoModelos::selectAllFromFabricante($fabricante));
            exit();
        }

        echo null;
        exit();
    }


    public function actionAJAXModelo() {

    	$id = Yii::app()->request->getPost('modelo_id');

    	if (empty($id))
    		return null;    	

    	$modelo = EmbarcacaoModelos::model()->findByPk($id);

    	$json = json_decode(CJSON::encode($modelo));   
    	$json->tipo_titulo = $modelo->tipo_titulo;
    	
    	echo json_encode($json);
    	exit();
    }

}