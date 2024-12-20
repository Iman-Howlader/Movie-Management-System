<?php
include '../connection.php'; // Include database connection
include 'userEdit.php'; // Include the userEdit.php file which contains HTML form

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Escape user inputs for security
    $fullname = $_POST['fullname'];
    $phone = $_POST['phone'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $address = $_POST['address'];

    // Initialize variables for file upload
    $filename = $_FILES['upfile']['name'];
    $tmploc = $_FILES['upfile']['tmp_name'];
    $uploc = "../signup/signupImages/".$filename;
    $user_email = $_SESSION['user_email'];
    
    // Select the current image from the database
    $sql_select_image = "SELECT Image FROM usersignup WHERE Email='$user_email'";
    $result = $conn->query($sql_select_image);
    $row = $result->fetch_assoc();
    $previous_image = $row["Image"];

    // Handle file upload only if a new file is provided
    if (!empty($filename)) {
        if (move_uploaded_file($tmploc, $uploc)) {
            echo "Uploaded.";

            // Unlink previous image file
            if (!empty($previous_image) && file_exists("../signup/signupImages/".$previous_image)) {
                unlink("../signup/signupImages/".$previous_image);
            }

            $image = $filename;
        } else {
            echo "Not uploaded";
            $image = $previous_image; // Keep the previous image if upload fails
        }
    } else {
        $image = $previous_image; // Keep the previous image if no new file is uploaded
    }

    // Update user information with new or existing image
    $sql_update_profile = "UPDATE usersignup SET Fullname=?, Phone=?, DOB=?, Gender=?, Address=?, Image=? WHERE Email=?";
    $stmt_update_profile = $conn->prepare($sql_update_profile);
    $stmt_update_profile->bind_param("sssssss", $fullname, $phone, $dob, $gender, $address, $image, $user_email);
    
    if ($stmt_update_profile->execute()) {
        // Redirect to profile page after successful update
        header("Location: ../dashboard/user.php");
        exit();
    } else {
        echo "Error updating record: " . $conn->error;
    }

    // Close statement and connection
    $stmt_update_profile->close();
    $conn->close();
}
?>
