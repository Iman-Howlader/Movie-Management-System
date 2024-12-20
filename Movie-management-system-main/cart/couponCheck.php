

<?php
include '../connection.php';
session_start();

$user_email = $_SESSION['user_email'];
$couponCode = $_GET['coupon_code']; // Assuming you get the coupon code via GET method
$totalPrice = $_GET['totalPrice']; // Assuming total price is sent via GET method

// Initial discount
$discount = 0;

// Check if the coupon exists and is valid
$couponSql = "SELECT * FROM coupon WHERE coupon_code = '$couponCode' AND status = TRUE";
$couponResult = $conn->query($couponSql);

if ($couponResult->num_rows > 0) {
    $coupon = $couponResult->fetch_assoc();

    // Check if the coupon is expired
    $currentDate = date('Y-m-d');
    if ($currentDate > $coupon['expiry_date']) {
        echo "<script>alert('Coupon has expired.'); window.location.href = 'cart.php';</script>";
        exit();
    }

    // Check the minimum order requirement
    if ($totalPrice < $coupon['minimum_order']) {
        echo "<script>alert('Total price does not meet the minimum order requirement.'); window.location.href = 'cart.php';</script>";
        exit();
    }

    // Check overall usage limit
    $usageLimitSql = "SELECT COUNT(*) AS usage_count FROM CouponHistory WHERE coupon_id = " . $coupon['coupon_id'] ;
    $usageLimitResult = $conn->query($usageLimitSql);
    $usageLimitRow = $usageLimitResult->fetch_assoc();

    if ($usageLimitRow['usage_count'] >= $coupon['usage_limit']) {
        echo "<script>alert('Coupon usage limit has been reached.'); window.location.href = 'cart.php';</script>";
        exit();
    }

    // Check user-specific usage limit
    $userLimitSql = "SELECT COUNT(*) AS user_usage_count FROM CouponHistory WHERE coupon_id = " . $coupon['coupon_id'] . " AND userEmail = '$user_email'";
    $userLimitResult = $conn->query($userLimitSql);
    $userLimitRow = $userLimitResult->fetch_assoc();

    if ($userLimitRow['user_usage_count'] >= $coupon['user_limit']) {
        echo "<script>alert('You have already used this coupon the maximum number of times.'); window.location.href = 'cart.php';</script>";
        exit();
    }

    // Calculate the discount
    $discount = min($totalPrice * ($coupon['percentage'] / 100)+$totalPrice, $coupon['max_discount']);

    // Log the coupon usage in CouponHistory
    $insertHistorySql = "INSERT INTO CouponHistory (userEmail, coupon_id,use_status) VALUES ('$user_email', " . $coupon['coupon_id'] . ",'NO')";
    $conn->query($insertHistorySql);

    // Redirect to cartAfterCoupon.php with total price and discount
    header("Location: cartAfterCoupon.php?total_price=$totalPrice&discount_price=$discount");
    exit();
} else {
    echo "<script>alert('Invalid coupon code.'); window.location.href = 'cart.php';</script>";
    exit();
}
?>
