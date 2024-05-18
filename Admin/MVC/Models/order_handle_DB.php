<?php 
require_once('connectionDB.php');

function ordersInfo() {
    global $conn;
    $select_products = $conn->prepare("SELECT * FROM `orders`");
    $select_products->execute();
    return $select_products;
}

function delete_order($delete_id) {
    global $conn;
    $verify_delete = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
	$verify_delete->execute([$delete_id]);

	if ($verify_delete->rowCount() > 0) {
		$delete_review = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
		$delete_review->execute([$delete_id]);
        return true;
	}
    else{
        return false; // Changed return value to false if deletion fails
	}
}

function update_order($order_id,$update_payment) {
    global $conn;
    $update_pay = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
    $update_pay->execute([$update_payment, $order_id]);
    return true;
}
?>
