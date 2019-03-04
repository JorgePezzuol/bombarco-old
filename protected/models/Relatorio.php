<?php

class Relatorio {

	public function dashboardMarcas($data_de, $data_ate, $periodo) {

		$between = " where data between '".$data_de."' AND '".$data_ate."'";
		if($periodo != "null") {
			$between = " where data between NOW() - INTERVAL ".$periodo." DAY AND NOW()";	
		}
		

		$sql = "SELECT empresas.razao as estaleiro, CONCAT('http://www.bombarco.com.br/catalogo/', empresas.slug) as link, COUNT(*) as visualizacoes";
		$sql .= " FROM zeromilhas_views_empresas";
		$sql .= " inner join empresas on zeromilhas_views_empresas.id_empresa = empresas.id";
		$sql .= $between;
		$sql .= " group by id_empresa";
		$sql .= " order by visualizacoes desc";
		$sql .= " limit 50";

		$relatorio_marcas = Yii::app()->db->createCommand($sql)->queryAll();
		
		return $relatorio_marcas;
	}

	public function dashboardModelos($data_de, $data_ate, $periodo) {

		$between = " where data between '".$data_de."' AND '".$data_ate."'";
		if($periodo != "null") {
			$between = " where data between NOW() - INTERVAL ".$periodo." DAY AND NOW()";	
		}

		$sql = "SELECT CONCAT(embarcacao_fabricantes.titulo, ' ', embarcacao_modelos.titulo) as modelo, CONCAT('http://www.bombarco.com.br/catalogo/', embarcacao_fabricantes.slug, '/', embarcacoes.slug) as link, COUNT(*) as visualizacoes";
		$sql .= " FROM zeromilhas_views_modelos";
		$sql .= " inner join embarcacoes on embarcacoes.id = zeromilhas_views_modelos.id_modelo";
		$sql .= " inner join embarcacao_modelos on embarcacao_modelos.id = embarcacoes.embarcacao_modelos_id";
		$sql .= " inner join embarcacao_fabricantes on embarcacao_fabricantes.id = embarcacao_modelos.embarcacao_fabricantes_id";
		$sql .= $between;
		$sql .= " group by id_modelo";
		$sql .= " order by visualizacoes desc";
		$sql .= " limit 100";

		$relatorio_modelos = Yii::app()->db->createCommand($sql)->queryAll();
		
		return $relatorio_modelos;

	}

	public function dashboardMeusModelos($data_de, $data_ate, $periodo) {

		$between = " where zeromilhas_views_modelos.data between '".$data_de."' AND '".$data_ate."'";
		if($periodo != "null") {
			$between = " where zeromilhas_views_modelos.data between NOW() - INTERVAL ".$periodo." DAY AND NOW()";	
		}

		$sql = "SELECT CONCAT(embarcacao_fabricantes.titulo, ' ', embarcacao_modelos.titulo) as modelo, CONCAT('http://www.bombarco.com.br/catalogo/', embarcacao_fabricantes.slug, '/', embarcacoes.slug) as link, COUNT(*) as visualizacoes";
		$sql .= " FROM zeromilhas_views_modelos ";
		$sql .= " inner join embarcacoes on embarcacoes.id = zeromilhas_views_modelos.id_modelo";
		$sql .= " inner join embarcacao_modelos on embarcacao_modelos.id = embarcacoes.embarcacao_modelos_id";
		$sql .= " inner join embarcacao_fabricantes on embarcacao_fabricantes.id = embarcacao_modelos.embarcacao_fabricantes_id";
		$sql .= " inner join usuarios_embarcacoes on usuarios_embarcacoes.embarcacoes_id = embarcacoes.id";
		$sql .= " inner join usuarios on usuarios.id = usuarios_embarcacoes.usuarios_id";
		$sql .= $between;
		$sql .= " and usuarios.id = ".Yii::app()->user->id;
		$sql .= " group by id_modelo";
		$sql .= " order by visualizacoes desc;";

		$relatorio_modelos = Yii::app()->db->createCommand($sql)->queryAll();

		return $relatorio_modelos;
	}

	public function perguntasClassificados($data_de, $data_ate) {

		    $sql = "SELECT DISTINCT email_rem from contatos where tipo = 'X'";
		    $sql .= " AND data between '".$data_de."' AND '".$data_ate."'";
			$sql .= " ORDER by email_rem asc";

            $emails = Yii::app()->db->createCommand($sql)->queryAll();

            return $emails;
	}


