<?php

session_start(); 
session_unset();
session_destroy();


$_SESSION["logout_success"] = "success";

header("Location: ../index.php");

?>