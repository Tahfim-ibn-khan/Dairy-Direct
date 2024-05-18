<?php
require_once('../Models/connectionDB.php');

if (isset($_POST['search_query'])) {
    $search_query = $_POST['search_query'];
    $select_products = $conn->prepare("SELECT * FROM `products` WHERE name LIKE ?");
    $select_products->execute(['%' . $search_query . '%']);
    
    $results = $select_products->fetchAll(PDO::FETCH_ASSOC);
    echo json_encode($results);
}
?>
