<?php
	require dirname(__FILE__).'/ProgettoSAW/configuration/check_authorization.php';

	if(!isset($_SESSION['authentication']) && isset($_POST['submit'])){
		$email    = $_POST['email'];
		$password = $_POST['pass'];
		if(!empty($email) && !empty($password)){
			$query       = 'SELECT * FROM user WHERE user.email=?;';
			$params      = array($email);
			$param_types = 's';
			/* Since user.email is the primary key the result is supposed to be 0 or 1 row.
			   $res stores the result of the query called in database_handler.php */
			$res;
			
			require dirname(__FILE__).'/ProgettoSAW/configuration/database_handler.php';

			if(!(empty($res))){
				/* The user exists in the database. */
				$user_email    = $res[0];
				$user_name     = $res[1];
				$user_lastname = $res[2];
				$user_pwd      = $res[3];
				$user_is_admin = $res[4];

				if(password_verify($password, $user_pwd)){
					/* Setting session variables. */
					$_SESSION['name']           = $user_name;
					$_SESSION['surname']        = $user_lastname;
					$_SESSION['email']          = $user_email;
					$_SESSION['authentication'] = 'true';
					/* A boolean TRUE value is converted to the string '1'. Boolean FALSE is converted to '' (the empty string). 
					This allows conversion back and forth between boolean and string values. Therefore boolean values are NOT
					reliable. */
					if($user_is_admin == 1)
						$_SESSION['admin'] = 'true';
					else
						$_SESSION['admin'] = 'false';
					/* Setting cookie variables. */
					require dirname(__FILE__).'/ProgettoSAW/configuration/setcookies.php';
				}
			}
		}
		else
			exit('Wrong credentials.');
	}
	else
		exit('Empty credentials.');

    /* Redirect to the homepage. */
	header('Location: ../../index.php');
?>