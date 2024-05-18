<?php 	
	session_start();

	$admin_id = $_SESSION['admin_id'];

	if (isset($admin_id)) {
		header('location: dashboard.php');
	}

	if (isset($_SESSION['message']))
	{
		$message[] = $_SESSION['message'];
		unset($_SESSION['message']);
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
	<title>Admin Login page</title>
</head>
<body style="padding-left: 0 !important;">
	<?php 
		include 'admin_header.php';
		
		if (isset($message)) {
			foreach ($message as $message) {
				echo '
					<div class="message">
						<span>'.$message.'</span>
						<i class="bx bx-x" onclick="this.parentElement.remove();"></i>
					</div>
				';
			}
		}
	?>
	<div class="main-container">
		<section class="form-container" id="admin_login">
			<form  method="post" action="../Controllers/admin_login_controller.php">
				<h3>login now</h3>
				<div class="input-field">
					<label>User name <sup>*</sup></label><br>
					<input type="text" name="name" maxlength="20" required placeholder="Enter your username" oninput="this.value.replace(/\s/g,'')">
				</div>
				<div class="input-field">
					<label>password <sup>*</sup></label><br>
					<input type="password" name="password" maxlength="20" required placeholder="Enter your password" oninput="this.value.replace(/\s/g,'')">
				</div>
				<input type="submit" name="submit" value="login now" class="btn">
			</form>
		</section>
	</div>
</body>
</html>