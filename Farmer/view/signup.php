<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <link rel="stylesheet" type="text/css" href="./css/style2.css">
    <style>
        .error-message {
            color: red;
            font-size: 14px;
        }

        .success-message {
            color: green;
            font-size: 14px;
        }

        .farmer-code-input {
            display: none;
        }
    </style>
<script>
    function showAdminCodeInput() {
        var userType = document.getElementById("user-type").value;
        var farmerCodeInput = document.getElementById("farmer-code-input");

        if (userType === "farmer") {
            farmerCodeInput.style.display = "block";
        } else {
            farmerCodeInput.style.display = "none";
        }
    }

    function validateForm() {
        var username = document.getElementById("username").value;
        var email = document.getElementById("email").value;
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("confirm-password").value;
      
        var profilePicture = document.getElementById("profile-picture").value;
        var valid = true;

        var usernameError = document.getElementById("username-error");
        var emailError = document.getElementById("email-error");
        var passwordError = document.getElementById("password-error");
        var confirmPasswordError = document.getElementById("confirm-password-error");

        var profilePictureError = document.getElementById("profile-picture-error");

        usernameError.innerHTML = "";
        emailError.innerHTML = "";
        passwordError.innerHTML = "";
        confirmPasswordError.innerHTML = "";

        profilePictureError.innerHTML = "";

        if (username.trim() === "") {
            usernameError.innerHTML = "Please enter your username";
            valid = false;
        }

        if (email.trim() === "") {
            emailError.innerHTML = "Please enter your email";
            valid = false;
        } else if (!/^\S+@\S+\.\S+$/.test(email)) {
            emailError.innerHTML = "Please enter a valid email address";
            valid = false;
        }

        if (password.trim() === "") {
            passwordError.innerHTML = "Please enter your password";
            valid = false;
        } else if (!/(?=.*[A-Z])(?=.*[!@#$%^&*])(?=.{8,})/.test(password)) {
            passwordError.innerHTML = "Password must contain at least one capital letter, one special character, and be at least 8 characters long";
            valid = false;
        }

        if (confirmPassword.trim() === "") {
            confirmPasswordError.innerHTML = "Please confirm your password";
            valid = false;
        } else if (password !== confirmPassword) {
            confirmPasswordError.innerHTML = "Passwords do not match";
            valid = false;
        }


        if (profilePicture.trim() === "") {
            profilePictureError.innerHTML = "Please select your profile picture";
            valid = false;
        }

        return valid;
    }
</script>

</head>
<body>
    <div class="container">
        <div class="signup-card">
            <h2>Sign Up</h2>          
            <form action="../controller/signup_process.php" method="post" enctype="multipart/form-data" onsubmit="return validateForm();">
                <div class="form-group">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username">
                    <div id="username-error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email">
                    <div id="email-error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password">
                    <div id="password-error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="confirm-password">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirm-password">
                    <div id="confirm-password-error" class="error-message"></div>
                </div>
                <div class="form-group">
                    <label for="user-type">User Type</label>
                    <select id="user-type" name="user-type" >
                    <option value="farmer">Farmer</option>
                </select>

                </div>
                <div class="form-group">
                    <label for="profile-picture">Profile Picture</label>
                    <input type="file" id="profile-picture" name="profile-picture">
                    <div id="profile-picture-error" class="error-message"></div>
                </div>
                <button type="submit" name="submit">Sign Up</button>
            </form>
            <div class="login-link">
                <p>Already have an account? <a href="Farmer_Login.php">Log In</a></p>
            </div>
        </div>
    </div>
</body>
</html>
