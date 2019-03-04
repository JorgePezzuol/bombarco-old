<?php

class MaillingsController extends GxController {

public function filters() {
	return array(
			'accessControl', 
			);
}

public function accessRules() {
	return array(
			array('allow',
				'actions'=>array('create'),
				'users'=>array('*'),
				),
			array('allow', 
				'actions'=>array('minicreate','update','view'),
				'users'=>array('@'),
				),
			array('allow', 
				'actions'=>array('admin','delete'),
				                'expression'=> function() {
                    if(Yii::app()->user->isAtendimento() || Yii::app()->user->isAdmin()) {
                        return true;
                    }
                    return false;
                }
				),
			array('deny', 
				'users'=>array('*'),
				),
			);
}

	

	public function actionView($id) {
		$this->render('view', array(
			'model' => $this->loadModel($id, 'Maillings'),
		));
	}

	// cria mailling e dispara email via ajax
	// Return: -1 => erro
	// 			1 => sucesso
	// 			-3 => email já cadastrado (erro)
	public function actionCreate() {

		if(isset($_POST)) {

			$model = new Maillings;
			$model->email = $_POST['email'];
			$model->useragent = $_POST['user_agent'];
			$model->data = date('Y-m-d H:i:s');

			if(Maillings::model()->exists('email=:email', array(':email'=>$model->email))) {
				// email já cadastrado
				echo '-3';
			}

			else {
				// validar
				if($model->validate()) {
						// se salvar, enviar email
						if($model->save()) {

						// enviar email para usuario		
						$message = new YiiMailMessage;
				        $message->view = "mail_mailling";	
				        $message->subject = 'Newsletter BomBarco';
				        $message->setBody(array('email'=>$_POST['email']), 'text/html');             
				        $message->addTo($_POST['email']);
				        $message->from = Yii::app()->params['bombarcoAtendimento'];

				        // envia msg
				        if(!Yii::app()->mail->send($message)) {

				        	// erro
				        	echo '-1';
				        }  

				        // msg enviada ok
				        else {
				        	echo '1';
				        }	
						
					}

					else {
						echo '-1';
					}
				}
			
			}
		}
		
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Maillings');


		if (isset($_POST['Maillings'])) {
			$model->setAttributes($_POST['Maillings']);

			if ($model->save()) {
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Maillings')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}

	public function actionAdmin() {
		$model = new Maillings('search');
		$model->unsetAttributes();

		if (isset($_GET['Maillings']))
			$model->setAttributes($_GET['Maillings']);

		$this->render('admin', array(
			'model' => $model,
		));
	}

}