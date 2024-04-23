<?php
	require dirname(__FILE__).'/../configuration/check_session.php';
    require dirname(__FILE__).'/check_admin.php';
	
	if(isset($_POST['delete'])){
		$query = 'DELETE FROM user WHERE user.email=?;';
		$params = array($_POST['delete']);
	}
	elseif(isset($_POST['ban'])){
		$query = 'UPDATE user SET user.is_banned = 1 WHERE user.email=?;';
		$params = array($_POST['ban']);
	}
	elseif(isset($_POST['unban'])){
		$query = 'UPDATE user SET user.is_banned = 0 WHERE user.email=?;';
		$params = array($_POST['unban']);
	}
	elseif(isset($_POST['grant'])){
		$query = 'UPDATE user SET user.is_admin = 1 WHERE user.email=?;';
		$params = array($_POST['grant']);
	}
	else{
		/* Placeholer. */
		$query = 'SELECT * FROM field';
		$params = null;
	}
	/* 's' mean that the param is bounded as a string. */
	$param_types = 's';
	/* $res stores the result of the query called in database_handler.php */
	$res;
			
	require dirname(__FILE__).'/../configuration/database_connect.php';
	require dirname(__FILE__).'/../configuration/database_query.php';
	require dirname(__FILE__).'/../configuration/database_disconnect.php';

	header('Location: show_users.php');
?>
