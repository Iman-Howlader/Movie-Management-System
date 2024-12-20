<?php
// Include the database connection file
ob_start();
include '../connection/connection.php';
ob_end_clean();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $user_type = $_POST['user_type'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match');</script>";
    } else {
        // Hash the new password before storing it in the database
       // $hashed_password = password_hash($password, PASSWORD_DEFAULT);

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

        // Update the password in the database
        $query = "UPDATE $table SET Password = '$password' WHERE Email = '$email'";
        if (mysqli_query($conn, $query)) {
            echo "<script>alert('Password has been reset successfully');</script>";
            echo "<script> window.location.href = '../login/login.php' </script>";

            // Optionally, redirect to a login page or another page
            // header("Location: login.php");
            // exit;
        } else {
            echo "<script>alert('Failed to reset password')</>";
           echo "<script> window.location.href = 'forgetPassword.php'</script>";

            
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
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
        input[type="password"], input[type="hidden"] {
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
    <h2>Reset Password</h2>
    <form action="" method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($_GET['email']); ?>">
        <input type="hidden" name="user_type" value="<?php echo htmlspecialchars($_GET['user_type']); ?>">
        <input type="password" name="password" placeholder="Enter new password" required>
        <input type="password" name="confirm_password" placeholder="Confirm new password" required>
        <button type="submit">Reset Password</button>
    </form>
</div>

</body>
</html>
