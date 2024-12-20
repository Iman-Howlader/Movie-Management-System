// update.php
<?php
include '../../connection.php';

if(isset($_GET['hallmovieID'])) {
    $hallmovieID = $_GET['hallmovieID'];
    if(isset($_POST['submit'])){
        // Retrieve form data
        $title = $_POST['title'];
        $category = $_POST['category'];
        $startTime = $_POST['startTime'];
        $endTime = $_POST['endTime'];
        $ticketPrice = $_POST['ticketPrice'];
        $locations = implode(",", $_POST['location']); // Correct variable name and convert array to string
        
        // Convert start time and end time to DateTime objects
        $startDateTime = new DateTime($startTime);
        $endDateTime = new DateTime($endTime);
        
        // Check if start time is before end time
        if($startDateTime >= $endDateTime) {
            echo "<script>alert('Start time must be before end time');</script>";
        } else {
            // Update data in theaterMovie table
            $updateQuery = "UPDATE theatermovie SET Title = '$title', Category = '$category', Location='$locations', StartTime = '$startTime', EndTime = '$endTime', TicketPrice = '$ticketPrice' WHERE HallMovieID = '$hallmovieID'";
            if(mysqli_query($conn, $updateQuery)) {
                echo "Movie updated successfully!";
                header("Location: theaterAdminUpdate.php?hallmovieID=$hallmovieID"); // Redirect after successful update
                exit(); // Stop further execution
            } else {
                echo "Error updating movie: " . mysqli_error($conn);
            }
        }
    }
}
?>
