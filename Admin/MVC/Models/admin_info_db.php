<?php
include 'connectionDB.php';

function getAdmin($adminId) {
    global $conn;
    $query = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
    $query->execute([$adminId]);
    return $query->fetch(PDO::FETCH_ASSOC);
}

function fetchAllAdmins() {
    global $conn;
    $query = $conn->prepare("SELECT * FROM `admin`");
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}
?>

