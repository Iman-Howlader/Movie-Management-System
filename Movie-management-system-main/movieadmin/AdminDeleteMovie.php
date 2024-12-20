<?php
include '../connection.php';

if(isset($_GET['MovieID'])) {
    $movieID = $_GET['MovieID'];


    $findsql = "SELECT * FROM movie WHERE MovieID='$movieID'";
    
    
    $result = $conn->query($findsql);
    $row = mysqli_fetch_array($result);

    $filename = $row['Image'];
    
    unlink("images/".$filename);

    // Delete movie from the database
    $sql = "DELETE FROM movie WHERE MovieID='$movieID'";


    if ($conn->query($sql) === TRUE) {
        echo "Movie deleted successfully";
        header("location:AdminShowMovieList.php");
    } else {
        echo "Error deleting movie: " . $conn->error;
    }
}
  
    

?>
