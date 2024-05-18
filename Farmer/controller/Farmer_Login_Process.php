<?php
session_start(); 

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    include("../model/connection.php"); 

    $username = isset($_POST['username']) ? $_POST['username'] : "";
    $password = isset($_POST['password']) ? $_POST['password'] : "";
    $error = "";

    if(empty($username) || empty($password)) {
        $error = "Please enter both username and password";
    } else {
     
        $query = "SELECT * FROM users WHERE username = ?";
        $stmt = mysqli_prepare($con, $query);
        
        if($stmt) {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            
            if($result) {
               
                if(mysqli_num_rows($result) == 1) {
             
                    $row = mysqli_fetch_assoc($result);
              
                    if(password_verify($password, $row['Password'])) {
                        
                        $_SESSION['username'] = $username;
                    
                        header("Location: ../view/dashboard.php");
                        exit;
                    } else {
                        $error = "Invalid username or password";
                    }
                } else {
                    $error = "Invalid username or password";
                }
            } else {
            
                $error = "An error occurred while fetching user data";
            }
        } else {
     
            $error = "An error occurred while preparing the statement";
        }
    }

    echo $error;
}
?>
