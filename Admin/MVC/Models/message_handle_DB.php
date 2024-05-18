<?php 
require_once('connectionDB.php');

function messagesInfo() {
    global $conn;
    $select_products = $conn->prepare("SELECT * FROM `message`");
    $select_products->execute();
    return $select_products;
}

function delete_message($delete_id) {
    global $conn;
    $verify_delete = $conn->prepare("SELECT * FROM `message` WHERE id = ?");
    $verify_delete->execute([$delete_id]);

    if ($verify_delete->rowCount() > 0) {
        $delete_review = $conn->prepare("DELETE FROM `message` WHERE id = ?");
        $delete_review->execute([$delete_id]);
        return true;
    } else {
        return false;
    }
}
?>
