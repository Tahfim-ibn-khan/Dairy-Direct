<?php 
require_once('connectionDB.php');

function usersInfo() {
    global $conn;
    $select_products = $conn->prepare("SELECT * FROM `users`");
    $select_products->execute();
    return $select_products;
}
?>