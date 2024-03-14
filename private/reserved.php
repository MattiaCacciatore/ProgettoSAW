<?php
	session_start();

	include __DIR__.'\..\php\check_session.php';
?>

<!DOCTYPE html>
<html lang = "it">

<head>
	<meta http-equiv = "X-UA-Compatible" content = "IE = edge">
	<meta charset = "utf-8">
	<meta name = "viewport" content = "width-device-width", initial-scale = 1.0>
	<link rel = "stylesheet" href = "../css/mystyle.css">
	<title>UniGeAI - Pagina riservata</title>
</head>

<body>
	<h1>Utente autenticato</h1>
	<br>
	<img src = "../images/reserved_area.jpg"
		alt = "Logo che mostra la scritta di area riservata"
	>
	<br>
	<p>Benvenuto/a 
	<?php 
		print($_SESSION['name'] . ' ' . $_SESSION['surname']);
	?>
	</p>

	<p>Ti sei autenticato/a con successo, benvenuto nella sua area riservata!</p>
</body>
</html>