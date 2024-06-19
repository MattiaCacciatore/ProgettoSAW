<?php 
	require dirname(__FILE__).'/../configuration/check_session.php'; 
?>

<!DOCTYPE html>
<html lang = 'it'>

<head>

	<?php 
		include dirname(__FILE__).'/../modules/head_style.php'; 
	?>

	<link rel = 'stylesheet' href = './css/show_profile.css'>

</head>
    

<body>
	<?php
		require dirname(__FILE__).'/../modules/header.php';
	?>

	<!-- Corpo della pagina. -->
	<main>

		<?php
			/* Non serve interrogare di nuovo il server, i dati dell'utente
			 sono salvati nell'array superglobale $SESSION di sessione. */
			print('
			<section class = "profile">
            	<div class = "card">
            		<div class = "card-body">
                    	<img src = "images/user_icon.png" alt = "Immagine profilo" class = "centered">
                    	<div class = "table">
                      		<h4>'.$_SESSION['name'].' '.$_SESSION['surname'].'</h4>
                      		<p>'.$_SESSION['email'].'</p>
							<p>
			');

			if($_SESSION['admin'] === 'true'){
				print('Amministratore');
			}
			else{
				print('Utente');
			}

			print('
                      		</p>
						</div>
                    </div>
                </div>
            </section>
			');
		?>

	</main>

	<?php 
		require dirname(__FILE__).'/../modules/footer.php'; 
	?>
	
</body>
</html>