<?php 
	/* Solo gli utenti autorizzati possono vedere i corsi. */
	require dirname(__FILE__).'/../configuration/check_session.php'; 
?>

<!DOCTYPE html>
<html lang = 'it'>

<head>

	<?php 
		include dirname(__FILE__).'/../modules/head_style.php'; 
	?>

	<link rel = 'stylesheet' href = '../modules/css/form.css'>

</head>

<body>

	<?php
		/* Nota: header include navbar. */
		require dirname(__FILE__).'/../modules/header.php';
	?>
	<h2 class = "page-title">Aggiorna il tuo profilo</h2>

	<!-- Corpo della pagina. -->
	<main>
		
		<?php
			/* Si aggiornano le credenziali dell'attuale utente. */
			if(isset($_POST['submit'])){
				$query = 'UPDATE user SET user.email = ?, user.firstname = ?, user.lastname = ? WHERE user.email = ?;';
				/* Nota: $user_email è già controllata in login.php. */
				$params = array($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_SESSION['email']);
				/* 'ssss' significa che tutti i parametri sono di tipo stringa. */
				$param_types = 'ssss';

				$res;

				require dirname(__FILE__).'/../configuration/database_connect.php';
				require dirname(__FILE__).'/../configuration/database_query.php';
				require dirname(__FILE__).'/../configuration/database_disconnect.php';

				/* Se tutto è andato bene (es. nessun email duplicata) allora le variabili di sessione vengono aggiornate. */
				$_SESSION['name']    = $_POST['firstname'];
				$_SESSION['surname'] = $_POST['lastname'];
				$_SESSION['email']   = $_POST['email'];
				
				/* Redireziona alla pagina iniziale. */
				header('Location: ../index.php');
			}
			else{

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