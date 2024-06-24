<?php
	require dirname(__FILE__).'/../../configuration/check_authorization.php';

	/* Unset cookies. */
	$cookie_name = 'user_remember';

	if(isset($_COOKIE[$cookie_name])){
		
		if(!setcookie($cookie_name, '', time() - 1)){
			die('HTTP 500 Internal Server Error');
		}

		$query       = 'UPDATE user SET user.id_cookie = NULL, user.expire = NULL WHERE user.email=?;';
		$params      = array($_SESSION['email']);
		/* 's' means that the param is bounded as a string. */
		$param_types = 's';
        /* $res stores the result of the query called in database_query.php */
		$res;
		
		require dirname(__FILE__).'/../../configuration/database_connect.php';
		require dirname(__FILE__).'/../../configuration/database_query.php';
		require dirname(__FILE__).'/../../configuration/database_disconnect.php';
	}

	/* Unset all session variables. */
	$_SESSION = array();

	if(!session_destroy()){
		die('HTTP 500 Internal Server Error');
	}

	header('Location: ../../index.php');
?>