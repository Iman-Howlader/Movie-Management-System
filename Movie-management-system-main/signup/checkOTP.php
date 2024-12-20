<?php
session_start();
$email = $_GET['email'];
$user_type = $_GET['user_type'];

if (isset($_POST['submit'])) {
    $otpEntered = $_POST['otp'];
    if ($_SESSION['otp'] == $otpEntered ) {
        include '../connection.php'; // Include your database connection script

        // Update OTP based on user type
        if ($user_type === 'user') {
            $sql = "UPDATE tempusersignup SET OTP='valid' WHERE Email='$email'";
            if ($conn->query($sql) === TRUE) {
                echo "OTP updated successfully.";
            } else {
                echo "Error updating OTP: " . $conn->error;
            }
        } elseif ($user_type === 'admin') {
            $sql = "UPDATE tempadminsignup SET OTP='valid' WHERE Email='$email'";
            if ($conn->query($sql) === TRUE) {
                echo "OTP updated successfully.";
            } else {
                echo "Error updating OTP: " . $conn->error;
            }
        } elseif ($user_type === 'employee') {
            $sql = "UPDATE tempemployeesignup SET OTP='valid' WHERE Email='$email'";
            if ($conn->query($sql) === TRUE) {
                echo "OTP updated successfully.";
            } else {
                echo "Error updating OTP: " . $conn->error;
            }
        } else {
            echo "Invalid user type.";
        }

        $conn->close();
    } else {
        echo "Invalid OTP. Please try again.";
         // Update OTP based on user type
         if ($user_type === 'user') {
            $sql = "UPDATE tempusersignup SET OTP='invalid' WHERE Email='$email'";
            if ($conn->query($sql) === TRUE) {
                echo "OTP updated successfully.";
            } else {
                echo "Error updating OTP: " . $conn->error;
            }
        } elseif ($user_type === 'admin') {
            $sql = "UPDATE tempadminsignup SET OTP='invalid' WHERE Email='$email'";
            if ($conn->query($sql) === TRUE) {
                echo "OTP updated successfully.";
            } else {
                echo "Error updating OTP: " . $conn->error;
            }
        } elseif ($user_type === 'employee') {
            $sql = "UPDATE tempemployeesignup SET OTP='invalid' WHERE Email='$email'";
            if ($conn->query($sql) === TRUE) {
                echo "OTP updated successfully.";
            } else {
                echo "Error updating OTP: " . $conn->error;
            }
        } else {
            echo "Invalid user type.";
        }
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Verification</title>
    <style>
  /* Global styles */
  body {
    font-family: Arial, sans-serif;
    background-color: #f9f9f9;
  }

  /* Form styles */
  form {
    max-width: 300px;
    margin: 40px auto;
    padding: 20px;
    background-color: #fff;
    border: 1px solid #ddd;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  /* Label styles */
  label {
    display: block;
    margin-bottom: 10px;
  }

  /* Input styles */
  input[type="email"],
  input[type="text"] {
    width: 100%;
    height: 40px;
    margin-bottom: 20px;
    padding: 10px;
    border: 1px solid #ccc;
  }

  input[type="email"]:focus,
  input[type="text"]:focus {
    border-color: #aaa;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  /* Submit button styles */
  input[type="submit"] {
    width: 100%;
    height: 40px;
    background-color: #4CAF50;
    color: #fff;
    padding: 10px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
  }

  input[type="submit"]:hover {
    background-color: #3e8e41;
  }
</style>
</head>

<body>
    <form method="POST" action="">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value = "<?php echo $email  ?>" required readonly><br><br>
        <label for="otp">Enter OTP:</label>
        <input type="text" id="otp" name="otp" required><br><br>
        <input type="submit" name="submit" value="Submit OTP">
    </form>
</body>

</html>
