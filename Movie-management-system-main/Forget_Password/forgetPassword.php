<?php
// Include the database connection file
ob_start();
include '../connection/connection.php';
ob_end_clean();
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];

    // Determine the table name based on user type
    $table = '';
    switch ($user_type) {
        case 'user':
            $table = 'usersignup';
            break;
        case 'admin':
            $table = 'adminsignup';
            break;
        case 'employee':
            $table = 'employeesignup';
            break;
        default:
            echo "<script>alert('Invalid user type');</script>";
            exit;
    }

    // Query to check if the email exists in the selected table
    $query = "SELECT * FROM $table WHERE Email = '$email'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        // Email not found
        echo "<script>alert('Email not found in the database');</script>";
    } else {
        // Email found, redirect to sendOTP.php
        header("Location: sendOTP.php?email=$email&user_type=$user_type");
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            width: 300px;
            text-align: center;
        }
        h2 {
            margin-bottom: 20px;
        }
        input[type="email"], select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            width: 100%;
        }
        button:hover {
            background-color: #45a049;
        }
        .message {
            margin-top: 20px;
            color: #888;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Forgot Password</h2>
    <form action="forgetPassword.php" method="POST">
        <input type="email" name="email" placeholder="Enter your email" required>
        <select name="user_type" required>
            <option value="">Select user type</option>
            <option value="user">User</option>
            <option value="admin">Admin</option>
            <option value="employee">Employee</option>
        </select>
        <button type="submit">Send Reset Link</button>
    </form>
    <div class="message">
        Enter your email address and select your user type, and we'll send you a link to reset your password.
    </div>
</div>

</body>
</html>
