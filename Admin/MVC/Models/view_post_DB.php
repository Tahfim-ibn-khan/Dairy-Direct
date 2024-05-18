<?php 
require_once('connectionDB.php');

function postsInfo() {
    global $conn;
    $select_products = $conn->prepare("SELECT * FROM `products`");
    $select_products->execute();
    return $select_products;
}
?>