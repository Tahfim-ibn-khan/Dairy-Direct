<?php
include 'connectionDB.php';

function action($id, $title, $price, $image, $quantity, $content, $status, $consumer, $totalSold, $expectedSell) {
    global $conn;
    
    $quantityAvailable = $quantity;

    $sql = "INSERT INTO products(`id`, `name`, `price`, `quantityAdded`, `quantityAvailable`, `image`, `product_detail`, `status`, `consumer`, `TotalSold`, `expectedSell`) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    
    $stmt = $conn->prepare($sql);
    $values = [$id, $title, $price, $quantity, $quantityAvailable, $image, $content, $status, $consumer, $totalSold, $expectedSell];
    
    if ($stmt->execute($values)) {
        return true;
    } else {
        return false;
    }
}
?>
