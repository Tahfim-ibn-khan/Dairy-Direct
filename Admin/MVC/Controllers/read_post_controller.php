<?php
include '../Models/read_post_db.php';

if (isset($_POST['delete'])) {
    $p_id = $_POST['post_id'];
    $p_id = filter_var($p_id, FILTER_SANITIZE_STRING);
    if (deletePost($p_id)) {
        echo "<script>alert('$message');</script>";
        header('location: view_posts.php');
        exit();
    }
}

function productInfo($get_id) {
    return getProductInfo($get_id);
}
?>
