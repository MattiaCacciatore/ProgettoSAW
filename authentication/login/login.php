<?php
	require dirname(__FILE__).'/../../configuration/check_authorization.php';

	if(!isset($_SESSION['authentication']) && isset($_POST['submit'])){

		$email    = $_POST['email'];
		$password = $_POST['pass'];

		if(!empty($email) && !empty($password)){

			$query       = 'SELECT * FROM user WHERE user.email = ?;';
			
			$params      = array($email);
			/* 's' significa che il parametro è di tipo stringa. */
			$param_types = 's';
			/* Dato che user.email è chiave primaria, il risultato si suppone avere 0 o 1 riga.
			  $res registra il risultato della interrogazione al database. */
			$res;
				
			require dirname(__FILE__).'/../../configuration/database_connect.php';
			require dirname(__FILE__).'/../../configuration/database_query.php';
			require dirname(__FILE__).'/../../configuration/database_disconnect.php';

			if(!(empty($res))){
				/* L'utente è presente nel database. */
				$user_email     = $res[0]['email'];
				$user_name      = $res[0]['firstname'];
				$user_lastname  = $res[0]['lastname'];
				$user_pwd       = $res[0]['pwd'];
				$user_is_admin  = $res[0]['is_admin'];
				$user_is_banned = $res[0]['is_banned'];

				if($user_is_banned == 1)
					exit('Sei stato permabannato. Se pensi che ci sia stato un errore perfavore contatta l\'amministratore.');

				if(password_verify($password, $user_pwd)){
					/* Si impostano le variabili di sessione. */
					$_SESSION['name']           = $user_name;
					$_SESSION['surname']        = $user_lastname;
					$_SESSION['email']          = $user_email;
					$_SESSION['authentication'] = 'true';
					/* 
					   Il valore di un booleano TRUE viene convertito nella stringa '1', un booleano FALSE
					   nella stringa vuota. Questo permette la conversione implicita tra valori booleani e
					   stringhe, percui i valori booleani non sono affidabili in PHP.
					*/
					if($user_is_admin == 1)
						$_SESSION['admin'] = 'true';
					else
						$_SESSION['admin'] = 'false';
					/* Si impostano i cookies. */
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
	}
	else
		exit('Credenziali vuote. Per tornare alla pagina principale segui il collegamento: <a href = \'../../index.php\'>Homepage</a>.');
    /* Reindirizzamento alla pagina iniziale. */
	header('Location: ../../index.php');
?>