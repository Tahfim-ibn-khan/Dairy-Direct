<?php 
	include 'connectionBD.php';

	session_start();
	session_unset();
	session_destroy();
	header('location:../Views/admin_login.php');
?>