<!DOCTYPE html>
<html lang = 'it'>

<head>

	<?php 
		include dirname(__FILE__).'/../../modules/head_style.php';
	?>

	<link rel = 'stylesheet' href = '../css/show-course.css'>
	<!--  Placeholder. -->
	<title>
		Corso
	</title>

</head>

<body>

	<?php
		/* Note: start_session in check_authorization.php */
		require dirname(__FILE__).'/../../modules/header.php';
	?>

	<main>
        
		<?php
			if(isset($_POST['courseId'])){
				$query = 'SELECT c.id, c.name, c.description, c.average_evaluation, v.title, v.type, v.file
						  FROM course c JOIN video v ON c.id = v.id_course 
						  WHERE c.id = ?;';

				$params = array($_POST['courseId']);
				/* 'i' means that the param is bounded as an integer. */
				$param_types = 'i';
				/* $res stores the result of the query. */
				$res;
				
				require dirname(__FILE__).'/../../configuration/database_connect.php';
				require dirname(__FILE__).'/../../configuration/database_query.php';
				require dirname(__FILE__).'/../../configuration/database_disconnect.php';

				if(!is_null($res)){
					print('	
						<div class = "course-section">
							<section class = "course-section">
								<h2>Corso: '.$res['name'].'</h2>
							</section>
							<br><br>
							<section class = "course-section">
								<h2>Video: '.$res['title'].'</h2>
								<video controls>
									<source src = "../../user_area/videos/'.$res['file'].'.'.$res['type'].'" type = "video/'.$res['type'].'">
								</video>
							</section>

							<section class = "course-section">
								<p>Descrizione: '.$res['description'].'</p>
								<br><br>
								<p>Valutazione media: '.$res['average_evaluation'].'</p>
							</section>
						</div>
					');
				}
				else{
					print('<p class = "course-section">Nessun corso selezionato!</p>');
				}
			}
			else{
				print('<p>Nessun corso selezionato!</p>');
			}
		?>

	</main>

	<?php
		require dirname(__FILE__).'/../../modules/footer.php'; 
	?>
	
</body>
</html>