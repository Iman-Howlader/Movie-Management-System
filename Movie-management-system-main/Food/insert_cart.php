<?php
session_start();
$user_email = $_SESSION['user_email'];

if (!empty($user_email)) {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
include '../connection.php'; 

// Check if the POST data is set
if (isset($_POST['foodID']) && isset($_POST['quantity']) ) {
    // Sanitize and validate the input data
    $foodID = intval($_POST['foodID']);
    $quantity = intval($_POST['quantity']);
    $bookingTime = $_POST['bookingTime']; // No need to sanitize since it's a datetime string

    // Prepare and execute the SQL query to insert into the foodBookings table
    $sql =  "INSERT INTO foodBookings (FoodID,Email,Quantity, bookingTime,PaymentStatus) VALUES ('$foodID', '$user_email','$quantity', '$bookingTime','unpaid')";
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
      
      $conn->close();
} else {
    // Handle the case where POST data is not set
    echo "Error: POST data is not set";
}
?>

<?php  }else{
  header('location:../login/login.php');
} ?>

</body>
</html>

