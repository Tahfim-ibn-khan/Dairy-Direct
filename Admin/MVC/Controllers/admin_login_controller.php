<?php
require_once('../Models/loginDB.php');
session_start();

$name = $_POST['name'];
$pass = $_POST['password'];


$status = auth($name, $pass);
$message = "This is an alert message.";
echo "<script>alert('$message');</script>";

if ($status) {
    header("Location: ../Views/dashboard.php");
    unset($_SESSION['message']);
    exit(); 
} else {
    $_SESSION['message'] = "Provide us your correct credentials";
    header("Location: ../Views/admin_login.php");
    exit();
}
?>

