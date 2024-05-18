<?php
include("../model/connection.php");
include("../controller/header2.php");

if(isset($_SESSION['username']) && !isset($_SESSION['alert_shown'])) {
    $username = $_SESSION['username'];
    echo "<script>alert('Welcome, $username!');</script>";
    $_SESSION['alert_shown'] = true;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" type="text/css" href="./css/home.css">
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0 0 0);
        margin-bottom: 20px;
        padding: 20px;
    }
    .btn {
        padding: 10px 20px;
        margin-right: 10px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }
    .btn-edit {
        background-color: #4CAF50;
        color: white;
    }
    .btn-delete {
        background-color: #f44336;
        color: white;
    }
    .btn-create {
        background-color: #2196F3;
        color: white;
        margin-bottom: 10px;
    }
    /* Modal styles */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgb(0,0,0);
        background-color: rgba(0,0,0,0.4);
    }
    .modal-content {
        background-color: #fefefe;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
    }
</style>
</head>
<body>
<center><td colspan="6" class="active"><h2>Overall Status</h2></td></center>
<div id="content">
    <!-- PHP code to fetch and display orders -->
    <?php
// Include database connection file
include("../model/connection.php");

// Query to calculate overall status
$query = "SELECT 
            COUNT(*) AS total_orders, 
            SUM(TotalAmount) AS total_sales, 
            AVG(TotalAmount) AS avg_order_value 
          FROM orders";
$result = mysqli_query($con, $query);

// Check if query was successful
if ($result) {
    // Fetch overall status from the result set
    $status = mysqli_fetch_assoc($result);
    
    // Display overall status
    echo "<div class='card'>";
    echo "<h3>Overall Status</h3>";
    echo "<p>Total Orders: " . $status['total_orders'] . "</p>";
    echo "<p>Total Sales: $" . $status['total_sales'] . "</p>";
    echo "<p>Average Order Value: $" . round($status['avg_order_value'], 2) . "</p>";
    echo "</div>";
} else {
    // Handle the case where the query fails
    echo "Error fetching overall status: " . mysqli_error($con);
}
?>

</div>

<?php
include "../controller/footer.php";
?>
</body>
</html>
