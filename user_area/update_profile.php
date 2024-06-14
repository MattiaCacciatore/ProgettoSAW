<?php require dirname(__FILE__).'/../configuration/check_session.php'; ?>

<!DOCTYPE html>
<html lang = 'it'>
<head>
<?php include dirname(__FILE__).'/../modules/head_style.php'; ?>
<link rel="stylesheet" href="./css/upadte_profile.css">
</head>

<body>
	<?php
		require dirname(__FILE__).'/../modules/header.php';
	?>

	<!-- Corpo della pagina. -->
	<main>
		<?php
			/* Let's verify if the current user is */
			if(isset($_POST['submit'])){
				$query = 'UPDATE user SET user.email = ?, user.firstname = ?, user.lastname = ? WHERE user.email=?;';
				/* Note: $user_email is checked in login.php. */
				$params = array($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_SESSION['email']);
				/* 'sss' means that all 3 params are bounded as strings. */
				$param_types = 'ssss';
				/* $res stores the result of the query called in database_handler.php */
				$res;

				require dirname(__FILE__).'/../configuration/database_connect.php';
				require dirname(__FILE__).'/../configuration/database_query.php';
				require dirname(__FILE__).'/../configuration/database_disconnect.php';

				/* If everything went well the session variables will be updated. */
				$_SESSION['name']    = $_POST['firstname'];
				$_SESSION['surname'] = $_POST['lastname'];
				$_SESSION['email']   = $_POST['email'];
				
				/* Redirect to the homepage. */
				header('Location: ../index.php');
			}
			else{
				print('
				<form form action=\'update_profile.php\' method=\'post\'>

				<label for = \'firstname\'>Nuovo nome:</label><br>
				<input type = \'text\' id = \'firstname\' name = \'firstname\' required><br>
		
				<label for = \'lastname\'>Nuovo cognome:</label><br>
				<input type = \'text\' id = \'lastname\' name = \'lastname\' required><br>
		
				<label for = \'email\'>Nuovo indirizzo email:</label><br>
				<input type = \'email\' id = \'email\' name = \'email\' required><br>
		
				<input type = \'submit\' name = \'submit\' value = \'Aggiorna\'>
		
				</form>
				');
			}
		?>
	</main>

	<?php require dirname(__FILE__).'/../modules/footer.php'; ?>
</body>
</html>