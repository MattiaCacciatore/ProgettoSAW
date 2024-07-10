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
	<link rel="stylesheet" href="../modules/css/form.css">
	<link rel="stylesheet" href="./css/upload-course.css">

</head>

<body>

	<?php
		/* Nota: header include navbar. */
		require dirname(__FILE__).'/../modules/header.php';
	?>

	<!-- Corpo della pagina. -->
	<main>

		<?php

			if(isset($_POST['video']) && isset($_POST['name_course']) && isset($_POST['description']) && isset($_POST['price'])){
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//              PRIMA INTERROGAZIONE, controlla se il corso esiste.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
				$query = 'SELECT c.name 
				          FROM course c JOIN teach t 
				          WHERE t.email_user = ? AND c.name = ?;';

				$course_title = $_POST['name_course'];

				$params = array($_SESSION['email'], $course_title);
				/* 'ss' significa che i parametri sono di tipo stringa. */
				$param_types = 'ss';

				$res;

				require dirname(__FILE__).'/../configuration/database_connect.php';
				require dirname(__FILE__).'/../configuration/database_query.php';
				/* Se il corso non esiste... */
				if(empty($res)){
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//                  SECONDA INTERROGAZIONE, inserisce il corso.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
					$query = 'INSERT INTO course (name, description, duration, price, average_evaluation) 
						      VALUES (?, ?, 0, ?, 0);';

					$course_description = $_POST['description'];
					$course_price       = floatval($_POST['price']);

					$db_connection;

					$params = array($course_title, $course_description, $course_price);
					/* 'ssd' significa che i primi due parametri sono di tipo stringa e l'ultimo di tipo float. */
					$param_types = 'ssd';

					require dirname(__FILE__).'/../configuration/database_query.php';
					/* Ottiene l'ultimo ID autoincrementale (chiave primaria) della precedente interrogazione. */
					$id_course = mysqli_insert_id($db_connection);

					if($id_course !== 0){
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//                  	TERZA INTERROGAZIONE, inserisce il video relativo al corso.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
						$query = 'INSERT INTO video (title, duration, type, filename, id_course) 
								  VALUES (?, 10, "url", ?, ?);';

						$file_id   = $_POST['video'];

						$params = array($course_title, $file_id, $id_course);
						/* 'ssi' significa che i primi due parametri sono di tipo stringa e l'ultimo di tipo intero. */
						$param_types = 'ssi';

						require dirname(__FILE__).'/../configuration/database_query.php';
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//                  	QUARTA INTERROGAZIONE, inserisce l'utente come docente.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
						$query = 'INSERT INTO teach (email_user, id_course) 
								  VALUES (?, ?);';

						$params = array($_SESSION['email'], $id_course);

						$param_types = 'si';

						require dirname(__FILE__).'/../configuration/database_query.php';

						print('<br><br>Corso caricato!<br>');
					}

					require dirname(__FILE__).'/../configuration/database_disconnect.php';
				}
			}

			else{
				print('
					<section>
						<h1 class="page-title">Crea il tuo prossimo corso!</h1>
						<br><br>

						<p class="avviso">Per inizializzare il corso, il modulo sottostante richiede l\'invio di un solo video.
						 Al momento, il modulo per caricare ulteriori video è in fase di sviluppo.
						Vi preghiamo di pazientare e di caricare un solo video per ora.</p>
						<br><br>
						<form action = \'upload_course.php\' method = \'post\'>
							<label for = \'video\'> Inserisci il codice ID del video su Youtube: </label>
								 <input type = \'text\' name = \'video\'/>
							<br><br>

							<label for = \'name_course\'>Titolo del corso:</label>
      						<input type = \'text\' id = \'name_course\' name = \'name_course\' required>
							<br><br>
				
							<label for = \'description\'>Descrizione del corso (massimo 1500 caratteri):</label>
      						<input type = \'text\' id = \'description\' name = \'description\' required>
							<br><br>

							<label for = \'price\'>Prezzo del corso (Euro):</label>
      						<input type = \'number\' id = \'price\' name = \'price\' min = \'0\' max = \'10000\' required>
							<br><br>

							<input type = \'submit\' value = \'Invia\' />
						</form>
					<section>
				');
			}
		?>
		
	</main>

	<?php 
		require dirname(__FILE__).'/../modules/footer.php'; 
	?>

</body>
</html>
