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

	<link rel = 'stylesheet' href = './css/show-profile.css'>

</head>

<body>

	<?php
		require dirname(__FILE__).'/../modules/header.php';
	?>

	<!-- Corpo della pagina. -->
	<main>

		<?php
			print('	
			<section class = \'profile\'>
            	<div class = \'card\'>
            		<div class = \'card-body\'>
                    	<img src = \'images/user_icon.png\' alt = \'Immagine profilo.\' class = \'profile-image\'>
                    	<div class = \'user-infos\'>
                      		<h4>'.$_SESSION['name'].' '.$_SESSION['surname'].'</h4>
                      		<p>'.$_SESSION['email'].'</p>
							<p>
			');

			$query = 'SELECT * FROM teach WHERE email_user = ?;';

			$params = array($_SESSION['email']);
			/* 'ssd' means that the first two params are bounded as strings and the last one as float. */
			$param_types = 's';
				
			$res;

			require dirname(__FILE__).'/../configuration/database_connect.php';
			require dirname(__FILE__).'/../configuration/database_query.php';

			if($_SESSION['admin'] === 'true'){
				print('Amministratore');
			}
			elseif(!empty($res)){
				print('Insegnante');
			}
			else{
				print('Studente');
			}

			print('
                      		</p>
						</div>
                    </div>
                </div>
            </section>
			');
			/* Nota: aggiungere tabella/elenco dei corsi seguiti dall'utente e i corsi tenuti. */
			$query = 'SELECT c.id, c.name, c.description
			          FROM course c JOIN follow f ON c.id = f.id_course
					  WHERE f.email_user = ?;';

			require dirname(__FILE__).'/../configuration/database_query.php';

			print('
			<section>
				<h2 class="subtitle">Corsi seguiti</h2>
				<br><br>
				<table class = \'table\'>
                    <tr>
                        <th class="index-element">ID corso</th>
                        <th class="index-element">Titolo</th>
                        <th class="index-element">Descrizione</th>
                    </tr>
			');

			foreach($res as $row){
				printf('
					<tr>
                        <th>%s</th>
                        <th>%s</th>
                        <th>%s</th>
				', $row['id'], $row['name'], $row['description']);
			}

			print('
                </table>
            </section>

			<section>
				<h2 class="subtitle" >Corsi tenuti</h2>
				<br><br>
				<table class = \'table\'>
                    <tr>
                        <th class="index-element" >ID corso</th>
                        <th class="index-element">Titolo</th>
                        <th class="index-element">Descrizione</th>
                    </tr>
            ');

			$query = 'SELECT c.id, c.name, c.description
			          FROM course c JOIN teach t ON c.id = t.id_course
					  WHERE t.email_user = ?;';

			require dirname(__FILE__).'/../configuration/database_query.php';
			require dirname(__FILE__).'/../configuration/database_disconnect.php';

			foreach($res as $row){
				printf('
					<tr>
                        <th>%s</th>
                        <th>%s</th>
                        <th>%s</th>
				', $row['id'], $row['name'], $row['description']);
			}

			print('
				</table>
			</section>
			');
		?>

	</main>

	<?php 
		require dirname(__FILE__).'/../modules/footer.php'; 
	?>
	
</body>
</html>