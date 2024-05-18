<?php
include '../Models/edit_post_db.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: admin_login.php');
    exit(); 
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (isset($_POST['save'])) {
        $post_id = $_GET['id'];
        $post_id = filter_var($post_id, FILTER_SANITIZE_NUMBER_INT);
        if (!is_numeric($post_id)) {
            exit("Invalid post ID");
        }
        $title = $_POST['title'];
        $title = filter_var($title, FILTER_SANITIZE_STRING);
        $price = $_POST['price'];
        $price = filter_var($price, FILTER_SANITIZE_STRING);
        $content = $_POST['content'];
        $content = filter_var($content, FILTER_SANITIZE_STRING);
        $status = $_POST['status'];
        $status = filter_var($status, FILTER_SANITIZE_STRING);
        update_post($title, $price, $content, $status, $post_id);
        header('location:../Views/view_posts.php');
        exit();
    } elseif (isset($_POST['delete_post'])) {
        $post_id = $_POST['post_id'];
        $post_id = filter_var($post_id, FILTER_SANITIZE_NUMBER_INT);
        if (!is_numeric($post_id)) {
            $post_id = $_GET['id'];
            header('location:../Views/view_posts.php');
            exit();
        }
        delete_post($post_id);
        header('location:../Views/view_posts.php');
        exit(); 
    }
}
?>
