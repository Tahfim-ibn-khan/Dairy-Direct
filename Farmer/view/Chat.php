<?php
include("../model/connection.php");
include("../controller/header2.php");
if(isset($_SESSION['username']) && !isset($_SESSION['alert_shown'])) {
    $username = $_SESSION['username'];
    echo "<script>alert('Welcome, $username!');</script>";
    $_SESSION['alert_shown'] = true;
}

// Check if form is submitted and message is set
if(isset($_POST['message']) && !empty($_POST['message'])) {
    // Get sender ID from session or some other source
    $sender_id = 1; // Example: You need to replace this with actual sender ID

    // Get receiver ID (if applicable), or set to 0 if it's a public chat
    $receiver_id = 0; // Example: Public chat

    // Sanitize the message
    $message = mysqli_real_escape_string($con, $_POST['message']);

    // Insert message into the database
    $query = "INSERT INTO chat (sender_id, receiver_id, message) VALUES ('$sender_id', '$receiver_id', '$message')";
    $result = mysqli_query($con, $query);

    if($result) {
        // Message inserted successfully
        echo "<script>alert('Message sent successfully!');</script>";
        // Optionally, you can redirect back to the dashboard or perform other actions
    } else {
        // Failed to insert message
        echo "<script>alert('Failed to send message. Please try again later.');</script>";
    }
    
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Chat Box</title>
    <link rel="stylesheet" type="text/css" href="./css/dashboard.css">
    <style>
        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .chatbox {
            width: 400px;
        }

        .card {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            background-color: #3339;
            margin-bottom: 20px;
        }

        .chat-messages {
            max-height: 300px;
            overflow-y: auto;
            border: 1px solid #ccc;
            padding: 10px;
            margin-bottom: 10px;
        }

        .chat-messages p {
            margin: 5px 0;
        }

        form {
            display: flex;
            margin-top: 10px;
        }

        input[type="text"] {
            flex: 1;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button {
            padding: 8px 15px;
            background-color: #007bff;
            color: black;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="chatbox card">
        <h2>Chat</h2>
        <div class="chat-messages">
                <?php
        // Initialize previous sender ID
        $prev_sender_id = null;

        // Fetch chat messages from the database
        $query = "SELECT * FROM chat";
        $result = mysqli_query($con, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                // Check if the sender ID has changed
                if ($prev_sender_id !== $row['sender_id']) {
                    // Display the username of the sender
                    echo "<p><strong>User " . $row['sender_id'] . ":</strong> " . $row['message'] . "</p>";
                    // Update previous sender ID
                    $prev_sender_id = $row['sender_id'];
                } else {
                    // If the sender ID remains the same, display only the message
                    echo "<p>" . $row['message'] . "</p>";
                }
            }
        } else {
            echo "<p>No messages yet.</p>";
        }
        ?>

                
            </div>
        <form method="post" action="">
            <input type="text" name="message" placeholder="Type your message...">
            <button type="submit">Send</button>
        </form>
    </div>
</div>

</body>
</html>


<?php
include "../controller/footer.php";
?>

