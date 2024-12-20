<?php
// Check if the food_id is set and not empty
if(isset($_GET['DirectorID'])) {
    
    include '../../connection/connection.php'; 
   
    $director_id = $_GET['DirectorID'];

    // Get the filename of the food image
    $findsql = "SELECT * FROM directors WHERE DirectorID='$director_id'";
    $result = $conn->query($findsql);
    $row = mysqli_fetch_array($result);
    $filename = $row['Image'];

    // Delete the image file from the folder
    unlink("images/".$filename);

    
    $sql = "DELETE FROM directors WHERE DirectorID ='$director_id'";
    
    if ($conn->query($sql) === TRUE) {
        
        echo "<script>alert('Director deleted successfully');</script>";
       
        echo "<script>setTimeout(function(){ window.location.href = 'directorShow.php'; }, 1000);</script>";
    } else {
       
        echo "<script>alert('Error deleting food: " . $conn->error . "');</script>";
        
        echo "<script>window.location.href = 'directorShow.php';</script>";
    }
}
?>
