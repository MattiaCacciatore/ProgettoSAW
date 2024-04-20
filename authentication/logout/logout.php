<?php
	require '../../configuration/check_session.php';

	/* Unset cookies. */
	$cookie_name = 'user_remember';
	if(isset($_COOKIE[$cookie_name])){
		if(!setcookie($cookie_name, '', time() - 1)){
			die('Couldn\'t unset the cookie.');
		}

		$query       = 'UPDATE user SET user.id_cookie = NULL, user.expire = NULL WHERE user.email=?;';
		$params      = array($_SESSION['email']);
		$param_types = 's';
        /* $res stores the result of the query called in database_handler.php */
		$res;
		
		require '../../configuration/database_handler.php';
	}

	/* Unset all session variables. */
	$_SESSION = array();

	if(!session_destroy()){
		die('Couldn\'t close the user session.');
	}

	header('Location: ../../index.php');
?>