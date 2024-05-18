<?php
require_once('../Models/connectionDB.php'); 
session_start();

$message = []; 

if (isset($_POST['submit'])) {
    $admin_id = $_SESSION['admin_id']; 


    $fetch_profile_query = $conn->prepare("SELECT * FROM `admin` WHERE id = ?");
    $fetch_profile_query->execute([$admin_id]);
    $fetch_profile = $fetch_profile_query->fetch(PDO::FETCH_ASSOC);


    $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
    if (!empty($name) && $name != $fetch_profile['name']) {
        $select_name = $conn->prepare("SELECT * FROM `admin` WHERE name = ?");
        $select_name->execute([$name]);
        if ($select_name->rowCount() > 0) {
            $message[] = 'Username already taken!';
        } else {
            $update_name = $conn->prepare("UPDATE `admin` SET name = ? WHERE id = ?");
            $update_name->execute([$name, $admin_id]);
        }
    }


    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
    if (!empty($email) && $email != $fetch_profile['email']) {
        $select_email = $conn->prepare("SELECT * FROM `admin` WHERE email = ?");
        $select_email->execute([$email]);
        if ($select_email->rowCount() > 0) {
            $message[] = 'Email already taken!';
        } else {
            $update_email = $conn->prepare("UPDATE `admin` SET email = ? WHERE id = ?");
            $update_email->execute([$email, $admin_id]);
        }
    }


    $old_image = $_POST['old_image'];
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../image/' . $image;

    if (!empty($image)) {
        $image = filter_var($image, FILTER_SANITIZE_STRING);
        $update_image = $conn->prepare("UPDATE `admin` SET profile = ? WHERE id = ?");
        $update_image->execute([$image, $admin_id]);
        move_uploaded_file($image_tmp_name, $image_folder);
        if ($old_image != $image && $old_image != '') {
            unlink('../image/'.$old_image);
        }
    }


    $empty_pass = sha1('');
    $select_old_pass = $conn->prepare("SELECT password FROM `admin` WHERE id = ?");
    $select_old_pass->execute([$admin_id]);
    $fetch_prev_pass = $select_old_pass->fetch(PDO::FETCH_ASSOC);
    $prev_pass = $fetch_prev_pass['password'];

    $old_pass = sha1($_POST['old_pass']);
    $new_pass = sha1($_POST['new_pass']);
    $confirm_pass = sha1($_POST['confirm_pass']);

    if ($old_pass != $empty_pass) {
        if ($old_pass != $prev_pass) {
            $message[] = 'Old password not matched';
        } elseif ($new_pass != $confirm_pass) {
            $message[] = 'Confirm password not matched';
        } else {
            if ($new_pass != $empty_pass) {
                $update_pass = $conn->prepare("UPDATE `admin` SET password = ? WHERE id = ?");
                $update_pass->execute([$confirm_pass, $admin_id]);
                $message[] = 'Password updated successfully';
            } else {
                $message[] = 'Please enter a new password';
            }
        }
    }

    $message[] = 'Profile updated!';
}

$_SESSION['message'] = $message;
header('Location: ../Views/admin_accounts.php');
exit();
?>
