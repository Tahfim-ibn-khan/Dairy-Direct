<?php
include 'connectionDB.php';

function update_post($title, $price, $content, $status, $post_id) {
    global $conn;
    $update_post = $conn->prepare("UPDATE `products` SET name = ?, price = ?, product_detail = ?, status = ? WHERE id = ?");
    $update_post->execute([$title, $price, $content, $status, $post_id]);
    $success_msg[] = 'post updated';
    return true;
}

function delete_post($post_id) {
    global $conn;
    $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_image->execute([$post_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
    if ($fetch_delete_image['image'] != '') {
        unlink('../image/'.$fetch_delete_image['image']);
    }
    $delete_post = $conn->prepare("DELETE FROM `products` WHERE id = ?");
    $delete_post->execute([$post_id]);
    $success_msg[] = 'post deleted successfully!';
    return true;
}
?>
