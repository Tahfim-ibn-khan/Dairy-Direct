<?php

$errors = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("../model/connection.php");

    function cleanInput($data) {
        global $con;
        $data = mysqli_real_escape_string($con, $data);
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    
    $username = cleanInput($_POST['username']);
    $email = cleanInput($_POST['email']);
    $password = cleanInput($_POST['password']);
    $confirmPassword = cleanInput($_POST['confirm-password']);
    $userType = cleanInput($_POST['user-type']);

    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    if (empty($username) || empty($email) || empty($password) || empty($confirmPassword)) {
        $errors[] = "Please fill in all fields.";
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format.";
    } else if ($password !== $confirmPassword) {
        $errors[] = "Passwords do not match.";
    } else {
        
        $targetDir = "../view/images/";
        $profilePicture = basename($_FILES["profile-picture"]["name"]);
        $targetFilePath = $targetDir . $profilePicture;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        
        $uploadOk = 1;
        if (!getimagesize($_FILES["profile-picture"]["tmp_name"])) {
            $errors[] = "File is not an image.";
            $uploadOk = 0;
        }

        
        if (file_exists($targetFilePath)) {
            $errors[] = "File already exists.";
            $uploadOk = 0;
        }

        
        if ($_FILES["profile-picture"]["size"] > 5 * 1024 * 1024) {
            $errors[] = "File is too large.";
            $uploadOk = 0;
        }

        
        $allowedFormats = ["jpg", "jpeg", "png", "gif"];
        if (!in_array($fileType, $allowedFormats)) {
            $errors[] = "Only JPG, JPEG, PNG, and GIF files are allowed.";
            $uploadOk = 0;
        }

        if ($uploadOk == 0) {
            
            $errorMsg = implode("\n", $errors);
            header("Location: ../view/signup.php?error=$errorMsg");
            exit();
        } else {
            if (move_uploaded_file($_FILES["profile-picture"]["tmp_name"], $targetFilePath)) {
                $query = "INSERT INTO users (Username, Email, Password, UserType, ProfilePicture) 
                          VALUES ('$username', '$email', '$hashedPassword', '$userType', '$targetFilePath')";

                if (mysqli_query($con, $query)) {
                    header("Location: ../view/Farmer_Login.php");
                    echo '<script>alert("User registered successfully!");</script>';
                } else {
                  
                    $errorMsg = mysqli_error($con);
                    header("Location: ../view/signup.php?error=$errorMsg");
                    exit();
                }
            } else {

                $errorMsg = "Error uploading file.";
                header("Location: ../view/signup.php?error=$errorMsg");
                exit();
            }
        }
    }
} else {

    header("Location: ../view/signup.php");
    exit();
}
?>
