<?php
require_once('../Models/productDB.php');
session_start();

function products() {
    return productsInfo();
}

function filterProducts($filter) {
    return filterProductsByType($filter);
}
?>
