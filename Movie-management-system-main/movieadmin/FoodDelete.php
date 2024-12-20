<?php
// Check if the food_id is set and not empty
if(isset($_GET['food_id'])) {
    
    include '../connection.php'; 
   
    $food_id = $_GET['food_id'];

    // Get the filename of the food image
    $findsql = "SELECT * FROM foods WHERE FoodID='$food_id'";
    $result = $conn->query($findsql);
    $row = mysqli_fetch_array($result);
    $filename = $row['FoodImage'];

    // Delete the image file from the folder
    unlink("foodimages/".$filename);

    
    $sql = "DELETE FROM foods WHERE FoodID ='$food_id'";
    
    if ($conn->query($sql) === TRUE) {
        
        echo "<script>alert('Food deleted successfully');</script>";
       
        echo "<script>setTimeout(function(){ window.location.href = 'FoodShow.php'; }, 1000);</script>";
    } else {
       
        echo "<script>alert('Error deleting food: " . $conn->error . "');</script>";
        
        echo "<script>window.location.href = 'FoodShow.php';</script>";
    }
}
?>
