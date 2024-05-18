<?php
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: admin_login.php');
}

include '../Controllers/admin_info_controller.php';

$admins = getAllAdmins();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <style>
        <?php include 'admin_style.css'; ?>
    </style>
    <title>Admin Dashboard</title>
</head>
<body>
    <?php include 'admin_header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>Admin Account</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home</a><span>/ Admin Account</span>
        </div>
        <section class="accounts">
            <h1 class="heading">Admin Account</h1>
            <div class="box-container">
                <?php if (!empty($admins)): ?>
                    <?php foreach ($admins as $admin): ?>
                        <div class="box">
                            <div class="profile">
                                <img src="image/<?= $admin['profile']; ?>" class="logo-image" width="100">
                            </div>
                            <p>Admin ID: <span><?= $admin['id']; ?></span></p>
                            <p>Admin Name: <span><?= $admin['name']; ?></span></p>
                            <p>Admin Email: <span><?= $admin['email']; ?></span></p>
                            <div class="flex-btn">
                                <a href="update_profile.php" class="btn">Update Profile</a>
                                <a href="components/admin_logout.php" onclick="return confirm('Logout from this website?')" class="btn">Logout</a>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <div class="empty">
                        <p>No posts found!</p>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    </div>
    <script type="text/javascript" src="adminScript.js"></script>
</body>
</html>
