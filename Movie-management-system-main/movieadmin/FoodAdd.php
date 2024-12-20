<?php
include '../connection.php'; // Assuming this file includes database connection details
include 'FoodAdd.html';

// Retrieve food details from the form
if (isset($_POST['submit'])){
    $food_name = $_POST['food_name'];
    $food_price = $_POST['food_price'];
    $food_category = $_POST['food_category'];
    $availability = $_POST['availability'];

    // Set the value of $food_availability based on the selected availability
    $food_availability = ($availability == 'available') ? 1 : 0;

    // Handle image upload
    $food_image = $_FILES['food_image']['name'];
    $food_image_temp = $_FILES['food_image']['tmp_name'];
    $food_image_path = "foodimages/" . $food_image;

    // Move uploaded image to the 'foodimages' folder
    if (move_uploaded_file($food_image_temp, $food_image_path)) {
        echo "Image uploaded successfully.";
    } else {
        echo "Failed to upload image.";
    }

    // Insert food details into the database, including the image filename
    $sql = "INSERT INTO foods (FoodName, FoodPrice, FoodCategory, FoodStatus, FoodImage) 
            VALUES ('$food_name', '$food_price', '$food_category', '$food_availability', '$food_image')";

    if ($conn->query($sql) === TRUE) {
        echo "New food item added successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
