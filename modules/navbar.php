<?php
	require dirname(__FILE__).'/../configuration/check_authorization.php';
	require dirname(__FILE__).'/set_path.php';
	
	print('
	<nav>
	');
	
	if(isset($_SESSION['admin']) && $_SESSION['admin'] === 'true'){
		print('
		<a href ='.$MYROOT.'/admin_area/show_users.php > Mostra utenti</a> |
		');
	}
	
	if(isset($_SESSION['authentication'])){
		print('
		<a href = '.$MYROOT.'/course_evaluation/course_evaluation.html >Valuta il tuo corso</a> |
		<a href = '.$MYROOT.'/user_area/show_profile.php >Mostra profilo</a> |
		<a href = '.$MYROOT.'/user_area/update_profile.php >Modifica profilo</a> |
		<a href = '.$MYROOT.'/authentication/logout/logout.php >Logout</a> |
		');
	}
	else{
		print('
		<a href = '.$MYROOT.'/authentication/pages/registration_form.php >Registrati</a> |
		<a href = '.$MYROOT.'/authentication/pages/login_form.php >Accedi</a> |
		');
	}
		
	print('
		<a href = '.$MYROOT.'/index.php >Homepage</a> |
		<a href = '.$MYROOT.'/internal_search_system/page/search_system.php >Cerca i corsi</a> |
		<a href = \'#\'>Servizi</a> |
		<a href = \'#\'>Lavora con noi</a> |
		<a href = \'#\'>Contatti</a>
	</nav>
	');
?>
