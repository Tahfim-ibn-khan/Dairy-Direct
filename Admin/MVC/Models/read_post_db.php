<?php
//echo "<script>alert('$get_id');</script>";

require_once('connectionDB.php');
function deletePost($p_id){
    global $conn;
    $delete_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $delete_image->execute([$p_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
    if ($fetch_delete_image['image'] != '') {
        unlink('../update_image/'.$fetch_delete_image['image']);
    }
    $delete_post = $conn->prepare("DELETE FROM `products` WHERE id=?");
    $delete_post->execute([$p_id]);
    return true;
}

function getProductInfo($get_id){
    global $conn;
    $select_posts = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
    $select_posts->execute([$get_id]);
    return $select_posts;
}
?>
