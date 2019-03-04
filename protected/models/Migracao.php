<?php

	class Migracao {


		function migrarModelos($dbh, $tipo, $modelos_id, $categoria, $log) {

			if($tipo == "Iate") {

                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 2)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}
            }
            elseif($tipo == "Cruzeiro") {

                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 5)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}
            }
            elseif($tipo == "Pesca") {

                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 6)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}
            }
            elseif($tipo == "Inflável") {

                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 7)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}
            }
            elseif($tipo == "Semirrígido") {

                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 7)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}
            }
            elseif($tipo == "Regata") {
                
                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 5)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}
            }
            elseif($tipo == "Flexível") {
                
                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 7)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}
            }
            elseif($tipo == "Cabinada com Fly") {
                

                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 2)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}

                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 1)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}

            }
            elseif($tipo == "Polietileno") {
                
                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 6)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}

                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 4)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}
            }
            elseif($tipo == "Flexível") {
                
                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 7)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}
            }
            elseif($tipo == "Fibra") {
                
                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 6)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}
            }
            elseif($tipo == "Madeira") {
                
                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 6)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}
            }
            elseif($tipo == "Rígido") {
                
                $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 7)";
                $stmt = $dbh->prepare($sql);
                if($stmt->execute()) {
					var_dump("ok");
				}
				else {
					var_dump("erro modelos tipo - ".$log);
				}
            }
            else {

                if($categoria == "1") {

                    $sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", 17)";
                    $stmt = $dbh->prepare($sql);
                    if($stmt->execute()) {
						var_dump("ok");
					}
					else {
						var_dump("erro modelos tipo - ".$log);
					}
                }
                else {

                	$sql = "SELECT id from tipos where nome like '%".$tipo."%' LIMIT 1";
                    $consulta = $dbh->prepare($sql);
                    $consulta->execute();
                    $resultado = $consulta->fetchAll();

                    var_dump("</br>");
                    var_dump($sql);

                    if(count($resultado) > 0) {

	                   	foreach($resultado as $c) {
	                    	$tipos_id = $c["id"];
	                    }

                    }

                    else {
                    	// Outro ou Não Informado
                    	$tipos_id = 999;
                    }

                	$sql = "INSERT INTO modelos_tipos(modelos_id, tipos_id) VALUES(".$modelos_id.", ".$tipos_id.")";
                    $stmt = $dbh->prepare($sql);
                    if($stmt->execute()) {
						var_dump("ok");
					}
					else {
						var_dump("erro modelos tipo - ".$log);
					}

                }
            }
		} // migrar modelos

		public function migrarMarcas() {

			$sql = "select usuarios.email, empresas.razao, empresas.logo, empresas.destaque";
	        $sql .= " from usuarios";
	        $sql .= " inner join empresas on empresas.usuarios_id = usuarios.id";
	        $sql .= " and empresas.macros_id = 3";
	        $sql .= " and empresas.status = 2";
	        $lista = Yii::app()->db->createCommand($sql)->queryAll();

	        $dbh = new pdo('mysql:host=208.91.198.47;dbname=bombalau_zeromilhas',
	        'bombalau_user',
	        '#Bombarco2016',
	        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));

	        try {

	            foreach($lista as $item) {

	                $email = $item["email"];
	                $senha = md5("123mudar");

	                $sql = 'INSERT INTO usuarios (email, senha) VALUES ("'.$email.'", "'.$senha.'");';
	                $stmt = $dbh->prepare($sql);
	                if($stmt->execute()) {
						var_dump("ok");
					}
					else {
						var_dump("erro modelos tipo - ".$log);
					}

	                $id = $dbh->lastInsertId();

	                $nome = $item["razao"];
	                $logo = $item["logo"];
	                $destaque = $item["destaque"];

	                $sql2 = 'INSERT INTO marcas (nome, logo, destaque, id_usuario, status) VALUES ("'.$nome.'", "'.$logo.'", '.$destaque.', '.$id.', 1);';
	                $stmt2 = $dbh->prepare($sql2);
	                $stmt2->execute();
	                
	            }

	        } catch(Exception $ex) {
	            var_dump($sql2);
	            var_dump($ex->getMessage());
	        }
		}
	} // classe
?>