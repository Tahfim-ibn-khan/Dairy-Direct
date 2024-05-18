<?php 
    session_start();

    $admin_id = $_SESSION['admin_id'];

    if (!isset($admin_id)) {
        header('location: admin_login.php');
        exit();
    }
    function unique_id(){
		$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charLength = strlen($chars);
		$randomString = '';
		for ($i=0; $i < 20 ; $i++) { 
			$randomString.=$chars[mt_rand(0, $charLength - 1)];
		}
		return $randomString;
		
	}

    $get_id = $_GET['post_id'];	 
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
    <title>Admin Dashboard</title>
</head>
<body>
    
    <?php include 'admin_header.php'; ?>
    <div class="main">
        <div class="banner">
            <h1>Dashboard</h1>
        </div>
        <div class="title2">
            <a href="home.php">Home </a><span>/ Dashboard</span>
        </div>
        <section class="read-container">
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
            <div class="read-post">
                <?php 
                include '../Controllers/read_post_controller.php';
                $select_posts = productInfo($get_id);
                if ($select_posts->rowCount() > 0) {
                    while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
                ?>
                <form method="post">
                    <input type="hidden" name="post_id" value="<?= $fetch_posts['id']; ?>">
                    <div class="status" style="background-color: <?php if($fetch_posts['status'] == 'active'){echo 'limegreen'; }else{echo "coral";} ?>;"><?= $fetch_posts['status'] ?></div>
                    <?php if($fetch_posts['image'] != ''){ ?>
                        <img src="img/<?= $fetch_posts['image'] ?>" class="image">
                    <?php } ?>
                    <div class="title"><?= $fetch_posts['name'] ?></div>
                    <div class="content"><?= $fetch_posts['product_detail'] ?></div>
                    <div class="flex-btn">
                        <a href="edit_post.php?id=<?= $fetch_posts['id']; ?>" class="btn">Edit</a>
                        <button type="submit" name="delete" class="btn" onclick="return confirm('Delete this post?')">Delete</button>
                        <a href="view_posts.php" class="btn">Go back</a>
                    </div>
                </form>
                <?php 
                    }
                } else {
                    echo '
                        <div class="empty">
                            <p>No post added yet! <br><a href="add_posts.php" class="btn" style="margin-top: 1.5rem;">Add Post</a></p>
                        </div>
                    ';
                }
                ?>
            </div>
        </section>
    </div>
    <script type="text/javascript" src="script.js"></script>
</body>
</html>
