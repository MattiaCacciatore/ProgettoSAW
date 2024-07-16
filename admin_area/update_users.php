<?php

	require dirname(__FILE__).'/../configuration/check_session.php';
    require dirname(__FILE__).'/check_admin.php';
	
	if(isset($_POST['delete'])){
		$query = 'DELETE 
				  FROM user 
				  WHERE user.email = ?;';

		$params = array($_POST['delete']);
	}
	elseif(isset($_POST['ban']) || isset($_POST['unban'])){

		$query = 'UPDATE user 
				  SET user.is_banned = '.(isset(($_POST['ban'])) ? '1' : '0').'
				  WHERE user.email = ?;';

		$params = array(isset($_POST['ban']) ? $_POST['ban'] : $_POST['unban']);

	}
	elseif(isset($_POST['grant']) || isset($_POST['revoke'])){

		$query = 'UPDATE user 
				  SET user.is_admin = '.(isset(($_POST['grant'])) ? '1' : '0').'
				  WHERE user.email = ?;';

		$params = array(isset($_POST['grant']) ? $_POST['grant'] : $_POST['revoke']);

	}
	else{
		/* PLACEHOLDER. */
		$query = 'SELECT * 
				  FROM field';

		$params = null;
	}

	$param_types = 's';

	$res;
			
	require dirname(__FILE__).'/../configuration/database_connect.php';
	require dirname(__FILE__).'/../configuration/database_query.php';
	require dirname(__FILE__).'/../configuration/database_disconnect.php';

	header('Location: show_users.php');
?>
