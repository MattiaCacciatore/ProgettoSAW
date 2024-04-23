<?php require dirname(__FILE__).'/../configuration/check_session.php'; ?>

<!DOCTYPE html>
<html lang = 'it'>
    
<?php include dirname(__FILE__).'/../modules/head_style.php'; ?>

<body>
	<?php
		require dirname(__FILE__).'/../modules/header.php';
		require dirname(__FILE__).'/../modules/navbar.php';
	?>

	<!-- Corpo della pagina. -->
	<main>
		<?php
			/* Non serve interrogare di nuovo il server, i dati dell'utente
			 sono salvati nell'array superglobale $SESSION di sessione. */
			print('
			<table>
				<tr>
					<th>Name</th>
					<th>Surname</th>
					<th>Email</th>
					<th>Admin</th>
				</tr>
				<tr>
					<th>'.$_SESSION['name'].'</th>
					<th>'.$_SESSION['surname'].'</th>
					<th>'.$_SESSION['email'].'</th>
					<th>'.$_SESSION['admin'].'</th>
				</tr>
			</table>');
		?>
	</main>

	<?php require dirname(__FILE__).'/../modules/footer.php'; ?>
</body>
</html>