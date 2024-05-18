<?php
session_start(); 
//include '../Controllers/admin_info_controller.php';

//$adminProfile = getAdminInfo($_SESSION['admin_id']);
?>

<header class="header">
    <div class="flex">
        <a href="home.php" class="logo"><img height="50px" width="70px" src="image/logo.jpeg"></a>
        <nav class="navbar">
            <a href="dashboard.php">Dashboard</a>
            <a href="add_posts.php">Add Product</a>
            <a href="view_posts.php">View Post</a>
            <a href="user_accounts.php">Accounts</a>
        </nav>
        <div class="icons">
            <?php
            if (isset($_SESSION['admin_id'])) {
                echo '<a href="../Controllers/admin_logout_controller.php"><i class="bx bxs-log-out" id="user-btn"></i></a>';
            } 
            ?>
        </div>
        <div class="profile-detail">
            <?php
            if ($adminProfile) {
            ?>
            <div class="profile">
                <img src="image/<?= $adminProfile['profile']; ?>" class="logo-image" width="100">
                <p><?= $adminProfile['name']; ?></p>
            </div>
            <div class="flex-btn">
                <a href="update_profile.php" class="btn">Update Profile</a>
                <a href="../Controllers/admin_logout_controller.php" onclick="return confirm('Logout from this website')" class="btn">Logout</a>
            </div>
            <?php } ?>
        </div>
    </div>
</header>
