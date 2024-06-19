<!DOCTYPE html>
<html lang = 'it'>

<head>

	<?php 
		include dirname(__FILE__).'/../../modules/head_style.php'; 
	?>

	<link rel = 'stylesheet' href = './css/show_profile.css'>

    <title>

        <?php
            /* Placeholder. */
			print('');
		?>

    </title>

</head>
    

<body>
    
	<?php
		require dirname(__FILE__).'/../modules/header.php';
	?>

	<!-- Corpo della pagina. -->
	<main>

		<?php
			if(isset($_POST['submit'])){
				$query = 'SELECT * FROM course JOIN video ON course.id = video.id WHERE course.id = ?;';
				/* Note: $user_email is already checked in login.php. */
				$params = array($_POST['submit']);
				/* 'i' means that the param is bounded as an integer. */
				$param_types = 'i';
				/* $res stores the result of the query. */
				$res;

				require dirname(__FILE__).'/../../configuration/database_connect.php';
				require dirname(__FILE__).'/../../configuration/database_query.php';
				require dirname(__FILE__).'/../../configuration/database_disconnect.php';
				/* To be continued... */
				print('<br>Corso n. '.$res['id'].' : '.$res['name'].'<br><br>');
			}
			else{
				/* Placeholder. */
				print('Nessun corso selezionato!');
			}
		?>

	</main>

	<?php 
		require dirname(__FILE__).'/../modules/footer.php'; 
	?>
	
</body>
</html>