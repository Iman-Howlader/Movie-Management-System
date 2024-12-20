
<?php
session_start();
$admin_email = $_SESSION['admin_email'];

if (!empty($admin_email)) {
?>

<?php



// Database connection settings
ob_start();
include '../connection/connection.php';
ob_end_clean();

// Fetch all suggestions from the database
$stmt = $conn->prepare("SELECT user_email, comment, submission_time FROM suggestion ORDER BY submission_time DESC");
$stmt->execute();
$result = $stmt->get_result();

// Display all suggestions
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Suggestions</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        .suggestion {
            border-bottom: 1px solid #ccc;
            padding-bottom: 10px;
            margin-bottom: 10px;
        }
        .suggestion p {
            margin: 0;
        }
        .suggestion .user {
            font-weight: bold;
            color: #333;
        }
        .suggestion .time {
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>All Suggestions</h2>
        <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                ?>
                <div class="suggestion">
                    <p class="user">User Email: <?php echo $row['user_email']; ?></p>
                    <p>Comment: <?php echo $row['comment']; ?></p>
                    <p class="time">Submitted on: <?php echo $row['submission_time']; ?></p>
                </div>
                <?php
            }
        } else {
            echo "<p>No suggestions found.</p>";
        }
        ?>
    </div>
    <?php
} else {
    header('location:../login/login.php');
}
?>

</body>
</html>

