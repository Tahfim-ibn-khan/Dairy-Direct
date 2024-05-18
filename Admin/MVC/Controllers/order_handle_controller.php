<?php

require_once('../Models/order_handle_DB.php');

function orders() {
    return ordersInfo();
}


if (isset($_POST['delete_order'])) {
    $delete_id = $_POST['order_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
    $status = delete_order($delete_id);
    if ($status) {
        header('location: ../Views/admin_order.php');
    } else {
        header('location: ../Views/dashboard.php');
    }
}

if (isset($_POST['update_order'])) {
    $order_id = $_POST['order_id'];
    $order_id = filter_var($order_id, FILTER_SANITIZE_STRING);
    $update_payment = $_POST['update_payment'];
	$update_payment = filter_var($update_payment, FILTER_SANITIZE_STRING);
    $status = update_order($order_id,$update_payment);
    if ($status) {
        header('location: ../Views/admin_order.php');
    } else {
        header('location: ../Views/dashboard.php');
    }
}
?>
