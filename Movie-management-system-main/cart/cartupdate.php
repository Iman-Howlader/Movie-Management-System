<?php
include '../connection.php';

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve food IDs and quantities from the form
    if(isset($_POST['quantity']) && is_array($_POST['quantity'])) {
        $quantities = $_POST['quantity'];
        foreach($quantities as $foodID => $quantity) {
            // Update the quantity for the current food item in the database
            $updateSql = "UPDATE foodbookings SET Quantity = $quantity WHERE FoodID = $foodID";
            if ($conn->query($updateSql) === TRUE) {
                // Quantity updated successfully
                echo "Quantity updated for FoodID $foodID<br>";
                echo "Quantity is here :$quantity<br>";
            } else {
                echo "Error updating record: " . $conn->error . "<br>";
            }
        }
        // Once all updates are done, display confirmation message
        echo "Order confirmed";
    } else {
        // If quantities array is not set or not an array
        echo "No quantities received";
    }
} else {
    // If the form is not submitted via POST method, redirect to cart.php or show an error message
    header("Location: cart.php");
    exit();
}
?>
