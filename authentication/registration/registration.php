<?php
	require dirname(__FILE__).'/../../configuration/check_authorization.php';

	if(!isset($_SESSION['authentication']) && isset($_POST['submit']) && isset($_POST['firstname']) && isset($_POST['lastname'])
		&& isset($_POST['email']) && isset($_POST['pass']) && isset($_POST['confirm'])){
	
		if(strcmp(trim($_POST['pass']), trim($_POST['confirm'])) === 0){
			/*
			pepper must be set in config.conf servers's file.
			$pepper = getConfigVariable('pepper');
			$pwd_peppered = hash_hmac('sha256', $password, $pepper);
			$hashed_password = password_hash($pwd_peppered, PASSWORD_ARGON2ID);
			*/
			
			$query = 'INSERT INTO user(email, firstname, lastname, pwd) VALUES (?, ?, ?, ?);';

			$params = array($_POST['email'], $_POST['firstname'], $_POST['lastname'], password_hash($_POST['pass'], PASSWORD_DEFAULT));

			$param_types = 'ssss';

			$res;
			/* If POST params are incorrect then the query will fail. */
			require dirname(__FILE__).'/../../configuration/database_connect.php';
			require dirname(__FILE__).'/../../configuration/database_query.php';
			require dirname(__FILE__).'/../../configuration/database_disconnect.php';
		}
		else
			exit('Password diverse. Per tornare alla pagina principale segui il collegamento: <a href = \'../../index.php\'>Homepage</a>.');
	}
	else
		exit('Credenziali vuote. Per tornare alla pagina principale segui il collegamento: <a href = \'../../index.php\'>Homepage</a>.');

	header('Location: ../../index.php');
?>