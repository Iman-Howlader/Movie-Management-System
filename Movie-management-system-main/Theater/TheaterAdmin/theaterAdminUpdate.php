<?php
include '../../connection.php';

if(isset($_GET['hallmovieID'])) {
    $hallmovieID = $_GET['hallmovieID'];
    $query = "SELECT * FROM theatermovie WHERE HallMovieID = '$hallmovieID'";
    $result = mysqli_query($conn, $query);
    
    if(mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $title = $row['Title'];
        $category = $row['Category'];
        $startTime = $row['StartTime'];
        $endTime = $row['EndTime'];
        $ticketPrice = $row['TicketPrice'];
        $locations = explode(",", $row['Location']); // Convert locations string to an array
    } else {
        echo "<script>alert('Movie not found');</script>";
        exit(); // Exit if movie not found
    }
}

include 'theaterAdminUpdate.html';
?>
