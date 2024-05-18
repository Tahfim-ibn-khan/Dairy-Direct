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
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<title>Admin Dashboard</title>
</head>
<body>
	<?php include 'admin_header.php'; ?>
	<div class="main">
		<div class="title2">
			<a href="dashboard.php">Dashboard</a>
		</div>
		<div class="heading">
				<h1>Available products</h1>
			</div>
			<div class="container text-center">
				<div class="row">
					<div class="col" id="columnChart">
					<?php include 'columnChart.php'?>
					</div>
				</div>
			</div>
		<section class="dashboard">
			<h1 class="heading">Dashboard</h1>
			<div class="box-container">
				<div class="box">
					<h3>Welcome!</h3>
					<p><?= $adminProfile['name']; ?>Tahfim</p>
					<a href="update_profile.php" class="btn">Update Profile</a>
				</div>
				<div class="box">
					<?php 
						$select_post = $conn->prepare("SELECT * FROM `products`");
						$select_post->execute();
						$number_of_posts = $select_post->rowCount();
					?>
					<h3><?= $number_of_posts; ?></h3>
					<p>Products Added</p>
					<a href="add_posts.php" class="btn">Add New Post</a>
				</div>
				<div class="box">
					<?php 
						$select_users = $conn->prepare("SELECT * FROM `users`");
						$select_users->execute();
						$number_of_users = $select_users->rowCount();
					?>
					<h3><?= $number_of_users; ?></h3>
					<p>Users Account</p>
					<a href="user_accounts.php" class="btn">See Users</a>
				</div>
				<div class="box">
					<?php 
						$select_admins = $conn->prepare("SELECT * FROM `admin`");
						$select_admins->execute();
						$number_of_admins = $select_admins->rowCount();
					?>
					<h3><?= $number_of_admins; ?></h3>
					<p>Admins Account</p>
					<a href="admin_accounts.php" class="btn">See Admin</a>
				</div>
				<div class="box">
					<?php
			         $select_comments = $conn->prepare("SELECT * FROM `message`");
			         $select_comments->execute();
			         $numbers_of_comments = $select_comments->rowCount();
			      ?>
			      <h3><?= $numbers_of_comments; ?></h3>
			      <p>Messages Added</p>
			      <a href="admin_message.php" class="btn">See Messages</a>
				</div>
			   <div class="box">
			      <?php
			         $select_canceled_order = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
			         $select_canceled_order->execute(['canceled']);
			         $total_canceled_order = $select_canceled_order->rowCount();
			      ?>
			      <h3><?= $total_canceled_order; ?></h3>
			      <p>Total Canceled Orders</p>
			      <a href="admin_order.php" class="btn">See Orders</a>
			   </div>
			   <div class="box">
			      <?php
			         $select_confirm_order = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
			         $select_confirm_order->execute(['in progress']);
			         $total_confirm_order = $select_confirm_order->rowCount();
			      ?>
			      <h3><?= $total_confirm_order; ?></h3>
			      <p>Total Orders In Progress</p>
			      <a href="admin_order.php" class="btn">See Orders</a>
			   </div>
			   <div class="box">
			      <?php
			         $select_total_order = $conn->prepare("SELECT * FROM `orders`");
			         $select_total_order->execute();
			         $total_total_order = $select_total_order->rowCount();
			      ?>
			      <h3><?= $total_total_order; ?></h3>
			      <p>Total Orders Placed</p>
			      <a href="admin_order.php" class="btn">See Orders</a>
			   </div>
			</div>
		</section>
	</div>
	<script src="adminScript.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
