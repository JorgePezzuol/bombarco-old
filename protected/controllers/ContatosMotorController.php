<?php

class ContatosMotorController extends GxController {


	public function filters() {
		return array(
				'accessControl', 
				);
	}

	public function accessRules() {
		return array(
			    array('allow',
	                'actions' => array('enviarMsg'),
	                'users' => array('*'),
	            ),
				array('allow', 
					'actions'=>array('criarPlanoMotor', 'anunciarMotor', 'previewMotor'),
					'users'=>array('@'),
					),
				array('allow', 
					'actions'=>array('admin'),
					'users'=>array('admin'),
					),
				array('deny', 
					'users'=>array('*'),
					),
				);
	}


	public function actionEnviarMsg() {

        // Honeypot
        if (!isset($_POST['j8BSVuvy']) || !empty($_POST['j8BSVuvy'])) {
            echo '0';
            exit;
        }

        $contato = new Contatos();
        $contato->setAttributes($_POST["ContatosMotor"]);
        $contato->data = date('Y-m-d H:i:s');

        if($contato->email_dest == $contato->email_rem) {
        	echo '0';
        	exit;
        }

        if($contato->save()) {

        	$parser = new CHtmlPurifier();

        	$motor = MotorAnuncio::model()->findByPk($contato->motor_anuncio_id);
        	$nome_anuncio = MotorAnuncio::nomeAnuncio($motor);

        	$message = new YiiMailMessage;
            //$message->addTo("jorge_pezzuol@hotmail.com");
            $message->addTo($contato->email_dest);
            $message->view = "contato_motor";
            $message->subject = 'Contato - ' . $nome_anuncio;
            $message->addBcc("bombarcoadm@gmail.com");
            $message->addBcc("atendimento@bombarco.com.br");
            $message->from = Yii::app()->params['bombarcoAtendimento'];
            $message->setReplyTo($parser->purify($contato->email_rem));

            $message->setBody(
                array(
                    'nome_destinatario' => $motor->usuarios->nome . " " .$motor->usuarios->sobrenome,
                    'nome_rem' => $contato->nome_rem,
                    'email_rem' => $contato->email_rem,
                    'mensagem' => $contato->mensagem,
                    'id_contato' => $contato->id,
                    'telefone' => $contato->telefone_rem,
                    'anuncio' => $nome_anuncio,
                    'link' => MotorAnuncio::gerarLinkAbsoluto($motor)
                ),
                'text/html'
            );
            
            if (Yii::app()->mail->send($message)) {
                echo '1';
                exit;
            }
        }
	}
}

?>