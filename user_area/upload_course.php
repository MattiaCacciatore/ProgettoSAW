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

</head>

<body>

	<?php
		/* Note: header include navbar. */
		require dirname(__FILE__).'/../modules/header.php';
	?>

	<!-- Corpo della pagina. -->
	<main>

		<?php

			if(isset($_FILES['video']) && isset($_POST['name_course']) && isset($_POST['description']) && isset($_POST['price'])){

				exit('Unable to move \'/tmp/yourvideo\' to \'/videos/yourvideo.mp4\' because Permission denied.');

				$target_dir = 'videos/';
				/* videos/myvideo.mp4 */
				$target_file = $target_dir.basename($_FILES['video']['name']);
		
				/* Check if file was uploaded without errors. */
				if($_FILES['video']['error'] == 0){

					$allowed_ext = array('mp4' => 'video/mp4');

					$finfo = new finfo(FILEINFO_MIME_TYPE);
					/* Note: the $_FILES variable in PHP (except tmp_name) can be modified. */
					$file_name = basename($_FILES['video']['name'], '.mp4');
					$file_type = $finfo->file($_FILES['video']['tmp_name']);
					$file_size = filesize($_FILES['video']['tmp_name']);

					/* Verify MIME type of the video and its size. */
					if(in_array($file_type, $allowed_ext) && $file_size <= (1024*1024*100)){
						/* Check whether video exists before uploading it. */
						if(file_exists($target_file)){
							print('<div><p>Un video con quel titolo e formato esiste già. Cambia il nome del file video e riprova.</p></div>'); 
						}		 
						else{ 
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//                          FIRST QUERY, check if the course exists.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
							$query = 'SELECT c.name 
									  FROM course c JOIN teach t 
									  WHERE t.email_user = ? AND c.name = ?;';

							$params = array($_SESSION['email'], $_POST['name_course']);
							/* 's' means that the param is bounded as a string. */
							$param_types = 'ss';
				
							$res;

							require dirname(__FILE__).'/../configuration/database_connect.php';
							require dirname(__FILE__).'/../configuration/database_query.php';
							/* If the course doesn't exist... */
							if(empty($res)){
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//                          	SECOND QUERY, the insertion of the course.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
								/* All four queries are a single transaction. */
								$query = 'INSERT INTO course (name, description, duration, price, average_evaluation) 
										  VALUES (?, ?, 0, ?, 0);';

								$course_title       = $_POST['name_course'];
								$course_description = $_POST['description'];
								$course_price       = floatval($_POST['price']);

								$params = array($course_title, $course_description, $course_price);
								/* 'ssd' means that the first two params are bounded as strings and the last one as float. */
								$param_types = 'ssd';

								require dirname(__FILE__).'/../configuration/database_query.php';
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//                          	THIRD QUERY, the course's ID.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
								$query = 'SELECT c.id 
										  FROM course c 
										  WHERE c.name = ? AND c.description = ? AND c.price = ?;';

								$params = array($course_title, $course_description, $course_price);

								$param_types = 'ssd';

								require dirname(__FILE__).'/../configuration/database_query.php';

								$id_course = $res[0]['id'];
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//                          	FOURTH QUERY, the insertion of the video related to this course.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
								$query = 'INSERT INTO video (title, duration, type, filename, id_course) 
										  VALUES (?, 10, ?, ?, ?);';
								
								$params = array($file_name, $file_type, $_FILES['video']['name'], $id_course);
								/* 'sssi' means that the first three params are bounded as strings and the last one as an integer. */
								$param_types = 'sssi';
				
								require dirname(__FILE__).'/../configuration/database_query.php';
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//                          	FIFTH QUERY, the insertion of the teacher.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
								$query = 'INSERT INTO teach (email_user, id_course) 
										  VALUES (?, ?);';

								$params = array($_SESSION['email'], $id_course);

								$param_types = 'si';

								require dirname(__FILE__).'/../configuration/database_query.php';
								require dirname(__FILE__).'/../configuration/database_disconnect.php';

								if(move_uploaded_file($_FILES['video']['tmp_name'], $target_file)){
									print('<div><p>Il video e il corso sono stati caricati con successo! Visita il tuo profilo per vederli!</p></div>');
								} 
								else{
									die('Errore: Video non salvato!');
								}
							}
							else{
								require dirname(__FILE__).'/../configuration/database_disconnect.php';

								print('<div><p>Questo corso esiste gi&agrave;!</p></div>');
							}
 
						} 
					} 
					else{ 
						die('Errore: Formato video non valido.');
					} 
				} 
				else{ 
					die('Errore: Impossibile caricare il video: '.$_FILES['video']['error']);
				}
			}
			else{
				
				print('
					<section>
						<h2>Carica qui i video del tuo corso</h2>
						<br><br>
						<p>Attenzione che ogni corso può avere al massimo UN video che non deve superare i 100MB come peso e dev\'essere in formato mp4.</p>
						<br><br>
						<form enctype = \'multipart/form-data\' action = \'upload_course.php\' method = \'post\'>
							<input type = \'hidden\' name = \'MAX_FILE_SIZE\' value = \'104857600\' />
							Seleziona il video da caricare: <input type = \'file\' name = \'video\'/>
							<br><br>
							<label for = \'name_course\'>Titolo del corso:</label>
							<br>
      						<input type = \'text\' id = \'name_course\' name = \'name_course\' required>
							<br><br>
							<label for = \'description\'>Descrizione del corso (massimo 1500 caratteri):</label>
							<br>
      						<input type = \'text\' id = \'description\' name = \'description\' required>
							<br><br>
							<label for = \'price\'>Prezzo del corso (Euro):</label>
							<br>
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
