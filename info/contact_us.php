<!DOCTYPE html>
<html lang = 'it'>

<head>

	<?php 
		include dirname(__FILE__).'/../modules/head_style.php';
	?>

	<link rel = 'stylesheet' href = './css/contact.css'>
	<link rel = 'stylesheet' href = '../css/base.css'>

	<title>Contatti | STEMazing Education</title>

</head>

<body>
	<?php
	
		require dirname(__FILE__).'/../modules/header.php';
	?>

<div id="contact-wrapper">
        <h2>Contattaci</h2>
        <p>
            Per contatti ed informazioni scrivere una email al seguente indirizzo: 
            <a href="mailto:info@stemazing.com">info@stemazing.com</a>
            <br><br>
            O chiamare il numero: <a href="tel:33355778899">333 557 78899</a>
            <br><br>
        </p>

        <p>
            Per ritornare alla homepage seleziona il seguente link: <a href="../index.php">Homepage</a>
        </p>

        <h3>Modulo di Contatto</h3>
        <form id="contact-form" action="submit_form.php" method="post">
            <label for="name">Nome:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="message">Messaggio:</label>
            <textarea id="message" name="message" rows="5" required></textarea>

            <button type="submit">Invia</button>
        </form>
    </div>


	<?php
	
		require dirname(__FILE__).'/../modules/footer.php';
	?>

</body>
</html>