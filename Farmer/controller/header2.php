<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard with Sidebar</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: red; /* Changed to red */
            padding-top: 20px;
            border-right: 2px solid #ccc;
        }
        .sidebar .logo {
            text-align: center;
            margin-bottom: 20px;
        }
        .sidebar .logo img {
            width: 200px;
            height: 200px;
            border-radius: 50%;
            border: 4px solid #fff;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.3);
            transform: rotate(-15deg);
            transition: transform 0.3s;
        }
        .sidebar .logo img:hover {
            transform: rotate(-30deg);
        }
        .sidebar a {
            padding: 10px 76px;
            text-decoration: none;
            font-size: 18px;
            color: white;
            display: block;
            margin-bottom: 16px;
            transition: background-color 0.3s;
            margin-top: 19px;
        }
        .sidebar a:hover {
            background-color: #555;
        }
        .footer {
            background-color: #333;
            color: white;
            padding: 20px;
            text-align: center;
            margin-top: auto;
        }
        .footer p {
            margin: 0;
        }
    </style>
</head>
<body>

<div class="sidebar">
    <div class="logo">
        <img src="../view/images/Farmer.png" alt="Logo">
    </div>
    <a href="../view/dashboard.php" class="card">Home</a>
    <a href="../view/Chat.php" class="card">ChatBox</a>
    <a href="../view/Email.php" class="card">Email Integration</a>
    <a href="../view/Status.php" class="card">Over All Status</a>
    <a href="../view/Product.php" class="card">Add Product</a>
    <a href="../view/logout.php" class="card">Logout</a>
</div>

<div class="content">
  
</div>

</body>
</html>
