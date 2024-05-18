<?php
include '../Models/productdb.php';
    if (isset($_POST['delete'])) {
        $p_id = $_POST['product_id'];
        $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);

        delete_product($p_id);
    }
?>