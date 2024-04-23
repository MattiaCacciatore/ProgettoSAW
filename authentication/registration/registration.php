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
				$param_types = 'ssss';
                /* $res stores the result of the query called in database_handler.php */
				$res;

				require dirname(__FILE__).'/../../configuration/database_connect.php';
				require dirname(__FILE__).'/../../configuration/database_query.php';
				require dirname(__FILE__).'/../../configuration/database_disconnect.php';
			}
			else{
				exit('Campi password diversi.');
			}
		}
		else{
			exit('Credenziali vuote.');
		}
	}
    /* Redirect to the homepage. */
	header('Location: ../../index.php');
?>