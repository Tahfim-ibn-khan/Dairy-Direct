<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>farmer Login</title>
    <link rel="stylesheet" type="text/css" href="./css/style1.css">
    <style>
        .error-message {
            color: red;
            font-size: 14px;
        }
    </style>
    <script>
        function validateForm() {
            var username = document.getElementById("username").value;
            var password = document.getElementById("password").value;
            var valid = true;

            
            if (username.trim() === "") {
                document.getElementById("username-error").innerHTML = "Please enter your username";
                valid = false;
            } else {
                document.getElementById("username-error").innerHTML = "";
            }

            
            if (password.trim() === "") {
                document.getElementById("password-error").innerHTML = "Please enter your password";
                valid = false;
            } else {
                document.getElementById("password-error").innerHTML = "";
            }

            return valid; 
        }
    </script>
</head>
<body>
    <div class="container">
        <div class="login-card">
            <h2>farmer Login</h2>
            <form action="../controller/Farmer_Login_Process.php" method="post" onsubmit="return validateForm()"> <!-- Form submits to the processing file -->
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" >
                    <div id="username-error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" >
                    <div id="password-error" class="error-message"></div>
                </div>
                <center><button type="submit" name="submit">Login</button></center>
            </form>
            <div class="signup-link">
                <p>Don't have an account? <a href="signup.php">Sign Up</a></p>
            </div>
        </div>
    </div>
</body>
</html>
