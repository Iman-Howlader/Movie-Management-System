<?php
include '../connection.php';
session_start();
$user_email = $_SESSION['user_email'];
if (!empty($user_email)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>bKash Payment</title>
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


        .bkash-container {
            background-color: #e6007e;
            color: #fff;
            width: 300px;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            text-align: center;
        }


        .bkash-header {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 20px;
        }


        .bkash-header img {
            height: 30px;
            margin-right: 10px;
        }


        .bkash-body {
            margin-bottom: 20px;
        }


        .merchant-info p {
            margin: 5px 0;
        }


        .account-info {
            margin: 15px 0;
        }


        .account-info label {
            display: block;
            margin-bottom: 5px;
        }


        .account-info input {
            width: 100%;
            padding: 8px;
            border: none;
            border-radius: 5px;
        }


        .terms {
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 15px 0;
        }


        .terms input {
            margin-right: 10px;
        }


        .terms a {
            color: #fff;
            text-decoration: underline;
        }


        .bkash-footer {
            display: flex;
            justify-content: space-between;
        }


        .bkash-footer button {
            background-color: #fff;
            color: #e6007e;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }


        .bkash-footer button:hover {
            background-color: #ccc;
        }


        .footer-text {
            margin-top: 20px;
            font-size: 12px;
        }
    </style>
</head>
<body>
    <div class="bkash-container">
        <div class="bkash-header">
            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/89/BKash_Logo_2022.png/220px-BKash_Logo_2022.png" alt="bKash Logo">
            <span>Payment</span>
        </div>
        <div class="bkash-body">
            <div class="merchant-info">
                <p>Merchant: Irfan Shaha Mayeen</p>
                <p>Invoice no: 1559040913</p>
                <?php
              
               
                $total_amount =$_GET['total_amount'];
                echo "<p>Amount: BDT ".$total_amount."</p>";
               ?>
            </div>
            <div class="account-info">
                <label for="account-number">Your bKash account number</label>
                <input type="text" id="account-number" name="account-number" placeholder="01700000001">
            </div>
            <div class="terms">
                <input type="checkbox" id="terms" name="terms">
                <label for="terms">I agree to the <a href="#">terms and conditions</a></label>
            </div>
        </div>
        <div class="bkash-footer">
    <form action="successfull.php" method="get">
        <button type="submit" class="proceed-btn">PROCEED</button>
    </form>
    <form action="cart.php.php" method="get">
        <button type="submit" class="close-btn">CLOSE</button>
    </form>
</div>
        <p class="footer-text">© 16247</p>
    </div>
    <?php  }else{
  header('location:../login/login.php');
} ?>
</body>
</html>



