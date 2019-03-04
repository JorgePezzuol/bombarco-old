<?php
class Aidax {

	public static function setJsonToAttributes($model, $json) {      
	  $json = json_decode($json);
        
        // Se o Decode for NULL converte em JSON
        if (empty($json)) {
            $json = json_decode(json_encode($json));
        }
        
        foreach ($json as $key => $value) {
            $model->$key = $value;
        }               
         } 


	/* ARRAY DE DEFINIÇÕES DO AIDAX */
	public static $configuracoes = array(

		// server key
		'skey' => 'bd2838a3-abdc-4b1b-b5cb-53596ff27432',

		// client key
		'ckey'=> '8d4fb885-2ccf-42f9-a84f-6c46b24cbb5f'
	);


	/* traquear email do usuario com o AIDAX enviando dados adicionais */
	
	/* Traquear email de usuario com o AIDAX no login */
	public static function traquearEmailAidax($email, $dados = array()) {
		
		// foram passados dados adicionais
		if($dados != null) {

			$url = 'https://aidax.com.br/identify?skey='.self::$configuracoes["skey"].'&uid='.$email.'&origin=browser&p='.json_encode($dados).'&ts='.time();
		}

		// sem dados adicionais, só capturar o email
		else {
			$url = 'https://aidax.com.br/identify?skey='.self::$configuracoes["skey"].'&uid='.$email.'&origin=browser&ts='.time();
		}

		$ch = curl_init();
		$options = array(
		    CURLOPT_URL            => $url,
		    CURLOPT_RETURNTRANSFER => true,
		    CURLOPT_HEADER         => true,
		    CURLOPT_FOLLOWLOCATION => true,
		    CURLOPT_ENCODING       => "",
		    CURLOPT_SSL_VERIFYPEER => false,
		    CURLOPT_SSL_VERIFYHOST => false,
		    CURLOPT_AUTOREFERER    => true,
		    CURLOPT_CONNECTTIMEOUT => 7,
		    CURLOPT_TIMEOUT        => 7,
		    CURLOPT_MAXREDIRS      => 10,
		);

		curl_setopt_array( $ch, $options );
		$response = curl_exec($ch); 
		//$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

		/*if ( $httpCode != 200 ){
		    echo "Return code is {$httpCode} \n"
		        .curl_error($ch);
		} else {
		    echo "<pre>".htmlspecialchars($response)."</pre>";
		}*/


		curl_close($ch);
	}

}