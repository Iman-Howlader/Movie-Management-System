<?php
include '../../connection/connection.php';

if (isset($_GET['id'])) {
    $coupon_id = $_GET['id'];

    $sql = "SELECT * FROM coupon WHERE coupon_id = $coupon_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "Coupon not found";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $coupon_id = $_POST['coupon_id'];
    $coupon_code = $_POST['coupon_code'];
    $percentage = $_POST['percentage'];
    $max_discount = $_POST['max_discount'];
    $usage_limit =$_POST['usage_limit'];
    $expiry_date = $_POST['expiry_date'];
    $description = $_POST['description'];
    $minimum_order = $_POST['minimum_order'];
    $userlimit = $_POST['userlimit'];

    $sql = "UPDATE coupon SET 
                coupon_code='$coupon_code', 
                percentage=$percentage, 
                max_discount=$max_discount,
                usage_limit =$usage_limit ,
                expiry_date='$expiry_date', 
                user_limit ='$userlimit',
                description='$description', 
                minimum_order=$minimum_order 
            WHERE coupon_id=$coupon_id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='message success'>Coupon updated successfully!</div>";
    } else {
        echo "<div class='message error'>Error: " . $conn->error . "</div>";
    }
    header('Location: couponShow.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Coupon</title>
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
            background: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            margin-bottom: 20px;
            font-size: 24px;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input, .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-group textarea {
            resize: vertical;
        }
        .form-group button {
            padding: 10px 15px;
            background: #28a745;
            border: none;
            color: #fff;
            cursor: pointer;
            border-radius: 4px;
        }
        .form-group button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Update Coupon</h2>
        <form action="" method="POST">
            <input type="hidden" name="coupon_id" value="<?php echo $row['coupon_id']; ?>">
            <div class="form-group">
                <label for="coupon_code">Coupon Code:</label>
                <input type="text" id="coupon_code" name="coupon_code" value="<?php echo $row['coupon_code']; ?>" required>
            </div>
            <div class="form-group">
                <label for="percentage">Discount Percentage:</label>
                <input type="number" step="0.01" id="percentage" name="percentage" value="<?php echo $row['percentage']; ?>" required>
            </div>
            <div class="form-group">
                <label for="max_discount">Max Discount:</label>
                <input type="number" step="0.01" id="max_discount" name="max_discount" value="<?php echo $row['max_discount']; ?>" required>
            </div>
            <div class="form-group">
                <label for="usage_limit">Usage Limit</label>
                <input type="number" id="usage_limit" name="usage_limit" required>
            </div>
            <div class="form-group">
                <label for="expiry_date">Expiry Date:</label>
                <input type="date" id="expiry_date" name="expiry_date" value="<?php echo $row['expiry_date']; ?>" required>
            </div>
            <div class="form-group">
                <label for="userlimit">User uses Limit:</label>
                <input type="number" name="userlimit" value="<?php echo $row['user_limit']; ?>" >
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description"><?php echo $row['description']; ?></textarea>
            </div>
            <div class="form-group">
                <label for="minimum_order">Minimum Order Amount:</label>
                <input type="number" step="0.01" id="minimum_order" name="minimum_order" value="<?php echo $row['minimum_order']; ?>" required>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Update Coupon</button>
            </div>
        </form>
    </div>
</body>
</html>
