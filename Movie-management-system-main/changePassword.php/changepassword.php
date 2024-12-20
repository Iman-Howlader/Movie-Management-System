<?php


// Include database connection
ob_start();
include '../connection/connection.php';
ob_end_clean();

// Retrieve user type and email from URL
$user_type = "user";                // $_GET['user_type'];
$email ="mdi52660@gmail.com";                     //$_GET['email'];

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Retrieve form data
    $prev_password = $_POST['prev_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    // Query to fetch previous password
    $query = "SELECT Password FROM ";
    switch ($user_type) {
        case 'user':
            $query .= "usersignup WHERE Email = '$email'";
            break;
        case 'admin':
            $query .= "adminsignup WHERE Email = '$email'";
            break;
        case 'employe':
            $query .= "employeesignup WHERE Email = '$email'";
            break;
        default:
            // Invalid user type
            exit('Invalid user type');
    }

    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $stored_password = $row['Password'];

    // Check if previous password matches
    if ($prev_password != $stored_password) {
        echo "<script>alert('Previous password is incorrect');</script>";
    } elseif ($new_password != $confirm_password) {
        echo "<script>alert('New password and confirm password do not match');</script>";
    }

    elseif($prev_password === $new_password ){
        echo "<script>alert('You enter previous password');</script>";
    }
    
    
    
    else {
        // Update password
        $update_query = "UPDATE ";
    switch ($user_type) {
        case 'user':
            $update_query .= "usersignup SET Password = '$new_password' WHERE Email = '$email'";
            break;
        case 'admins':
            $update_query .= "adminsignup SET Password = '$new_password' WHERE Email = '$email'";
            break;
        case 'employe':
            $update_query .= "employeesignup SET Password = '$new_password' WHERE Email = '$email'";
            break;
    }
    

    $conn->query($update_query);

    // Redirect to some page after successful password change
    echo "<script>alert('Password changed successfully');</script>";

    // Redirect to login page after a short delay
    echo "<script>
            setTimeout(function() {
                window.location.href = '../login/login.php';
            }, 2000); // Redirect after 2 seconds
          </script>";
    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Change Password</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            padding: 20px;
            width: 300px;
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
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="password"] {
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            padding: 10px 20px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .error-message {
            color: red;
            margin-bottom: 15px;
        }
    </style>
</head>

<body>
<div class="container">
        <h2>Change Password</h2>
        <form method="post" action="">
            <label for="prev_password">Previous Password:</label>
            <input type="password" id="prev_password" name="prev_password" required>

            <label for="new_password">New Password:</label>
            <input type="password" id="new_password" name="new_password" required>

            <label for="confirm_password">Confirm Password:</label>
            <input type="password" id="confirm_password" name="confirm_password" required>

            <input type="submit" value="Change Password">
        </form>
       
    </div>
</body>

</html>
