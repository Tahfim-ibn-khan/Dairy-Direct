<?php 
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: admin_login.php');
    exit;
}
?>
<style>
    <?php include 'admin_style.css'; ?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin Dashboard</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="main">
        <div class="title2">
            <a href="home.php">Dashboard </a><span>/ accounts</span>
        </div>
        <div class="heading">
            <h1>Products Total Sale and Expected Sale Comparison</h1>
        </div>

        <div class="container my-5">
            <div class="row">
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Quantity Available</h5>
                            <p class="card-text" id="totalQuantityAvailable">Loading...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Sold</h5>
                            <p class="card-text" id="totalSold">Loading...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Expected Sell</h5>
                            <p class="card-text" id="totalExpectedSell">Loading...</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card text-center">
                        <div class="card-body">
                            <h5 class="card-title">Total Amount Sold (BDT)</h5>
                            <p class="card-text" id="totalAmountSoldBDT">Loading...</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container text-center">
            <div class="row">
                <div class="col">
                    <?php include 'barCharts.php'; ?>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.getElementById('totalQuantityAvailable').innerText = <?php echo $totalQuantityAvailable; ?>;
            document.getElementById('totalSold').innerText = <?php echo $totalSold; ?>;
            document.getElementById('totalExpectedSell').innerText = <?php echo $totalExpectedSell; ?>;
            document.getElementById('totalAmountSoldBDT').innerText = <?php echo $totalAmountSoldBDT; ?>; // Assuming you calculate this in barCharts.php
        });
    </script>
</body>
</html>
