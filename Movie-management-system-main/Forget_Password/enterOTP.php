<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['otp'])) {
        $email = htmlspecialchars($_POST['email']);
        $user_type = htmlspecialchars($_POST['user_type']);
        $otpEntered = htmlspecialchars($_POST['otp']);

        if ($_SESSION['otpforpassword'] === $otpEntered) {
            echo "<script>alert('OTP matched Successfully');</script>";
            header("Location: passwordSet.php?email=" . urlencode($email) . "&user_type=" . urlencode($user_type));
            exit();
        } else {
            echo "<script>alert('OTP does not match');</script>";
            header("Location: checkOTP.php?email=" . urlencode($email) . "&user_type=" . urlencode($user_type));
            exit();
        }
    } else {
        echo "<script>alert('Form not submitted');</script>";
        header("Location: ../login/login.php");
        exit();
    }
} else {
    $email = isset($_GET['email']) ? urldecode(htmlspecialchars($_GET['email'])) : '';
    $user_type = isset($_GET['user_type']) ? htmlspecialchars($_GET['user_type']) : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Enter OTP</title>
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
        input[type="text"], input[type="hidden"] {
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
    <h2>Enter OTP</h2>
    <form action="checkOTP.php" method="POST">
        <input type="hidden" name="email" value="<?php echo htmlspecialchars($email); ?>">
        <input type="hidden" name="user_type" value="<?php echo htmlspecialchars($user_type); ?>">
        <input type="text" name="otp" placeholder="Enter OTP" required>
        <button type="submit" name="submit">Validate OTP</button>
    </form>
    <div class="message">
        Enter the OTP sent to your email address.
    </div>
</div>

</body>
</html>
<?php
}
?>
