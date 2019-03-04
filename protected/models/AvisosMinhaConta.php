<?php

Yii::import('application.models._base.BaseAvisosMinhaConta');

class AvisosMinhaConta extends BaseAvisosMinhaConta
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public static function enviarAviso($model) {

		$embarcacao_fabricantes_id = $model->embarcacao_fabricantes_id;
		$embarcacao_modelos_id = $model->embarcacao_modelos_id;
		$embarcacao_macros_id = $model->embarcacao_macros_id;

		$avisos = AvisosMinhaConta::model()->findAll("embarcacao_fabricantes_id = :fab_id AND embarcacao_modelos_id = :mod_id AND embarcacao_macros_id = :cat_id",
			array(":fab_id" => $embarcacao_fabricantes_id, ":mod_id" => $embarcacao_modelos_id, ":cat_id" => $embarcacao_macros_id));

		if(count($avisos) > 0) {

			$link = Embarcacoes::mountAbsoluteUrl($model);

			foreach($avisos as $av) {

				$user = Usuarios::model()->findByPk($av->usuarios_id);
				$nome = $user->nome;

		        $message = new YiiMailMessage;
		        $message->view = "mail_aviso";
		        $message->subject = 'BomBarco - Um novo anúncio pode te interessar!';
		        $message->setBody(array('nome' => $nome, 'link' => $link), 'text/html');
		        $message->addTo($user->email);
		        //$message->addTo("jorge_pezzuol@hotmail.com");
		        $message->from = Yii::app()->params['bombarcoAtendimento'];

		        Yii::app()->mail->send($message);
			}
		}



	}
}