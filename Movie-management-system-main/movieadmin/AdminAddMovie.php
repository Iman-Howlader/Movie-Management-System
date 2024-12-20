<?php
include '../connection.php';
include 'AdminAddMovie.html';

// Retrieve movie details from the form
if (isset($_POST['submit'])){
$title = $_POST['title'];
$genre = $_POST['genre'];
$director = $_POST['director'];
$release_date = $_POST['release_date'];
$duration = $_POST['duration'];
$language = $_POST['language'];
$description = $_POST['description'];
$budget = $_POST['budget'];
//for image 
    $filename = $_FILES['upfile']['name'];
    $tmploc= $_FILES['upfile']['tmp_name'];
    $uploc ="images/".$filename;

    if(move_uploaded_file($tmploc,$uploc)){
         echo "Uploaded.";

    }else{
        echo "Not uploaded";
    }




// Insert movie details into the database
$sql = "INSERT INTO movie (Title, Genre, Director, Release_date, Duration, Language, Description, Budget,Image) 
        VALUES ('$title', '$genre', '$director', '$release_date', '$duration', '$language', '$description',' $budget','$filename')";


if ($conn->query($sql) === TRUE) {
    echo "New movie added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
}
?>
