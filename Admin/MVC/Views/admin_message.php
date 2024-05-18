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
	<!-- font awesome cdn link  -->
   	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<title>admin dashboard</title>
</head>
<body>
	
		<?php include 'admin_header.php'; ?>
		<div class="main">
			<div class="banner">
				<h1>user's messages</h1>
			</div>
			<div class="title2">
				<a href="home.php">home </a><span>/ messages</span>
			</div>
		<section class="message-container">
		<div class="heading"><h1>user's messages</h1></div>
		<div class="box-container">
			<?php 
				require_once('../Controllers/message_handle_controller.php');
				$select_reviews = messages();
				if ($select_reviews->rowCount() > 0) {
					while($fetch_review = $select_reviews->fetch(PDO::FETCH_ASSOC)){
			?>
			<div class="box">
				<h3 class="name">User Name: <?= $fetch_review['name']; ?></h3>
				<h4>Subject: <?= $fetch_review['subject']; ?></h4>
				<p>Message: <?= $fetch_review['message']; ?></p>
				
					<form action="../Controllers/message_handle_controller.php" method="post" class="flex-btn">
						<input type="hidden" name="delete_id" value="<?= $fetch_review['id']; ?>">
						
						<input type="submit" name="delete_review" value="delete message" class="btn" onclick="return confirm('delete this review');">
					</form>
				
			</div>
			<?php 
					}
				}else{
					echo '<p class="empty">no messages added yet!</p>';
				}
			?>
		</div>
	</section>
		
	</div>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

	<script type="text/javascript" src="adminScript.js"></script>

	<?php include '../Controllers/alert.php'; ?>
</body>
</html>