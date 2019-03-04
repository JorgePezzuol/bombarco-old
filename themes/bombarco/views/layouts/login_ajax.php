<?php
session_start();
	
	// login
	if(isset($_POST["rgm"])) {

		$rgm = $_POST["rgm"];
		$senha = $_POST["senha"];

		$login = false;

		try {
		  $pdo = new PDO('mysql:host=mysql.hostinger.com.br;dbname=u697057127_mamo', 'u697057127_root', 'blackmetal123');
		  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		  
		  $stmt = $pdo->prepare('SELECT tipo, rgm, id FROM usuarios WHERE rgm = :rgm AND senha = :senha');
		  $stmt->execute(array(
		    ':rgm' => $rgm,
		    ':senha' => $senha,
		  ));

		  $row = $stmt->fetch();
		  $tipo = $row["tipo"];

		  $pdo = null;

		  // criar variaveis de sessão
		  $_SESSION['rgm'] = $row["rgm"];
		  $_SESSION['id'] = $row["id"];

		  echo $tipo;		

		} catch(PDOException $e) {
		  echo 0;

		}
	}

	// logout
	else {

		session_destroy();

	}

?>