<?php
require dirname(__FILE__).'/../configuration/check_authorization.php';
	
print('
<nav>
');

if(isset($_SESSION['admin']) && $_SESSION['admin'] === 'true'){
	print('
	<a href = \'/~S4850100/ProgettoSAW/admin_area/show_users.php\'>Utenti</a> |
	');
}

if(isset($_SESSION['authentication'])){
	print('
	<a href = \'/~S4850100/ProgettoSAW/user_area/update_profile.php\'>Modifica profilo</a> |
	<a href = \'/~S4850100/ProgettoSAW/authentication/logout/logout.php\'>Logout</a> |
	');
}
else{
	print('
	<a href = \'/~S4850100/ProgettoSAW/authentication/pages/registration_form.php\'>Registrati</a> |
	<a href = \'/~S4850100/ProgettoSAW/authentication/pages/login_form.php\'>Accedi</a> |
	');
}
	
print('
	<a href = \'#\'>Servizi</a> |
	<a href = \'#\'>Lavora con noi</a> |
	<a href = \'#\'>Contatti</a>
</nav>
');
?>
