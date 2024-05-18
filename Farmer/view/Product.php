<?php
include("../model/connection.php");
include("../controller/header2.php");

if(isset($_SESSION['username']) && !isset($_SESSION['alert_shown'])) {
    $username = $_SESSION['username'];
    echo "<script>alert('Welcome, $username!');</script>";
    $_SESSION['alert_shown'] = true;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Prepare and execute the SQL statement to insert the new product
    $query = "INSERT INTO products (name, description, price, quantity) VALUES ('$name', '$description', '$price', '$quantity')";
    $result = mysqli_query($con, $query);

    // Check if the query was successful
    if ($result) {
        // Product added successfully
        header("Location: Product.php"); // Redirect to the dashboard page
        exit();
    } else {
        // Failed to add product
        echo "Error: " . mysqli_error($con);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Product Management</title>
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
    .product-container {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-around;
    }
    .product-card {
        width: 300px;
        margin-bottom: 20px;
        background-color: #f9f9f9;
        border-radius: 10px;
        padding: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
</style>
</head>
<body>
<center><td colspan="6" class="active"><h2>Product Management</h2></td></center>
<div id="content">
    <!-- Add Product Section -->
    <div class="card">
       
    <h3>Add New Product</h3>
        <!-- Form to add new product -->
        <form method="post" action="">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            <label for="description">Description:</label><br>
            <textarea id="description" name="description" rows="4" cols="50"></textarea><br><br>
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" min="0" step="0.01" required><br><br>
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="0" required><br><br>
            <button type="submit" class="btn btn-create">Add Product</button>
        </form>
    </div>

    <!-- Product List -->
    <div class="product-container">
        <?php
        // Fetch and display products
        $query = "SELECT * FROM products";
        $result = mysqli_query($con, $query);

        if(mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product-card'>";
                echo "<h3>" . $row['name'] . "</h3>";
                echo "<p><strong>Description:</strong> " . $row['description'] . "</p>";
                echo "<p><strong>Price:</strong> $" . $row['price'] . "</p>";
                echo "<p><strong>Quantity:</strong> " . $row['quantity'] . "</p>";
                // Add more product details as needed
                echo "</div>";
            }
        }
        else {
            echo "<p>No products available.</p>";
        }
        ?>
    </div>
</div>

<?php
include "../controller/footer.php";
?>
</body>
</html>
<?php
include("../model/connection.php");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $name = $_POST['name'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];

    // Prepare and execute the SQL statement to insert the new product
    $query = "INSERT INTO products (name, description, price, quantity) VALUES ('$name', '$description', '$price', '$quantity')";
    $result = mysqli_query($con, $query);

    // Check if the query was successful
    if ($result) {
        // Product added successfully
        header("Location: Product.php"); // Redirect to the dashboard page
        exit();
    } else {
        // Failed to add product
        echo "Error: " . mysqli_error($con);
    }
}
?>
