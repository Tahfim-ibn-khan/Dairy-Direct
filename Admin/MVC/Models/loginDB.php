<?php 
require_once('connectionDB.php');

function auth($name, $pass) {
    global $conn;
    $select_admin = $conn->prepare("SELECT * FROM `admin` WHERE name = ? AND password = ?");
    $select_admin->execute([$name, $pass]);

    if ($select_admin->rowCount() > 0) {
        $fetch_admin_id = $select_admin->fetch(PDO::FETCH_ASSOC);
        $_SESSION['admin_id'] = $fetch_admin_id['id'];
        return true;
    } else {
        return false;
    }
}
function adminInfo(){
    global $conn;
    $select_admin = $conn->prepare("SELECT * FROM `admin`");
    $select_admin->execute();
    if ($select_admin->rowCount() > 0) {
        $admins = $select_admin->fetchAll(PDO::FETCH_ASSOC);
        return $admins;
    } else {
        return [];
    }
}

?>
