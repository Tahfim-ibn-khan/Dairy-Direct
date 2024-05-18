<?php 
session_start();

$admin_id = $_SESSION['admin_id'];

if (!isset($admin_id)) {
    header('location: admin_login.php');
    exit();
}

$fetch_profile_query = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
$fetch_profile_query->execute([$admin_id]);
$fetch_profile = $fetch_profile_query->fetch(PDO::FETCH_ASSOC);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
    <title>Admin Login page</title>
    <style>
        <?php include 'admin_style.css'; ?>
    </style>
</head>
<body style="padding-left: 0 !important;">
    
    <?php include 'admin_header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>update profile</h1>
        </div>
        <div class="title2">
            <a href="home.php">home </a><span>/ update profile</span>
        </div>
        <section>
            <?php 
                if (isset($message)) {
                    foreach ($message as $msg) {
                        echo '
                            <div class="message">
                                <span>'.$msg.'</span>
                                <i class="bx bx-x" onclick="this.parentElement.remove();"></i>
                            </div>
                        ';
                    }
                }
            ?>
            <div class="form-container" id="admin_login">
                <form action="../Controllers/update_profile_controller.php" method="post" enctype="multipart/form-data">
                    <div class="profile">
                        <img src="image/<?= $fetch_profile['profile']; ?>" class="logo-image" width="100">
                    </div>
                    <h3>update profile</h3>
                    <input type="hidden" name="old_image" value="<?= $fetch_profile['profile']; ?>">
                    <div class="input-field">
                        <label>User name <sup>*</sup></label>
                        <input type="text" name="name" maxlength="20" placeholder="Enter your username" oninput="this.value.replace(/\s/g,'')" value="<?= $fetch_profile['name']; ?>">
                    </div>
                    <div class="input-field">
                        <label>User email <sup>*</sup></label>
                        <input type="email" name="email" maxlength="20" placeholder="Enter your email" value="<?= $fetch_profile['email']; ?>">
                    </div>
                    <div class="input-field">
                        <label>old password <sup>*</sup></label>
                        <input type="password" name="old_pass" maxlength="20" placeholder="Enter your old password">
                    </div>
                    <div class="input-field">
                        <label>new password <sup>*</sup></label>
                        <input type="password" name="new_pass" maxlength="20" placeholder="Enter your new password">
                    </div>
                    <div class="input-field">
                        <label>confirm password <sup>*</sup></label>
                        <input type="password" name="confirm_pass" maxlength="20" placeholder="Confirm your new password">
                    </div>
                    <div class="input-field">
                        <label>upload profile <sup>*</sup></label>
                        <input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp">
                    </div>
                    <input type="submit" name="submit" value="update profile" class="btn">
                </form>
            </div>
        </section>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include '../Controllers/alert.php'; ?>
</body>
</html>
