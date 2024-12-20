<?php

ob_start();
include '../../connection/connection.php';
ob_end_clean();
include 'producerAdd.html';

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get form data
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company = $_POST['company'];
   
    $website = $_POST['website'];

    // Check if file is uploaded
   

    // Insert data into database
    $sql = "INSERT INTO producer (Name, Email, Phone, Company, Website) 
            VALUES ('$name', '$email', '$phone', '$company', '$website')";

    // Check if query is successful
    if (mysqli_query($conn, $sql)) {
        echo "Producer information added successfully.";
    } else {
        echo "Error adding producer information: " . mysqli_error($conn);
    }
}

// Close database connection
mysqli_close($conn);
?>
