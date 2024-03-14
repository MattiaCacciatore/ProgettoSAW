<!DOCTYPE html>
<html lang = "en">

<head>
    <meta charset = "utf-8">
    <title>Sign-Up</title>
</head>

<body>
    <?php
		if(isset($_POST["submit"])){
			// Pulsante di invio presente e riconosciuto, e' stata inviata una richiesta di registrazione.
			$name             = $_POST["firstname"];
			$surname          = $_POST["lastname"];
			$student_id       = $_POST["studentID"];
			$student_fc       = $_POST["fiscalcode"];
			$email            = $_POST["email"];
			$password         = $_POST["pass"];
			$confirm_password = $_POST["confirm"];
			// Controllo che tutti i parametri attesi ci siano e vadano bene.
			if(empty($name) || empty($surname) || empty($email) || empty($password) || empty($confirm_password)){
				print("ERROR: Some credentials are empty, try again.<br>");
			}
			elseif(strcmp("$password","$confirm_password") !== 0){
				print("ERROR: Passwords don't match.<br>");
			}
			else{
				if(!empty($student_id) && !empty($student_fc)){
					$regex_fc = "/[A-Z]{6}\d{2}(A|B|C|D|E|H|L|M|P|R|S|T)((0[1-9])|([1-2][0-9]|3[0-1]|4[1-9]|[5-6][0-9]|7[0-1]))[A-Z]\d{3}[A-Z]/";
					if(preg_match("/S\d{7}/", $student_id) && preg_match($regex_fc, $student_fc)){
						print("<br>Student ID and fiscal code are both correct!<br>");
					}
					else{
						print("<br>Student ID and fiscal code are NOT both correct!<br>");
					}
				}
				// "..." cosi' l'interprete di php puo' espandere le variabili $.
				// Scrittura dei dati su file. 'a+' cosi' che se il file non esiste tenta di crearlo, 
				// fseek() non serve e le scritture avvengono sempre alla fine del file.		
				$file = fopen("users.txt", "a+");
				if($file === false){
					print("ERROR: Couldn't register your credentials in the database. Couldn't access to database.<br>");
					exit();
				}

				// $name = htmlspecialchars($name, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
				// $surname = htmlspecialchars($surname, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
				$name     = htmlentities($name, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
				$surname  = htmlentities($surname, ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
				$password = password_hash($password, PASSWORD_DEFAULT);
				// file_put_contents("users.txt", "$name\t$surname\t$email\t$password\t", FILE_APPEND | LOCK_EX);
				$new_user = "$name\t$surname\t$email\t$password\t"; // '\t' come separatore.

				if(flock($file,LOCK_EX)){
					if(fwrite($file,$new_user) === false){
						print("ERROR: Couldn't register your credentials in the database. Error in writing.<br>");
					}

					flock($file,LOCK_UN);

					print("<p>Registration successful!</p>");
					print("<p>Select <a href = \"../index.html\">Homepage</a> in order to return to the main page.</p>");

					if(fclose($file) === false){
						print("ERROR: Couldn't close database.<br>");
					}
				}
				else{
					print("ERROR: Couldn't register your credentials in the database. Error with lock.<br>");
					exit();
				}
			}
		}
		else{
			print("Wrong HTTP request. Couldn't handle it. Couldn't register any user. Try sending an HTTP POST request.<br>");
		}
    ?>
</body>
</html>