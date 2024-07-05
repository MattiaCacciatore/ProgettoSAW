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

			if(isset($_POST['video']) && isset($_POST['name_course']) && isset($_POST['description']) && isset($_POST['price'])){
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//              FIRST QUERY, check if the course exists.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
				$query = 'SELECT c.name 
				          FROM course c JOIN teach t 
				          WHERE t.email_user = ? AND c.name = ?;';

				$course_title = $_POST['name_course'];

				$params = array($_SESSION['email'], $course_title);
				/* 'ss' means that the param is bounded as a string. */
				$param_types = 'ss';

				$res;

				require dirname(__FILE__).'/../configuration/database_connect.php';
				require dirname(__FILE__).'/../configuration/database_query.php';
				/* If the course doesn't exist... */
				if(empty($res)){
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//                  SECOND QUERY, the insertion of the course.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
					$query = 'INSERT INTO course (name, description, duration, price, average_evaluation) 
						      VALUES (?, ?, 0, ?, 0);';

					$course_description = $_POST['description'];
					$course_price       = floatval($_POST['price']);

					$db_connection;

					$params = array($course_title, $course_description, $course_price);
					/* 'ssd' means that the first two params are bounded as strings and the last one as float. */
					$param_types = 'ssd';

					require dirname(__FILE__).'/../configuration/database_query.php';
					/* Get the last auto-increment ID (primary key) from the previous query. */
					$id_course = mysqli_insert_id($db_connection);

					if($id_course !== 0){
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//                  	THIRD QUERY, the insertion of the video related to this course.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
						$query = 'INSERT INTO video (title, duration, type, filename, id_course) 
								  VALUES (?, 10, \'url\', ?, ?);';

						$file_id = $_POST['video'];

						$params = array($file_name, $file_id, $id_course);
						/* 'ssi' means that the first three params are bounded as strings and the last one as an integer. */
						$param_types = 'ssi';

						require dirname(__FILE__).'/../configuration/database_query.php';
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
//                  	FOURTH QUERY, the insertion of the teacher.
/* ------------------------------------------------------------------------------------------------------------------------------------------ */
						$query = 'INSERT INTO teach (email_user, id_course) 
								  VALUES (?, ?);';

						$params = array($_SESSION['email'], $id_course);

						$param_types = 'si';

						require dirname(__FILE__).'/../configuration/database_query.php';
					}

					require dirname(__FILE__).'/../configuration/database_disconnect.php';
				}
			}

			else{
				print('
					<section>
						<h2>Carica qui i video del tuo corso</h2>
						<br><br>
						<p>Attenzione che ogni corso può avere al massimo UN video.</p>
						<br><br>
						<form action = \'upload_course.php\' method = \'post\'>
							Inserisci il codice ID del video su Youtube: <input type = \'text\' name = \'video\'/>
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
