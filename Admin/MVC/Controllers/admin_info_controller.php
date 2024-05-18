<?php
include '../Models/admin_info_db.php';

session_start();

if (!isset($_SESSION['admin_id'])) {
    header('location: admin_login.php');
    exit();
}

function getAdminInfo($adminId) {
    return getAdmin($adminId);
}

function getAllAdmins() {
    return fetchAllAdmins();
}
?>
