<?php 
	/* Only authorized users can see courses. */
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
		/* Note: start_session in check_authorization.php */
		require dirname(__FILE__).'/../modules/header.php';
	?>

	<main>
        
		<?php
			if(isset($_POST['courseId'])){
				require dirname(__FILE__).'/../configuration/database_connect.php';
				/* Check if the current course is already followed by the current user. */
				$query = 'SELECT * FROM follow WHERE email_user = ? AND id_course = ?;';

				$params = array($_SESSION['email'], $_POST['courseId']);
				/* 'si' means that the first param is bounded as a string and the second one as an integer. */
				$param_types = 'si';
				/* $res stores the result of the query. */
				$res;

				require dirname(__FILE__).'/../configuration/database_query.php';

				if(is_null($res)){
					/* Upload the current followed course for this user. */
					$query = 'INSERT INTO follow (email_user, id_course) VALUES (?, ?);';

					require dirname(__FILE__).'/../configuration/database_query.php';
				}
				/* The limit of videos for each course is 5. */
				$query = 'SELECT c.id, c.name, c.description, c.average_evaluation, v.title, v.type, v.file
						  FROM course c JOIN video v ON c.id = v.id_course 
						  WHERE c.id = ?;';
						  //ORDER BY c.average_evaluation DESC LIMIT 5;';

				$params = array($_POST['courseId']);
				$param_types = 'i';
				
				require dirname(__FILE__).'/../configuration/database_query.php';

				print_r($res);

				require dirname(__FILE__).'/../configuration/database_disconnect.php';

				if(!is_null($res)){

					print('
						<div class = "course-section">
						<section class = "course-section">
							<h2>Corso: '.$res['name'].'</h2>
						</section>
						<br><br>
					');

					//while($row = mysqli_fetch_assoc($res)){
					foreach($res as $row){
						print('<br><br>');
						//print($row);
						/*
						print('
						<section class = "course-section">
							<h2>Video: '.$row['title'].'</h2>
							<video controls>
								<source src = "videos/'.$row['file'].'.'.$row['type'].'" type = "video/'.$row['type'].'">
							</video>
						</section>
						');*/
					}

					print('
						<section class = "course-section">
							<p>Descrizione: '.$res['description'].'</p>
							<br><br>
							<p>Valutazione media: '.$res['average_evaluation'].'</p>
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