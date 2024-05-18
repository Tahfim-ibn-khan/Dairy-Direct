<?php
require_once('../Models/add_product_db.php');
require_once('../Models/connectionDB.php');
function unique_id(){
    $chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charLength = strlen($chars);
    $randomString = '';
    for ($i=0; $i < 20 ; $i++) { 
        $randomString.=$chars[mt_rand(0, $charLength - 1)];
    }
    return $randomString;
    
}
session_start();

$id = unique_id();
$title = filter_var($_POST['title'], FILTER_SANITIZE_STRING);
$price = filter_var($_POST['price'], FILTER_SANITIZE_STRING);
$quantity = filter_var($_POST['quantity'], FILTER_SANITIZE_STRING);
$content = filter_var($_POST['content'], FILTER_SANITIZE_STRING);
$consumer = filter_var($_POST['consumer'], FILTER_SANITIZE_STRING);
$totalSold = filter_var($_POST['totalSold'], FILTER_SANITIZE_STRING);
$expectedSell = filter_var($_POST['expectedSell'], FILTER_SANITIZE_STRING);

if($_POST['publish'] == 'Post'){
    $status = 'active';
} else {
    $status = 'deactive';
}

$image = 'p10.png';

$status = action($id, $title, $price, $image, $quantity, $content, $status, $consumer, $totalSold, $expectedSell);

if ($status) {
    header("Location: ../Views/add_posts.php");
    unset($_SESSION['message']);
    exit(); 
} else {
    $_SESSION['message'] = "Adding product unsuccessful";
    header("Location: ../Views/add_posts.php");
    exit();
}
?>
