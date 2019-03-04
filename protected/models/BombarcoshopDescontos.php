<?php

Yii::import('application.models._base.BaseBombarcoshopDescontos');

class BombarcoshopDescontos extends BaseBombarcoshopDescontos
{
	public static function model($className=__CLASS__) {
		return parent::model($className);
	}

	public function gerarCodigoDesconto($length) {

		$characters = '123456789abcdefghjkmnpqrstuvwxyz';
	    $charactersLength = strlen($characters);
	    $randomString = '';
	    for ($i = 0; $i < $length; $i++) {
	        $randomString .= $characters[rand(0, $charactersLength - 1)];
	    }
	    return $randomString;
	}

	/*
	<?php 

		function generateRandomString($length = 5) {
		    $characters = '123456789abcdefghjkmnpqrstuvwxyz';
		    $charactersLength = strlen($characters);
		    $randomString = '';
		    for ($i = 0; $i < $length; $i++) {
		        $randomString .= $characters[rand(0, $charactersLength - 1)];
		    }
		    return $randomString;
		}
		$rand = generateRandomString();

		$rand = chunk_split($rand, 5, '-');
		var_dump(rtrim(strtoupper($rand), '-'));

		$valor = 75.00;
		//$desconto = $valor * 0.30;
		$desconto = $porcentagem_desconto / 100;
		$valorcomdesconto = $valor - $desconto;
		var_dump($valorcomdesconto);
		?>
	*/
}