<?php
   include '../../connection/connection.php';
   include 'castAdd.html';

// check if form is submitted
if (isset($_POST['submit'])) {
    // get form data
    $fullname = $_POST['fullname'];
    $dob =  $_POST['dob'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $bio = $_POST['bio'];
    $link = $_POST['contactlink'];

    // check if file is uploaded
    $filename = $_FILES['upfile']['name'];
    $tmploc= $_FILES['upfile']['tmp_name'];
    $uploc ="images/".$filename;

    if(move_uploaded_file($tmploc,$uploc)){
         echo "Uploaded.";

    }else{
        echo "Not uploaded";
    }
     


    // insert data into database
    $sql = "INSERT INTO `casts` (`Name`, `Birthdate`, `Gender`, `Nationality`, `Bio`,`ContactLink`, `Image`) VALUES ('$fullname', '$dob', '$gender', '$nationality', '$bio','$link', '$filename')";

    // check if query is successful
    if (mysqli_query($conn, $sql)) {
        echo "Director information added successfully.";
    } else {
        echo "Error adding director information: " . mysqli_error($conn);
    }
}

// close database connection
mysqli_close($conn);
?>