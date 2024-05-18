<?php

require_once('../Models/message_handle_DB.php');

function messages() {
    return messagesInfo();
}

if (isset($_POST['delete_review'])) {
    $delete_id = $_POST['delete_id'];
    $delete_id = filter_var($delete_id, FILTER_SANITIZE_STRING);
    $status = delete_message($delete_id);
    if ($status) {
        header('location: ../Views/admin_message.php');
    } else {
        header('location: ../Views/dashboard.php');
    }
}
?>
