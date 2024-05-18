<?php 
	session_start();
	$admin_id = $_SESSION['admin_id'];

	 if (!isset($admin_id)) {
	 	header('location: admin_login.php');
	 }

	
?>
<style type="text/css">
	<?php 
		include 'admin_style.css';

	?>
</style>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!--box icon link-->
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<title>admin pannel</title>
</head>
<body>
	
		<?php include 'admin_header.php'; ?>
		<div class="main">
			<div class="title2">
				<a href="home.php">home </a><span>/ total order</span>
			</div>
		<section class="order-container">
			<h1 class="heading">total order placed</h1>
			<div class="box-container">
				<?php 
					require_once('../Controllers/order_handle_controller.php');
					$select_orders = orders();
					if ($select_orders->rowCount() > 0) {
						while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
				?>
				<div class="box">
					<div class="status" style="color: <?php if($fetch_orders['status'] == 'in progress'){echo 'limegreen'; }else{echo "coral";} ?>;"><?= $fetch_orders['status'] ?></div>
					<div class="detail">
						<p>user name: <span><?= $fetch_orders['name']; ?></span></p>
						<p>user id: <span><?php echo $fetch_orders['user_id']; ?></span></p>
						<p>placed on: <span><?= $fetch_orders['date']; ?></span></p>
						<p>number : <span><?php echo $fetch_orders['number']; ?></span></p>
						<p>email : <span><?php echo $fetch_orders['email']; ?></span></p>
						<p>total price : <span><?php echo $fetch_orders['price']; ?></span></p>
						<p>method : <span><?php echo $fetch_orders['method']; ?></span></p>
						<p>address : <span><?php echo $fetch_orders['address']; ?></span></p>
					</div>
					<form method="post" action="../Controllers/order_handle_controller.php">
						<input type="hidden" name="order_id" value="<?php echo $fetch_orders['id']; ?>">
						<select name="update_payment">
							<option disabled selected><?php echo $fetch_orders['payment_status']; ?></option>
							<option value="pending">Pending</option>
							<option value="in progress">in progress</option>
							<option value="complete">complete</option>
							<option value="canceled">canceled</option>
						</select>
						<div class="flex-btn">
							<input type="submit" name="update_order" value="update payment" class="btn">
							<input type="submit" name="delete_order" value="delete order" class="btn" onclick="return confirm('Delete this order?');">
						</div>
					</form>
					
				</div>
				<?php 
						}
					}else{
							echo '
								<div class="empty">
									<p>no order placed yet!</p>
								</div>
							';
					}		
				?>
			</div>
		</section>
	</div>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <script src="script.js"></script>
    <?php include '../Controllers/alert.php'; ?>
	
</body>
</html>
