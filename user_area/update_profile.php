<?php 
	/* Only authorized users can update their profiles. */
	require dirname(__FILE__).'/../configuration/check_session.php'; 
?>

<!DOCTYPE html>
<html lang = 'it'>

<head>

	<?php 
		include dirname(__FILE__).'/../modules/head_style.php'; 
	?>

	<link rel = 'stylesheet' href = './css/update-profile.css'>

</head>

<body>

	<?php
		/* Note: header include navbar. */
		require dirname(__FILE__).'/../modules/header.php';
	?>

	<!-- Corpo della pagina. -->
	<main>

		<?php
			/* Let's update the current user credentials (email, name and surname). */
			if(isset($_POST['submit'])){
				$query = 'UPDATE user SET user.email = ?, user.firstname = ?, user.lastname = ? WHERE user.email = ?;';
				/* Note: $user_email is already checked in login.php. */
				$params = array($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_SESSION['email']);
				/* 'ssss' means that all params are bounded as strings. */
				$param_types = 'ssss';

				$res;

				require dirname(__FILE__).'/../configuration/database_connect.php';
				require dirname(__FILE__).'/../configuration/database_query.php';
				require dirname(__FILE__).'/../configuration/database_disconnect.php';

				/* If everything went well (e.g. there was no email duplicate) the session variables will be updated. */
				$_SESSION['name']    = $_POST['firstname'];
				$_SESSION['surname'] = $_POST['lastname'];
				$_SESSION['email']   = $_POST['email'];
				
				/* Redirect to the homepage. */
				header('Location: ../index.php');
			}
			else{
				/* Nel modulo di modifica del profilo i campi dovranno essere precompilati rispetto a quanto già presente nel database. */
				print('
				<form form action = \'update_profile.php\' method = \'post\'>

				<label for = \'firstname\'>Nuovo nome:</label><br>
				<input type = \'text\' id = \'firstname\' name = \'firstname\' placeholder = \''.$_SESSION['name'].'\' required><br>
		
				<label for = \'lastname\'>Nuovo cognome:</label><br>
				<input type = \'text\' id = \'lastname\' name = \'lastname\'  placeholder = \''.$_SESSION['surname'].'\' required><br>
		
				<label for = \'email\'>Nuovo indirizzo email:</label><br>
				<input type = \'email\' id = \'email\' name = \'email\' placeholder = \''.$_SESSION['email'].'\' required><br>
		
				<input type = \'submit\' name = \'submit\' value = \'Aggiorna\'>
		
				</form>
				');
			}
		?>
	</main>

	<?php 
		require dirname(__FILE__).'/../modules/footer.php'; 
	?>

</body>
</html>