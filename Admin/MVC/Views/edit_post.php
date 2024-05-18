<?php 
	 include '../Models/connectionDB.php';
	 session_start();

	 $admin_id = $_SESSION['admin_id'];

	 if (!isset($admin_id)) {
	 	header('location: admin_login.php');
	 }
	//  function unique_id(){
	// 	$chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
	// 	$charLength = strlen($chars);
	// 	$randomString = '';
	// 	for ($i=0; $i < 20 ; $i++) { 
	// 		$randomString.=$chars[mt_rand(0, $charLength - 1)];
	// 	}
	// 	return $randomString;
		
	// }
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
			<h1>edit post</h1>
		</div>
		<div class="title2">
			<a href="home.php">home </a><span>/ edit post</span>
		</div>
		<section class="post-editor">
			
			
			<h1 class="heading">edit post</h1>
			<?php 
				$post_id = $_GET['id'];
				$select_posts = $conn->prepare("SELECT * FROM `products` WHERE id =?");
				$select_posts->execute([$post_id]);
				if ($select_posts->rowCount() > 0) {
					while($fetch_posts = $select_posts->fetch(PDO::FETCH_ASSOC)){
			?>
			<div class="form-container">
				<form action="../Controllers/edit_post_controller.php?id=<?= $post_id ?>" method="post" enctype="multipart/form-data">
					<input type="hidden" name="old_image" value="<?= $fetch_posts['image']; ?>">
					<input type="hidden" name="post_id" value="<?= $fetch_posts['id']; ?>">
					<div class="input-field">
						<label>post status <sup>*</sup></label>
						<select name="status" required>
							<option value="<?= $fetch_posts['status']; ?>" selected><?= $fetch_posts['status']; ?></option>
							<option value="active">active</option>
							<option value="deactive">deactive</option>
						</select>
					</div>
					<div class="input-field">
						<label>product  name<sup>*</sup></label>
						<input type="text" name="title" maxlength="100" required placeholder="add post title" value="<?= $fetch_posts['name']; ?>">
					</div>
					<div class="input-field">
						<label>product price <sup>*</sup></label>
						<input type="number" name="price" value="<?= $fetch_posts['price']; ?>">
						
					</div>
					<div class="input-field">
						<label>product detail <sup>*</sup></label>
						<textarea name="content" required maxlength="10000" placeholder="write your content.."><?= $fetch_posts['product_detail']; ?></textarea>
					</div>
					<div class="input-field">
						<label>post image <sup>*</sup></label>
						<input type="file" name="image" accept="image/jpg, image/jpeg, image/png, image/webp" >
						<?php if($fetch_posts['image'] != ''){ ?>
							<img src="img/<?= $fetch_posts['image']; ?>" class="image">
						<?php } ?>
					</div>
					
					<div class="flex-btn">
					    <input type="submit" value="Save post" name="save" class="btn" >
					    <input type="submit" value="Delete post" class="btn" name="delete_post">
					</div>
					
				</form>
			</div>
			
			<?php 
					}
				}else{

					echo '
							<div class="empty">
								<p>no post found!</p>
							</div>
					';
				
			?>
			<div class="flex-btn">
				<a href="view_posts.php" class="option-btn">view post</a>
				<a href="add_posts.php" class="option-btn">add post</a>
			</div>
			<?php } ?>
		</section>
	</div>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
	<script type="text/javascript" src="script.js"></script>

	<?php include '../Controllers/alert.php'; ?>
</body>
</html>