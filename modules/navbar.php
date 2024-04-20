<?php
	require dirname(__FILE__).'/ProgettoSAW/configuration/check_authorization.php';
	
	print(
	'
	<nav>
	'
	);

	if(isset($_SESSION['admin']) && $_SESSION['admin'] === 'true'){
		print(
			'
			<a href = \'../admin_area/show_users.php\'>Utenti</a> |
			'
		);
	}

	if(isset($_SESSION['authentication'])){
		print(
			'
			<a href = \'../user_area/update_profile.php\'>Modifica profilo</a> |
			<a href = \'../authentication/logout/logout.php\'>Logout</a> |
			'
		);
	}
	else{
		print(
			'
			<a href = \'../authentication/pages/registration_form.php\'>Registrati</a> |
			<a href = \'../authentication/pages/login_form.php\'>Accedi</a> |
			'
		);
	}
	
	print(
	'
		<a href = \'#\'>Servizi</a> |
		<a href = \'#\'>Lavora con noi</a> |
		<a href = \'#\'>Contatti</a>
	</nav>
	'
	);
?>