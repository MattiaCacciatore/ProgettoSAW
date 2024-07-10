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

	<link rel = 'stylesheet' href = './css/show-course.css'>
	<!--  Segnaposto. -->
	<title>
		Corso
	</title>

</head>

<body>

	<?php
		/* Nota: start_session() viene chiamata in check_authorization.php */
		require dirname(__FILE__).'/../modules/header.php';
	?>

	<main>
        
		<?php
		
			if(isset($_POST['courseId'])){

				require dirname(__FILE__).'/../configuration/database_connect.php';
				/* Controlla se l'attuale corso è già seguito dall'attuale utente. */
				$query = 'SELECT * 
				          FROM follow 
						  WHERE email_user = ? AND id_course = ?;';

				$params = array($_SESSION['email'], $_POST['courseId']);
				/* 'si' significa che il primo parametro è di tipo stringa e il secondo è di tipo intero. */
				$param_types = 'si';
				/* $res registra il risultato dell'interrogazione al database. */
				$res;

				require dirname(__FILE__).'/../configuration/database_query.php';
				/* Se l'utente sta seguendo il corso per la prima volta... */
				if(empty($res[0])){
					/* ...e carica il corso appena seguito per l'attuale utente. */
					$query = 'INSERT INTO follow (email_user, id_course) VALUES (?, ?);';

					require dirname(__FILE__).'/../configuration/database_query.php';
				}
				/* Il limite dei video per ogni corso è, attualmente, uno. */
				$query = 'SELECT c.id, c.name, c.description, c.average_evaluation, v.title, v.filename
						  FROM course c JOIN video v ON c.id = v.id_course 
						  WHERE c.id = ?;';

				$params = array($_POST['courseId']);
				
				$param_types = 'i';
				
				require dirname(__FILE__).'/../configuration/database_query.php';
				require dirname(__FILE__).'/../configuration/database_disconnect.php';

				if(!is_null($res)){

					print('
						<div class = \'course-section\'>
						<section class = \'course-section\'>
							<h2>Corso: '.htmlspecialchars($res[0]['name']).'</h2>
						</section>
						<br><br>

						<section class = \'course-section\'>
							<h2>Video: '.htmlspecialchars($res[0]['title']).'</h2>
							<iframe src = \'https://www.youtube.com/embed/'.htmlspecialchars($res[0]['filename']).'\'>
							</iframe>
						</section>

						<section class = \'course-section\'>
							<p>Descrizione: '.htmlspecialchars($res[0]['description']).'</p>
							<br><br>
							<p>Valutazione media: '.$res[0]['average_evaluation'].'</p>
						</section>
					</div>
					');
				}
				else{
					print('
						<h2>Corso nuovo - Nessun video disponibile!</h2>
					');
				}
			}
			else{
				print('<p>Corso non trovato!</p>');
			}
		?>

	</main>

	<?php
		require dirname(__FILE__).'/../modules/footer.php'; 
	?>
	
</body>
</html>