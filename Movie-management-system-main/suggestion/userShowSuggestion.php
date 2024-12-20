<?php
session_start();
$user_email = $_SESSION['user_email'];

if (!empty($user_email)) {
    // Database connection settings
    ob_start();
    include '../connection/connection.php';
    ob_end_clean();

    // Fetch user's comments from the database
    $stmt = $conn->prepare("SELECT comment, submission_time FROM suggestion WHERE user_email = ?");
    $stmt->bind_param("s", $user_email);
    $stmt->execute();
    $result = $stmt->get_result();

    // Display user's comments
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Suggestions</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #f4f4f4;
                margin: 0;
                padding: 0;
            }
            .container {
                max-width: 600px;
                margin: 50px auto;
                padding: 20px;
                background-color: #fff;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }
            h2 {
                text-align: center;
                margin-bottom: 20px;
            }
            .comment {
                border-bottom: 1px solid #ccc;
                padding-bottom: 10px;
                margin-bottom: 10px;
            }
            .comment p {
                margin: 0;
            }
            .comment .time {
                font-size: 12px;
                color: #666;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <h2>My Suggestions</h2>
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="comment">
                        <p><?php echo $row['comment']; ?></p>
                        <p class="time">Submitted on: <?php echo $row['submission_time']; ?></p>
                    </div>
                    <?php
                }
            } else {
                echo "<p>No suggestions found.</p>";
            }
            ?>
        </div>
    </body>
    </html>
    <?php

    // Close connections
    $stmt->close();
    $conn->close();
} else {
    header('location:../login/login.php');
}
?>
