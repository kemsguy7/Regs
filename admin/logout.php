<?php 
	
	session_start();
	session_destroy();
	header("Location: ../index.php");
/*
	if(isset($_GET['logout'])) {
    unset($_SESSION['login']);
    header("Location: ../index.php");   
}*/
?>