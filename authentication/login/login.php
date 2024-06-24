<?php
	require dirname(__FILE__).'/../../configuration/check_authorization.php';

	if(!isset($_SESSION['authentication']) && isset($_POST['submit'])){

		$email    = $_POST['email'];
		$password = $_POST['pass'];

		if(!empty($email) && !empty($password)){

			$query       = 'SELECT * FROM user WHERE user.email = ?;';
			$params      = array($email);
			/* 's' means that the param is bounded as a string. */
			$param_types = 's';
			/* Since user.email is the primary key the result is supposed to be 0 or 1 row.
			$res stores the result of the query called in database_query.php */
			$res;
				
			require dirname(__FILE__).'/../../configuration/database_connect.php';
			require dirname(__FILE__).'/../../configuration/database_query.php';
			require dirname(__FILE__).'/../../configuration/database_disconnect.php';

			if(!(empty($res))){
				/* The user exists in the database. */
				$user_email     = $res[0]['email'];
				$user_name      = $res[0]['firstname'];
				$user_lastname  = $res[0]['lastname'];
				$user_pwd       = $res[0]['pwd'];
				$user_is_admin  = $res[0]['is_admin'];
				$user_is_banned = $res[0]['is_banned'];

				if($user_is_banned == 1)
					exit('Sei stato permabannato. Se pensi che ci sia stato un errore perfavore contatta l\'amministratore.');

				if(password_verify($password, $user_pwd)){
					/* Setting session variables. */
					$_SESSION['name']           = $user_name;
					$_SESSION['surname']        = $user_lastname;
					$_SESSION['email']          = $user_email;
					$_SESSION['authentication'] = 'true';
					/* 
						A boolean TRUE value is converted to the string '1'. Boolean FALSE is converted 
						to '' (the empty string). This allows conversion back and forth between boolean 
						and string values. Therefore boolean values are NOT reliable in PHP.
					*/
					if($user_is_admin == 1)
						$_SESSION['admin'] = 'true';
					else
						$_SESSION['admin'] = 'false';
					/* Setting cookie variables. */
					require dirname(__FILE__).'/../../configuration/setcookies.php';
				}
			}
		}
		else
			exit('Credenziali sbagliate.');
	}
	else
		exit('Credenziali vuote.');
    /* Redirect to the homepage. */
	header('Location: ../../index.php');
?>