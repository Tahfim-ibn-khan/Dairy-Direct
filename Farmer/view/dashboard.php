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
<title>Order Management</title>
<link rel="stylesheet" type="text/css" href="./css/home.css">
<style>
    .card {
        border-radius: 10px;
        box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
    .pagination {
        margin-top: 20px;
        text-align: center;
    }
    .pagination a {
        display: inline-block;
        background-color: #f2f2f2;
        color: black;
        padding: 8px 16px;
        text-decoration: none;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin: 0 2px;
    }
    .pagination a.active {
        background-color: #4CAF50;
        color: white;
    }
    .pagination a:hover:not(.active) {
        background-color: #ddd;
    }
    .order-details {
        background-color: #f9f9f9;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    .order-details p {
        margin: 5px 0;
    }
    .order-details p strong {
        font-weight: bold;
    }
</style>
</head>
<body>
<center><td colspan="6" class="active"><h2>Order Management</h2></td></center>
<div id="content">
    <div class="card">
        <h3>Order Search</h3>
        <form method="get" action="">
            <input type="text" name="search" placeholder="Search by Order ID " value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
            <button type="submit">Search</button>
        </form>
    </div>

    <?php
    // Include database connection file
    include("../model/connection.php");

    // Define variables for pagination
    $ordersPerPage = 2;
    $currentPage = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($currentPage - 1) * $ordersPerPage;
    // Check if search query is set
    $search = isset($_GET['search'])  ? $_GET['search'] : "";
    // Query to fetch orders from the database with pagination and optional search
    if (!empty($search)) {
        // If search query is not empty, filter orders
        $query = "SELECT * FROM orders WHERE OrderID LIKE '%$search%' LIMIT $offset, $ordersPerPage";
        $countQuery = "SELECT COUNT(*) AS total FROM orders WHERE OrderID LIKE '%$search%'";
    } else {
        // If search query is empty, fetch all orders
        $query = "SELECT * FROM orders LIMIT $offset, $ordersPerPage";
        $countQuery = "SELECT COUNT(*) AS total FROM orders";
    }

    $result = mysqli_query($con, $query);

    // Check if query was successful
    if ($result) {
        // Fetch orders from the result set and store them in the $orders array
        $orders = [];
        while ($row = mysqli_fetch_assoc($result)) {
            $orders[] = $row;
        }

        // Close the result set
        mysqli_free_result($result);
    } else {
        // Handle the case where the query fails
        echo "Error fetching orders: " . mysqli_error($con);
        // Optionally, you can set $orders to an empty array or null
        $orders = [];
    }

    // Display orders
    foreach ($orders as $order) {
        echo "<div class='card'>";
        echo "<div class='order-details'>";
        echo "<p><strong>Order ID:</strong> " . $order['OrderID'] . "</p>";
        echo "<p><strong>Customer ID:</strong> " . $order['CustomerID'] . "</p>";
        echo "<p><strong>Order Date:</strong> " . $order['OrderDate'] . "</p>";
        echo "<p><strong>Delivery Date:</strong> " . $order['DeliveryDate'] . "</p>";
        echo "<p><strong>Status:</strong> " . $order['Status'] . "</p>";
        echo "<p><strong>Payment Method:</strong> " . $order['PaymentMethod'] . "</p>";
        echo "<p><strong>Shipping Address:</strong> " . $order['ShippingAddress'] . "</p>";
        echo "<p><strong>Billing Address:</strong> " . $order['BillingAddress'] . "</p>";
        echo "<p><strong>Total Amount:</strong> $" . $order['TotalAmount'] . "</p>";
        echo "<p><strong>Discount:</strong> $" . $order['Discount'] . "</p>";
        echo "<p><strong>Tax:</strong> $" . $order['Tax'] . "</p>";
        echo "<p><strong>Shipping Cost:</strong> $" . $order['ShippingCost'] . "</p>";
        echo "<p><strong>Notes:</strong> " . $order['Notes'] . "</p>";
        // Add more fields as needed
        echo "</div>";
        echo "</div>";
    }

    // Query to count total number of orders
    $countResult = mysqli_query($con, $countQuery);
    $totalOrders = 0;

    if ($countResult) {
        $countRow = mysqli_fetch_assoc($countResult);
        $totalOrders = $countRow['total'];
        mysqli_free_result($countResult);
    } else {
        echo "Error counting orders: " . mysqli_error($con);
    }

    // Calculate total number of pages
    $totalPages = ceil($totalOrders / $ordersPerPage);

    echo "<div class='pagination'>";
    for ($page = 1; $page <= $totalPages; $page++) {
        if ($page == $currentPage) {
            echo "<a class='active'>$page</a>";
        } else {
            echo "<a href='dashboard.php?page=$page&search=$search'>$page</a>";
        }
    }
    echo "</div>";
    ?>

</div>

<?php
include "../controller/footer.php";
?>
</body>
</html>
