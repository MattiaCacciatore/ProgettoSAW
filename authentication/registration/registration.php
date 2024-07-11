<?php
	require dirname(__FILE__).'/../../configuration/check_authorization.php';

	if(!isset($_SESSION['authentication']) && isset($_POST['submit'])){

		$name             = $_POST['firstname'];
		$surname          = $_POST['lastname'];
		$email            = $_POST['email'];
		$password         = $_POST['pass'];
		$confirm_password = $_POST['confirm'];

		if(!empty($name) && !empty($surname) && !empty($email) && !empty($password) && !empty($confirm_password)){
			
			if(strcmp($password,$confirm_password) === 0){
				/*
				pepper va configurato nel file config.conf del server.
				$pepper = getConfigVariable('pepper');
				$pwd_peppered = hash_hmac('sha256', $password, $pepper);
				$hashed_password = password_hash($pwd_peppered, PASSWORD_ARGON2ID);
				*/
				$hashed_password = password_hash($password, PASSWORD_DEFAULT);

				$query = 'INSERT INTO user(email, firstname, lastname, pwd) VALUES (?, ?, ?, ?);';

				$params = array($email, $name, $surname, $hashed_password);
				/* 'ssss' significa che i parametri sono di tipo stringa. */
				$param_types = 'ssss';

				$res;

				require dirname(__FILE__).'/../../configuration/database_connect.php';
				require dirname(__FILE__).'/../../configuration/database_query.php';
				require dirname(__FILE__).'/../../configuration/database_disconnect.php';
			}
			else{
				exit('Password diverse. Per tornare alla pagina principale segui il collegamento: <a href = \'../../index.php\'>Homepage</a>.');
			}
		}
		else{
			exit('Credenziali vuote. Per tornare alla pagina principale segui il collegamento: <a href = \'../../index.php\'>Homepage</a>.');
		}
	}
    /* Reindirizzamento alla pagina principale. */
	header('Location: ../../index.php');
?>