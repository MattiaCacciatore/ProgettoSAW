<?php
	require dirname(__FILE__).'/../../configuration/check_authorization.php';

	if(!isset($_SESSION['authentication']) && isset($_POST['submit']) && isset($_POST['email']) && isset($_POST['pass'])){

		$query       = 'SELECT * 
						FROM user 
						WHERE user.email = ?;';
			
		$params      = array(trim($_POST['email']));

		$param_types = 's';
		/* Since user.email is primary key, the expected result is 0 or 1 row. */
		$res;
				
		require dirname(__FILE__).'/../../configuration/database_connect.php';
		require dirname(__FILE__).'/../../configuration/database_query.php';
		require dirname(__FILE__).'/../../configuration/database_disconnect.php';

		if(!(empty($res))){

			if($res[0]['is_banned'] == 1)
				exit('Sei stato permabannato. Se pensi che ci sia stato un errore perfavore contatta l\'amministratore.');

			if(password_verify(trim($_POST['pass']), $res[0]['pwd'])){

				$_SESSION['name']           = $res[0]['firstname'];
				$_SESSION['surname']        = $res[0]['lastname'];
				$_SESSION['email']          = $res[0]['email'];
				$_SESSION['authentication'] = 1;
				/*  Boolean values aren't reliable in PHP. */
				if($res[0]['is_admin'] == 1)
					$_SESSION['admin'] = 1;
				else
					$_SESSION['admin'] = 0;

				require dirname(__FILE__).'/../../configuration/setcookies.php';
			}
			else
				exit('Credenziali sbagliate. Per tornare alla pagina principale segui il collegamento: <a href = \'../../index.php\'>Homepage</a>.');
		}
		else
			exit('Utente non registrato. Per tornare alla pagina principale segui il collegamento: <a href = \'../../index.php\'>Homepage</a>.');
	}
	else
		exit('Credenziali vuote. Per tornare alla pagina principale segui il collegamento: <a href = \'../../index.php\'>Homepage</a>.');

	header('Location: ../../index.php');
?>