	public function relatorioGeralDeEmails($data_de, $data_ate) {

		$tipo_classificado = Anuncio::$_tipo_contato["EMBARCACAO_CLASSIFICADO"];
		$tipo_catalogo = Anuncio::$_tipo_contato["EMBARCACAO_CATALOGO"];
		$tipo_guia = Anuncio::$_tipo_contato["GUIA_DE_EMPRESAS"];
		$tipo_estaleiro = Anuncio::$_tipo_contato["ESTALEIRO"];
		$tipo_contato = Anuncio::$_tipo_contato["CONTATO"];

		// array final que tera todos os emails
		$emails = array();

		/* perguntas de classificado */
		$sql_classificados = "SELECT DISTINCT email_rem as email from contatos where tipo = '".$tipo_classificado."'";
		$sql_classificados .= " AND data between '".$data_de."' AND '".$data_ate."'";
		$sql_classificados .= " ORDER by email_rem asc";
		$sql_classificados .= " LIMIT 10000;";
		$emails_classificado = Yii::app()->db->createCommand($sql_classificados)->queryAll();

		foreach($emails_classificado as $e) {
			$emails[] = $e["email"];
		}

		/* perguntas de catalogos */
		$sql_catalogos = "SELECT DISTINCT email_rem as email from contatos where tipo = '".$tipo_catalogo."'";
		$sql_catalogos .= " AND data between '".$data_de."' AND '".$data_ate."'";
		$sql_catalogos .= " ORDER by email_rem asc";
		$sql_catalogos .= " LIMIT 10000;";
		$emails_catalogos = Yii::app()->db->createCommand($sql_catalogos)->queryAll();

		foreach($emails_catalogos as $e) {
			$emails[] = $e["email"];
		}

		/* perguntas de empresas */
		$sql_empresas = "SELECT DISTINCT email_rem as email from contatos where tipo = '".$tipo_guia."'";
		$sql_empresas .= " AND data between '".$data_de."' AND '".$data_ate."'";
		$sql_empresas .= " ORDER by email_rem asc";
		$sql_empresas .= " LIMIT 10000;";
		$emails_empresas = Yii::app()->db->createCommand($sql_empresas)->queryAll();

		foreach($emails_empresas as $e) {
			$emails[] = $e["email"];
		}

		/* perguntas de estaleiros */
		$sql_estaleiros = "SELECT DISTINCT email_rem as email from contatos where tipo = '".$tipo_estaleiro."'";
		$sql_estaleiros .= " AND data between '".$data_de."' AND '".$data_ate."'";
		$sql_estaleiros .= " ORDER by email_rem asc";
		$sql_estaleiros .= " LIMIT 10000;";
		$emails_estaleiros = Yii::app()->db->createCommand($sql_estaleiros)->queryAll();

		foreach($emails_estaleiros as $e) {
			$emails[] = $e["email"];
		}

		/* perguntas de contato */
		$sql_contatos = "SELECT DISTINCT email_rem as email from contatos where tipo = '".$tipo_contato."'";
		$sql_contatos .= " AND data between '".$data_de."' AND '".$data_ate."'";
		$sql_contatos .= " ORDER by email_rem asc";
		$sql_contatos .= " LIMIT 10000;";
		$emails_contatos = Yii::app()->db->createCommand($sql_contatos)->queryAll();

		foreach($emails_contatos as $e) {
			$emails[] = $e["email"];
		}

		/* cadastro de usuarios */
		$sql_usuarios = "SELECT email from usuarios";
		$sql_usuarios .= " where dataregistro between '".$data_de."' AND '".$data_ate."'";
		$sql_usuarios .= " ORDER by email asc";
		$sql_usuarios .= " LIMIT 10000;";
		$email_usuarios = Yii::app()->db->createCommand($sql_usuarios)->queryAll();

		foreach($email_usuarios as $e) {
			$emails[] = $e["email"];
		}

		/* mailling */
		$sql_mailling = "SELECT email from maillings";
		$sql_mailling .= " where data between '".$data_de."' AND '".$data_ate."';";
		$email_mailling = Yii::app()->db->createCommand($sql_mailling)->queryAll();

		foreach($email_mailling as $e) {
			$emails[] = $e["email"];
		}

		// tirar possiveis emails repetidos dentro de $emails[]
		$emails_sem_repetidos = array_unique($emails);

		foreach($emails_sem_repetidos as $index => $e) {

			// validar se email eh valido
			if (!filter_var($e, FILTER_VALIDATE_EMAIL)) {
				unset($emails_sem_repetidos[$index]);
			}
		}

		sort($emails_sem_repetidos);

		return $emails_sem_repetidos;

	}


	public function relatorioDeBanner($id, $de, $ate) {

		$de = Utils::formatDateTimeToDb($de);
		$ate = Utils::formatDateTimeToDb($ate);

		// views
		$sql = "SELECT COUNT(id) as total_views";
		$sql .= " FROM banners_views";
		$sql .= " WHERE banners_id = ".$id;
		$sql .= " AND data";
		$sql .= " BETWEEN  '".$de."'";
		$sql .= " AND  '".$ate."'";

		$views = Yii::app()->db->createCommand($sql)->queryAll();

		// clicks
		$sql = "SELECT COUNT(id) as total_clicks";
		$sql .= " FROM banners_clicks";
		$sql .= " WHERE banners_id = ".$id;
		$sql .= " AND data";
		$sql .= " BETWEEN  '".$de."'";
		$sql .= " AND  '".$ate."'";

		$clicks = Yii::app()->db->createCommand($sql)->queryAll();

		$resultado = array();

		$resultado["views"] = $views[0]["total_views"];
		$resultado["clicks"] = $clicks[0]["total_clicks"];

		return $resultado;
	}


