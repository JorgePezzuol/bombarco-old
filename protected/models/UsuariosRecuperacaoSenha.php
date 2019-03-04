<?php

Yii::import('application.models._base.BaseUsuariosRecuperacaoSenha');

class UsuariosRecuperacaoSenha extends BaseUsuariosRecuperacaoSenha
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	// Método que envia um email para o usuário contendo um token de segurança
	// para alterar a senha
	// Params: 
	// 		$id_usuario => ID do usuário que esqeceu a senha
	// Return: 
	// 		true => tudo OK
	// 		false => erro ao enviar o email
	public static function enviarEmailDeRecuperacao(Usuarios $usuario) {

		// token
		$token = md5(uniqid(rand(), true));

		//
		$recSenha = new UsuariosRecuperacaoSenha;
		$recSenha->token = $token;
		$recSenha->usuarios_id = $usuario->id;

		// salvar e enviar email
		if($recSenha->save()) {

			$message = new YiiMailMessage;

	           //this points to the file test.php inside the view path
	        $message->view = "mail_esqeceu_senha";
	        $message->subject = 'Recuperação de Senha - Bombarco';
	        $message->setBody(array('usuario'=>$usuario, 'token'=>$token), 'text/html');             
	        $message->addTo($usuario->email);
	        $message->from = 'atendimento@bombarco.com.br';   
	        

	        if(Yii::app()->mail->send($message)) {
	        	return true;
	        }  
	        else {
	        	return false;
	        }
	
		}


		// erro
		return false;
		
	}
}