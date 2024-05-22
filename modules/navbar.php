<?php
	require dirname(__FILE__).'/../configuration/check_authorization.php';
	require dirname(__FILE__).'/set_path.php';
	
	print('
	<nav>
		<ul>
			<li class="nav-elmnt"><a href="'.$MYROOT.'/index.php">Homepage</a></li>
			<li class="nav-elmnt"><a href = '.$MYROOT.'/internal_search_system/page/search_system.php >Cerca i corsi</a></li> 
	');
	
	if(isset($_SESSION['admin']) && $_SESSION['admin'] === 'true'){
		print('
			<li class="nav-elmnt"><a href="'.$MYROOT.'/admin_area/show_users.php">Mostra utenti</a></li>
		');
	}
	
	if(isset($_SESSION['authentication'])){
		print('
			<li class="nav-elmnt"><a href = '.$MYROOT.'/course_evaluation/course_evaluation.html >Valuta il tuo corso</a></li>
			<li class="nav-elmnt"><a href = '.$MYROOT.'/user_area/show_profile.php >Mostra profilo</a></li>
			<li class="nav-elmnt"><a href = '.$MYROOT.'/user_area/update_profile.php >Modifica profilo</a></li>
			<li class="nav-elmnt"><a href = '.$MYROOT.'/authentication/logout/logout.php >Logout</a></li>
		');
	} else {
		print('
			<li class="nav-elmnt"><a href="'.$MYROOT.'/authentication/pages/registration_form.php">Registrati</a></li>
			<li class="nav-elmnt"><a href="'.$MYROOT.'/authentication/pages/login_form.php">Accedi</a></li>
		');
	}
		
	print('
			<li class="nav-elmnt"><a href="#">Servizi</a></li>
			<li class="nav-elmnt"><a href="#">Lavora con noi</a></li>
			<li class="nav-elmnt"><a href="#">Contatti</a></li>
		</ul>
	</nav>
	');