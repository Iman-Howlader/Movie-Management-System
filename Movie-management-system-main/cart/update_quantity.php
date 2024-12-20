<?php
include '../connection.php';

// Check if foodID and quantity are set in the POST request
if(isset($_POST['foodID']) && isset($_POST['quantity'])) {
    $foodID = $_POST['foodID'];
    $quantity = $_POST['quantity'];
    
    // Update the quantity for the specified foodID in the database
    $updateSql = "UPDATE foodbookings SET Quantity = $quantity WHERE FoodID = $foodID";
    if ($conn->query($updateSql) === TRUE) {
        // Quantity updated successfully
        echo "Quantity updated for FoodID $foodID";
    } else {
        // Error updating record
        echo "Error updating record: " . $conn->error;
    }
} else {
    // If foodID or quantity are not set in the POST request
    echo "FoodID or quantity not received";
}
?>