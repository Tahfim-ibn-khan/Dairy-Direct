<?php 
	session_start();

	$admin_id = $_SESSION['admin_id'];

	if (!isset($admin_id)) {
		header('location: admin_login.php');
		exit();
	}

	include "../Controllers/productInfoController.php";

	if (isset($_SESSION['filter'])) {
		$products = filterProducts($_SESSION['filter']);
		unset($_SESSION['filter']);
	} else {
		$products = products();
	}

	if (isset($_GET['filter'])) {
		$_SESSION['filter'] = $_GET['filter'];
		header('location: view_posts.php');
		exit();
	}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href='https://unpkg.com/boxicons@2.1.2/css/boxicons.min.css' rel='stylesheet'>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<link rel="stylesheet" href="admin_style.css">
	<title>Admin Dashboard</title>
</head>
<body>
	<?php include 'admin_header.php'; ?>
	<div class="main">
		<div class="title2">
			<a href="dashboard.php">Dashboard </a>/ All Products</div>
		<section class="post-editor">
			<div class="input-group mb-3">
				<input type="text" id="search_input" class="form-control" placeholder="Search by name" onkeyup="liveSearch()">
			</div>
			<?php 
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
			<h1 class="heading">Your Posts</h1>
			<form method="GET">
				<div class="mb-3">
					<select class="form-select" name="filter">
						<option value="">All</option>
						<option value="Household Customer">Household Customer</option>
						<option value="Commercial Customer">Commercial Customer</option>
					</select>
				</div>
				<button class="btn btn-primary" type="submit">Filter</button>
			</form>
			<div class="show-post">
				<div class="box-container" id="product_list">
					<?php 
						if ($products->rowCount() > 0) {
							while ($fetch_posts = $products->fetch(PDO::FETCH_ASSOC)) {
								$post_id = $fetch_posts['id'];
					?>
					<form method="post" class="box" action="../Controllers/edit_post_controller.php?id=<?= $post_id ?>">
						<input type="hidden" name="product_id" value="<?= $fetch_posts['id']; ?>">
						<?php if ($fetch_posts['image'] != '') { ?>
							<img src="img/<?= $fetch_posts['image'] ?>" class="image">
						<?php } ?>
						<div class="status" style="color: <?php if ($fetch_posts['status'] == 'active') {echo 'limegreen';} else {echo 'coral';} ?>;"><?= $fetch_posts['status'] ?></div>
						<div class="price">BDT <?= $fetch_posts['price'] ?>/-</div>	
						<div class="title"><?= $fetch_posts['name'] ?></div>	
						<div class="flex-btn">
							<a href="edit_post.php?id=<?= $fetch_posts['id']; ?>" class="btn btn-secondary">Edit</a>
						</div>
					</form>
					<?php 
							}
						} else {
							echo '
								<div class="empty">
									<p>No post added yet! <br><a href="add_posts.php" class="btn btn-primary" style="margin-top: 1.5rem;">Add Post</a></p>
								</div>
							';
						}
					?>
				</div>
			</div>
		</section>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
	<script type="text/javascript" src="script.js"></script>
	<script>
		function liveSearch() {
			let search_query = document.getElementById('search_input').value;
			let xhr = new XMLHttpRequest();
			xhr.open('POST', '../Controllers/search_products.php', true);
			xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
			xhr.onload = function() {
				if (this.status == 200) {
					let results = JSON.parse(this.responseText);
					let product_list = document.getElementById('product_list');
					product_list.innerHTML = '';
					if (results.length > 0) {
						results.forEach(product => {
							product_list.innerHTML += `
								<form method="post" class="box" action="../Controllers/edit_post_controller.php?id=${product.id}">
									<input type="hidden" name="product_id" value="${product.id}">
									${product.image ? `<img src="img/${product.image}" class="image">` : ''}
									<div class="status" style="color: ${product.status == 'active' ? 'limegreen' : 'coral'};">${product.status}</div>
									<div class="price">BDT ${product.price}/-</div>	
									<div class="title">${product.name}</div>	
									<div class="flex-btn">
										<a href="edit_post.php?id=${product.id}" class="btn btn-secondary">Edit</a>
									</div>
								</form>
							`;
						});
					} else {
						product_list.innerHTML = `
							<div class="empty">
								<p>No products found</p>
							</div>
						`;
					}
				}
			};
			xhr.send('search_query=' + encodeURIComponent(search_query));
		}
	</script>
</body>
</html>
