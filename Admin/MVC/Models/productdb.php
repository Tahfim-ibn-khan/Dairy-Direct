<?php 
require_once('connectionDB.php');

function productsInfo() {
    global $conn;
    $select_products = $conn->prepare("SELECT * FROM `products`");
    $select_products->execute();
    return $select_products;
}

function filterProductsByType($type) {
    global $conn;
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE consumer = ?");
    $select_products->execute([$type]);
    return $select_products;
}

function delete_product($p_id){
    $delete_post = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_post->execute([$p_id]);
    $message[] = 'post deleted successfully';
    return true;
}        
?>
