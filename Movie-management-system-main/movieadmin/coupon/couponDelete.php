<?php
include '../../connection/connection.php';

if (isset($_GET['id'])) {
    $coupon_id = $_GET['id'];

    $sql = "DELETE FROM Coupon WHERE coupon_id = $coupon_id";

    if ($conn->query($sql) === TRUE) {
        echo "<div class='message success'>Coupon deleted successfully!</div>";
    } else {
        echo "<div class='message error'>Error: " . $conn->error . "</div>";
    }

    $conn->close();
}

header('Location: couponShow.php');
exit();
?>
