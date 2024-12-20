<?php
// Check if the food_id is set and not empty
if(isset($_GET['CastID'])) {
    
    include '../../connection/connection.php'; 
   
    $cast_id = $_GET['CastID'];

    // Get the filename of the food image
    $findsql = "SELECT * FROM cast WHERE CastID='$cast_id'";
    $result = $conn->query($findsql);
    $row = mysqli_fetch_array($result);
    $filename = $row['Image'];

    // Delete the image file from the folder
    unlink("images/".$filename);

    
    $sql = "DELETE FROM casts WHERE CastID ='$cast_id'";
    
    if ($conn->query($sql) === TRUE) {
        
        echo "<script>alert('Cast deleted successfully');</script>";
       
        echo "<script>setTimeout(function(){ window.location.href = 'castShow.php'; }, 1000);</script>";
    } else {
       
        echo "<script>alert('Error deleting cast: " . $conn->error . "');</script>";
        
        echo "<script>window.location.href = 'castShow.php';</script>";
    }
}
?>
