<?php
include("../model/connection.php");
include("../controller/header2.php");

if(isset($_SESSION['username']) && !isset($_SESSION['alert_shown'])) {
    $username = $_SESSION['username'];
    echo "<script>alert('Welcome, $username!');</script>";
    $_SESSION['alert_shown'] = true;
}
?>
<?php
include('smtp/PHPMailerAutoload.php');

function sendEmail($sender_email, $receiver_email, $subject, $message) {
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';  // Specify SMTP server
        $mail->SMTPAuth = true;
        $mail->IsHTML(true);
        $mail->CharSet = 'UTF-8';
        $mail->Username = 'neamulrahim@gmail.com'; // SMTP username
        $mail->Password = 'edicyopxslkjcwap'; // SMTP password
        $mail->SMTPSecure = 'tls'; // Enable TLS encryption
        $mail->Port = 587; // TCP port to connect to
        $mail->setFrom($sender_email);
        $mail->addAddress($receiver_email);
        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();
        $mail->SMTPOptions=array('ssl'=>array(
            'verify_peer'=>false,
            'verify_peer_name'=>false,
            'allow_self_signed'=>false
        ));
        return true;
    } catch (Exception $e) {
        return false;
    }
}

if(isset($_SESSION['username']) && !isset($_SESSION['alert_shown'])) {
    $username = $_SESSION['username'];
    echo "<script>alert('Welcome, $username!');</script>";
    $_SESSION['alert_shown'] = true;
}

// Check if form is submitted and all fields are set
if(isset($_POST['sender_email'], $_POST['receiver_email'], $_POST['subject'], $_POST['message'])) {
    // Sanitize form inputs
    $sender_email = $_POST['sender_email'];
    $receiver_email = $_POST['receiver_email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert email into the database
    $query = "INSERT INTO emails (sender_email, receiver_email, subject, message) 
              VALUES ('$sender_email', '$receiver_email', '$subject', '$message')";
    $result = mysqli_query($con, $query);

    if($result) {
        // Email sent successfully
        if(sendEmail($sender_email, $receiver_email, $subject, $message)) {
            echo "<script>alert('Email sent successfully!');</script>";
        } else {
            echo "<script>alert('Failed to send email. Please try again later.');</script>";
        }
        // Optionally, you can redirect back to the dashboard or perform other actions
    } else {
        // Failed to insert into database
        echo "<script>alert('Failed to send email. Please try again later.');</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Email Integration</title>
    <link rel="stylesheet" type="text/css" href="./css/dashboard.css">
    <style>
        /* Additional styles for email integration */
        .email-card {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 407px;
            height: 405px;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .email-form input,
        .email-form textarea {
            width: calc(100% - 20px);
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            border: 1px solid #ccc;
            box-sizing: border-box;
        }

        .email-form textarea {
            height: 80px;
        }

        .email-form button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .email-form button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
<div class="header">
    <center><h1>Email Integration</h1>
</div>
<div class="email-card">
    <h2>Send Email</h2>
    <form class="email-form" method="post" action="">
        <input type="email" name="sender_email" placeholder="Sender's Email" required>
        <input type="email" name="receiver_email" placeholder="Recipient's Email" required>
        <input type="text" name="subject" placeholder="Subject" required>
        <textarea name="message" placeholder="Message" required></textarea>
        <button type="submit">Send</button>
    </form>
</div>
</body>
</html>
