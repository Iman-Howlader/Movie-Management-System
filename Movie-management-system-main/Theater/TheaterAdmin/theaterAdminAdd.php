<?php
include '../../connection.php';
include 'theaterAdminAdd.html';

if(isset($_POST['submit'])){
    // Retrieve form data
    $title = $_POST['title'];
    $category = $_POST['category'];
    $startTime = $_POST['startTime'];
    $endTime = $_POST['endTime'];
    $locations = $_POST['location'];
    $ticketPrice = $_POST['ticketPrice'];
    
    // Convert start time and end time to DateTime objects
    $startDateTime = new DateTime($startTime);
    $endDateTime = new DateTime($endTime);
    
    // Check if start time is before end time
    if($startDateTime >= $endDateTime) {
        echo "<script>alert('Start time must be before end time');</script>";
    } else {
        // Flag to check for conflicts
        $conflict = false;
        
        // Check for conflicts with existing movies
        foreach($locations as $location) {
            // Query to check for conflicts
            $query = "SELECT * FROM theatermovie WHERE Location = '$location' AND ((StartTime <= '$startTime' AND EndTime >= '$endTime') OR (StartTime >= '$startTime' AND StartTime <= '$endTime') OR (EndTime >= '$startTime' AND EndTime <= '$endTime'))";
            
            // Execute the query
            $result = mysqli_query($conn, $query);
            
            // Check if any conflicting movies exist
            if(mysqli_num_rows($result) > 0) {
                $conflict = true;
                break;
            }
        }
        
        
           
            
            // Retrieve movie information based on title
            $query = "SELECT * FROM movie WHERE Title = '$title'";
            $result = mysqli_query($conn, $query);
            
            // Check if movie exists
            if($result && mysqli_num_rows($result) > 0) {
                // Fetch movie information
                $movieInfo = mysqli_fetch_assoc($result);
                
                // Extract movie details
                $movieID = $movieInfo['MovieID'];
                $image = $movieInfo['Image'];
                
                // Insert data into theaterMovie table
                foreach($locations as $location) {
                    $insertQuery = "INSERT INTO theatermovie (MovieID, Title, Image, Category, StartTime, EndTime, Location, TicketPrice) VALUES ('$movieID', '$title', '$image', '$category', '$startTime', '$endTime', '$location', '$ticketPrice')";
                    mysqli_query($conn, $insertQuery);
                }
                
                echo "Movie added successfully!";
            } else {
                // Movie not found, show popup message and clear title field
                echo "<script>alert('ভাই!! কি শুরু করলেন, এই সিনেমা এখনো বানানোই হয় নাই, আপনি বানান');</script>";
                echo "<script>document.getElementById('title').value = '';</script>";
            }
        
    }
}
?>
