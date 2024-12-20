<?php
include '../../connection.php';

if(isset($_GET['hallmovieID'])) {
    $hallmovieID = $_GET['hallmovieID'];

     // Delete movie from the database
    $sql = "DELETE FROM theatermovie WHERE HallMovieID='$hallmovieID'";


    if ($conn->query($sql) === TRUE) {
        echo "Movie deleted successfully";
        header("location:theaterAdminShow.php");
    } else {
        echo "Error deleting movie: " . $conn->error;
    }
}
  
    

?>
