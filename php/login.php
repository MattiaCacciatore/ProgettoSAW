<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <title>Sign-In</title>
</head>

<body>
    <?php
		if(isset($_POST["submit"])){
			$email    = $_POST["email"];
			$password = $_POST["pass"];
			if(empty($email) || empty($password)){
				print("ERROR: Some credentials are empty, try again.<br>");
			}
			else{
				//$file = file_get_contents("users.txt"); // Dovrebbe essere una stringa, altrimenti e' un booleano.
				$file_name = "users.txt";
				$file = fopen($file_name, "r");
				if($file === false){
					print("ERROR: Couldn't recover any credentials. Try again.<br>");
					exit();
				}
				if(flock($file,LOCK_SH)){ // Necessario?
					$size = filesize($file_name);
					if($size !== false && $size > 0){
						$users = fread($file, $size);
						if($users !== false){
							// I dati sono stati letti e trasferiti in un array, il file non serve piu'.
							flock($file,LOCK_UN);
							if(fclose($file) !== false){
								$users_credentials = explode("\t", $users);
								// In posizione 3 (con indice 2), dopo nome e cognome c'e' l'email, poi si avanza
								// a quella dell'utente successivo con +4.
								for($i = 2; $i < (count($users_credentials) - 1); $i = $i + 4){
									if(strcmp($users_credentials[$i], $email) === 0){
										if(password_verify($password, $users_credentials[$i+1])){
											print("<p>Correct credentials!</p>");
											if(session_start()){
												print("<p>Login successful, welcome!</p>");
												$_SESSION['name'] = $users_credentials[$i-2];
												$_SESSION['surname'] = $users_credentials[$i-1];
												$_SESSION['authentication'] = true;
												header('Location: http://localhost/SAW/private/reserved.php');
											}
											else{
												print("ERROR: Couldn't recover any credentials. Try again.<br>");
											}
										}
										else{
											print("<p>Login unsuccessful.</p>");
										}
										print("<p>Select <a href = \"../index.html\">Homepage</a> in order to return to the main page.</p>");
										break;
									}
								}
							}
							else{
								print("ERROR: Couldn't close database.<br>");
							}
						}
						else{
							print("ERROR: Couldn't check your credentials in the database. Couldn't access to database.<br>");
						}
					}
					else{
						print("ERROR: Couldn't check your credentials in the database. Couldn't access to database.<br>");
					}
				}
				else{
					print("ERROR: Couldn't check your credentials in the database. Error with lock.<br>");
				}
			}
		}
		else{
			header('Location: http://localhost/SAW/forms/login.html');
		}
    ?>
</body>
</html>