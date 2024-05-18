<?php
	include '../Models/connection.php';
    session_start();
    if(isset($_SESSION['admin_id']){
        header('location: ../Views/dashboard.php');
    })
    else{
        header('location: ../Views/admin_login.php');
    }
?>