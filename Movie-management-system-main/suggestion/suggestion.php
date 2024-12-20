<?php
session_start();
$user_email = $_SESSION['user_email'];

if (!empty($user_email)) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suggestion Form</title>
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
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 5px;
        }
        input[type="email"], textarea {
            margin-bottom: 10px;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        input[type="submit"] {
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Submit Your Suggestion</h2>
        <form method="POST" action="">
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" value =  "<?php echo $user_email ?>"  disabled>

            <label for="comment">Comment:</label>
            <textarea id="comment" name="comment" rows="4" required></textarea>

            <input type="submit" value="Submit">
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $user_email;
            $comment = $_POST['comment'];

            // Database connection settings
            ob_start();
             include'../connection/connection.php';
             ob_end_clean();

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO suggestion (user_email, comment, submission_time) VALUES (?, ?, NOW())");
            $stmt->bind_param("ss", $email, $comment);

            // Execute the statement
            if ($stmt->execute()) {
                echo "<p>Suggestion submitted successfully!</p>";
            } else {
                echo "<p>Error: " . $stmt->error . "</p>";
            }

            // Close connections
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>
    <?php  }else{
  header('location:../login/login.php');
} ?>
</body>
</html>
