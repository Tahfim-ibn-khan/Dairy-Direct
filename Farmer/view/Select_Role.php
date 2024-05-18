<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Role</title>

    <link rel="stylesheet" type="text/css" href="./css/frontstyles.css">
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .card {
            width: 350px;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            overflow: hidden;
        }

        .card-header {
            background-color: #007bff;
            color: #fff;
            padding: 30px 0;
            text-align: center;
            border-radius: 20px 20px 0 0;
        }

        .card-body {
            padding: 40px 30px;
            text-align: center;
        }

        .card-body h2 {
            margin-bottom: 20px;
            color: #333;
        }

        .card-body p {
            color: #666;
        }

        .card-footer {
            background-color: #f8f9fa;
            padding: 20px 30px;
            text-align: center;
            border-radius: 0 0 20px 20px;
        }

        .btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="card">
        <div class="card-header">
            <h1>Welcome Farmer</h1>
        </div>
        <div class="card-body">
            <h2>Select For Management</h2>
            <form action="./view/farmer_Login.php" method="post">
                <fieldset>
                    <legend><h2>Hello..</h2></legend>
                    <p>Click below to proceed to login.</p>
                </fieldset>
                <input type="submit" class="btn" name="submit" value="Proceed">
            </form>
        </div>
        <div class="card-footer">
            <p> &copy; <?php echo date("Y"); ?></p>
        </div>
    </div>
</div>
</body>
</html>
