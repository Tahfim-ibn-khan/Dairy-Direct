<?php 
session_start();
$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: admin_login.php');
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
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>admin dashboard</title>
</head>
<body>
    
    <?php include 'admin_header.php'; ?>
    <div class="main">
        <div class="title2">
            <a href="dashboard.php">dashboard </a><span>/ add products </span>
        </div>
            <h1 class="heading">add product</h1>
            <div class="form-container">
                <form action="../Controllers/add_product_controller.php" method="post">
                    <div class="input-field">
                        <label>product name <sup>*</sup></label>
                        <input type="text" name="title" maxlength="100" required placeholder="add post title">
                    </div>
                    <div class="input-field">
                        <label>product price <sup>*</sup></label>
                        <input type="number" name="price" maxlength="100" required placeholder="add post title">
                    </div>
                    <div class="input-field">
                        <label>product quantity <sup>*</sup></label>
                        <input type="number" name="quantity" maxlength="100" required placeholder="add post title">
                    </div>
                    <div class="input-field">
                        <label>product detail<sup>*</sup></label>
                        <textarea name="content" required maxlength="10000" placeholder="write your content.."></textarea>
                    </div>
                    <div class="input-field">
                        <label>Consumer <sup>*</sup></label>
                        <select name="consumer" required>
                            <option value="">Select the consumer</option>
                            <option value="Household Customer">Household Customer</option>
                            <option value="Commercial Customer">Commercial Customer</option>
                        </select>
                    </div>
                    <div class="input-field">
                        <label>product image <sup>*</sup></label>
                        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" required>
                    </div>
                    <div class="input-field">
                        <label>Total Sold <sup>*</sup></label>
                        <input type="number" name="totalSold" value="0" required placeholder="Total Sold">
                    </div>
                    <div class="input-field">
                        <label>Expected Sell <sup>*</sup></label>
                        <input type="number" name="expectedSell" value="0" required placeholder="Expected Sell">
                    </div>
                    <div class="flex-btn">
                        <input type="submit" name="publish" value="Post" class="btn">
                        <input type="submit" name="publish" value="Draft" class="option-btn">
                    </div>
                </form>
            </div>
        </section>
    </div>
    
    <script type="text/javascript" src="adminScript.js"></script>
</body>
</html>