	public function array_to_csv_download($array, $filename = "export.csv", $delimiter=";") {

	    // open raw memory as file so no temp files needed, you might run out of memory though
	    $f = fopen('php://memory', 'w'); 


	    fputcsv($f, $array, "\n"); 
	    
	    // reset the file pointer to the start of the file
	    fseek($f, 0);
	    // tell the browser it's going to be a csv file
	    header('Content-Type: application/csv');
	    // tell the browser we want to save it instead of displaying it
	    header('Content-Disposition: attachment; filename="'.$filename.'";');


	    // make php send the generated csv lines to the browser
	    fpassthru($f);

	}

	public function array_to_csv_download_rank_marcas($array, $filename, $data_de, $data_ate) {

		header('Content-Encoding: UTF-8');
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header('Content-Disposition: attachment; filename="'.$filename.'";');
		header("Pragma: no-cache");
		header("Expires: 0");

		// open raw memory as file so no temp files needed, you might run out of memory though
	    $f = fopen('php://memory', 'w'); 

		if($data_de != "null") {
			$de = explode(" ", Utils::formatDateTimeToView($data_de))[0];
	    	$ate = explode(" ", Utils::formatDateTimeToView($data_ate))[0];
	    	fputcsv($f, array("Ranking das marcas mais buscadas no ".utf8_decode('catálogo')." entre ".$de." ".utf8_decode('até')." ".$ate), ";");
		}
		else {
			fputcsv($f, array("Ranking das marcas mais buscadas no ".utf8_decode('catálogo')), ";");	
		}
	    fputcsv($f, array(), "\n", ";");
	    fputcsv($f, array("Marcas", "Link", utf8_decode("Visualizações")), ";"); 
	    fputcsv($f, array(), "\n", ";"); 

	    foreach ($array as $file) {
		    $result = [];
		    array_walk_recursive($file, function($item) use (&$result) {
		        $result[] = utf8_decode($item);
		    });
		    fputcsv($f, $result, ";");
		}

	    fseek($f, 0);
	    fpassthru($f);
		
	}

	public function array_to_csv_download_rank_modelos($array, $filename, $data_de, $data_ate) {

		header('Content-Encoding: UTF-8');
		header("Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet");
		header('Content-Disposition: attachment; filename="'.$filename.'";');
		header("Pragma: no-cache");
		header("Expires: 0");

		// open raw memory as file so no temp files needed, you might run out of memory though
	    $f = fopen('php://memory', 'w'); 

	    if($data_de != "null") {

	    	$de = explode(" ", Utils::formatDateTimeToView($data_de))[0];
		    $ate = explode(" ", Utils::formatDateTimeToView($data_ate))[0];

		    fputcsv($f, array("Ranking dos modelos mais buscados no ".utf8_decode('catálogo')." entre ".$de." ".utf8_decode('até')." ".$ate), ";"); 
	    }
	    else {

	    	fputcsv($f, array("Ranking dos modelos mais buscados no ".utf8_decode('catálogo')), ";"); 
	    }
	    fputcsv($f, array(), "\n", ";");
	    fputcsv($f, array("Modelos", "Link", utf8_decode("Visualizações")), ";"); 
	    fputcsv($f, array(), "\n", ";"); 

	    foreach ($array as $file) {
		    $result = [];
		    array_walk_recursive($file, function($item) use (&$result) {
		        $result[] = utf8_decode($item);
		    });
		    fputcsv($f, $result, ";");
		}

	    fseek($f, 0);
	    fpassthru($f);
		
	}

	public function array_to_csv_download_rank_meus_modelos($array, $filename, $data_de, $data_ate) {

		header('Content-Encoding: UTF-8');
		header("Content-type: text/csv; charset=UTF-8");
		header('Content-Disposition: attachment; filename="'.$filename.'";');
		header("Pragma: no-cache");
		header("Expires: 0");

		// open raw memory as file so no temp files needed, you might run out of memory though
	    $f = fopen('php://memory', 'w'); 

	    if($data_de != "null") {
	    	$de = explode(" ", Utils::formatDateTimeToView($data_de))[0];
	    	$ate = explode(" ", Utils::formatDateTimeToView($data_ate))[0];
	    	fputcsv($f, array(utf8_decode("Relatório")." dos meus modelos no ".utf8_decode('catálogo')." entre ".$de." ".utf8_decode('até')." ".$ate), ";"); 	
	    }
	    else {
	    	fputcsv($f, array(utf8_decode("Relatório")." dos meus modelos no ".utf8_decode('catálogo')), ";"); 
	    }

	    fputcsv($f, array(), "\n", ";");
	    fputcsv($f, array("Modelos", "Link", utf8_decode("Visualizações")), ";"); 
	    fputcsv($f, array(), "\n", ";"); 

	    foreach ($array as $file) {
		    $result = [];
		    array_walk_recursive($file, function($item) use (&$result) {
		        $result[] = utf8_decode($item);
		    });
		    fputcsv($f, $result, ";");
		}

	    fseek($f, 0);
	    fpassthru($f);
		
	}

}

?>