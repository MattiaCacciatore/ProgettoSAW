<?php
	# $password = escapeshellcmd('C:\Users\cacci\Desktop\prova.py'); 
	$password = $argv[1];
	$hashed_password = password_hash($password, PASSWORD_DEFAULT); 
	echo $hashed_password; 
?>