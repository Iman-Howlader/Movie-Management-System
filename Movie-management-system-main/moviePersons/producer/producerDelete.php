<?php
// Check if the food_id is set and not empty
if(isset($_GET['ProducerID'])) {
    
    include '../../connection/connection.php'; 
   
    $producer_id = $_GET['ProducerID'];

    // Get the filename of the food image
    $findsql = "SELECT * FROM producer WHERE ProducerID='$producer_id'";
    $result = $conn->query($findsql);
    $row = mysqli_fetch_array($result);
    
    
    $sql = "DELETE FROM producer WHERE ProducerID ='$prodcer_id'";
    
    if ($conn->query($sql) === TRUE) {
        
        echo "<script>alert('Producer deleted successfully');</script>";
       
        echo "<script>setTimeout(function(){ window.location.href = 'directorShow.php'; }, 1000);</script>";
    } else {
       
        echo "<script>alert('Error deleting food: " . $conn->error . "');</script>";
        
        echo "<script>window.location.href = 'directorShow.php';</script>";
    }
}
?>
