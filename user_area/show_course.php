<?php 
	require dirname(__FILE__).'/../configuration/check_session.php'; 
?>

<!DOCTYPE html>
<html lang = 'it'>

<head>

	<?php 
		include dirname(__FILE__).'/../modules/head_style.php';
	?>

	<link rel = 'stylesheet' href = './css/show-course.css'>
	<!--  Placeholder. -->
	<title>
		Corso
	</title>

</head>

<body>

	<?php
		require dirname(__FILE__).'/../modules/header.php';
	?>

	<main>
        
		<?php
		
			if(isset($_POST['courseId'])){

				require dirname(__FILE__).'/../configuration/database_connect.php';

				$query       = 'SELECT * 
				          		FROM follow 
						  		WHERE email_user = ? AND id_course = ?;';

				$params      = array($_SESSION['email'], $_POST['courseId']);

				$param_types = 'si';

				$res;

				require dirname(__FILE__).'/../configuration/database_query.php';

				if(empty($res[0])){
					/* If there was no such course... */
					$query = 'INSERT INTO follow (email_user, id_course) VALUES (?, ?);';

					require dirname(__FILE__).'/../configuration/database_query.php';
				}

				$query       = 'SELECT c.id, c.name, c.description, c.average_evaluation, v.title, v.filename
						        FROM course c JOIN video v ON c.id = v.id_course 
						        WHERE c.id = ?;';

				$params      = array($_POST['courseId']);
				
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