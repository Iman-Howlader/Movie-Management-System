<?php
include '../connection.php';
include 'AdminUpdateMovie.html';

if (isset($_POST['submit'])) {
    // Retrieve movie details from the form
    $movieID = $_POST['movieID'];
    $title = $_POST['title'];
    $genre = $_POST['genre'];
    $release_date = $_POST['release_date'];
    $duration = $_POST['duration'];
    $language = $_POST['language'];
    $description = $_POST['description'];
    $budget = $_POST['budget'];

    $image_filename = $_POST['previous_photo'];

    //for image change

    if ($_FILES['upfile']['error'] === UPLOAD_ERR_OK) {
        $filename = basename($_FILES['upfile']['name']);
        $uploc = "images/" . $filename;
        if (move_uploaded_file($_FILES['upfile']['tmp_name'], $uploc)) {
            // Update movie details in the database
            $sql = "UPDATE movie SET Title='$title', Genre='$genre', Release_date='$release_date', Duration='$duration', Language='$language', Description='$description', Budget='$budget', Image='$filename' WHERE MovieID='$movieID'";
            if ($conn->query($sql) === TRUE) {
                // Delete previous image
                unlink("images/" . $image_filename);
                // Redirect after successful update
                header('Location: AdminShowMovieList.php');
                exit;
            } else {
                echo "Error updating movie: " . $conn->error;
            }
        } else {
            echo "Error uploading file.";
        }
    } else {
        // No file uploaded, update movie details without changing the image
        $sql = "UPDATE movie SET Title='$title', Genre='$genre', Release_date='$release_date', Duration='$duration', Language='$language', Description='$description', Budget='$budget' WHERE MovieID='$movieID'";
        if ($conn->query($sql) === TRUE) {
            // Redirect after successful update
            header('Location: AdminShowMovieList.php');
            exit;
        } else {
            echo "Error updating movie: " . $conn->error;
        }
    }
} else {
    echo "Form submission failed.";
}
?>
