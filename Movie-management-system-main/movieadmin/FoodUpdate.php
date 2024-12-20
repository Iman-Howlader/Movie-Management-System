<?php
include '../connection.php'; // Include database connection
include 'FoodUpdate.html';

if(isset($_POST['submit'])) {
    $food_id = $_POST['food_id'];
    
    // Retrieve form data
    $food_name = $_POST['food_name'];
    $food_price = $_POST['food_price'];
    $food_category = $_POST['food_category'];
    $availability = ($_POST['availability'] == 'available') ? 1 : 0; // Convert "available" or "not_available" to boolean value

    // Handle image upload
    $food_image = $_POST['current_image'];
    if(isset($_FILES['food_image']) && $_FILES['food_image']['error'] === UPLOAD_ERR_OK) {
        // Delete previous image
        $previous_image_path = "foodimages/" . $food_image;
        if(file_exists($previous_image_path)) {
            unlink($previous_image_path);
        }
        
        $food_image = $_FILES['food_image']['name'];
        $food_image_temp = $_FILES['food_image']['tmp_name'];
        $food_image_path = "foodimages/" . $food_image;

        // Move uploaded image to the 'foodimages' folder
        if (move_uploaded_file($food_image_temp, $food_image_path)) {
            echo "Image uploaded successfully.";
        } else {
            echo "Failed to upload image.";
        }
    }

    // Update food details in the database
    $sql1 = "UPDATE foods SET 
            FoodName = '$food_name',
            FoodPrice = '$food_price',
            FoodCategory = '$food_category',
            FoodStatus = '$availability',
            FoodImage = '$food_image'
            WHERE FoodID = '$food_id'";

    if ($conn->query($sql1) === TRUE) {
        echo "Food updated successfully";
    } else {
        echo "Error updating food: " . $conn->error;
    }
}

$conn->close();
?>
