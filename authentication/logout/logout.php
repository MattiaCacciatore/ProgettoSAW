<?php
	require dirname(__FILE__).'/../../configuration/check_authorization.php';

	/* Si puliscono/liberano i cookies. */
	$cookie_name = 'user_remember';

	if(isset($_COOKIE[$cookie_name])){
		
		if(!setcookie($cookie_name, '', time() - 1)){
			die('HTTP 500 Internal Server Error');
		}

		$query       = 'UPDATE user SET user.id_cookie = NULL, user.expire = NULL WHERE user.email=?;';
		$params      = array($_SESSION['email']);
		/* 's' significa che il parametro è di tipo stringa. */
		$param_types = 's';

		$res;
		
		require dirname(__FILE__).'/../../configuration/database_connect.php';
		require dirname(__FILE__).'/../../configuration/database_query.php';
		require dirname(__FILE__).'/../../configuration/database_disconnect.php';
	}

	/* Cancella la sessione. */
	$_SESSION = array();

	if(!session_destroy()){
		die('HTTP 500 Internal Server Error');
	}

	header('Location: ../../index.php');
?>