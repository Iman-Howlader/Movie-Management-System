<?php
// Connect to the database
include '../connection.php';

// Retrieve email and user_type from URL parameters
$userid = $_GET['UserID'] ?? '';
$user_type = $_GET['user_type'] ?? '';

// Check if email and user_type are provided
if (empty($userid) || empty($user_type)) {
    echo "Email and user type are required.";
    exit;
}

// Determine the source and target tables based on user_type
switch ($user_type) {
    case "user":
        $source_table = "tempusersignup";
        $target_table = "usersignup";
        break;
    case "admin":
        $source_table = "tempadminsignup";
        $target_table = "adminsignup";
        break;
    case "employee":
        $source_table = "tempemployeesignup";
        $target_table = "employeesignup";
        break;
    default:
        echo "Invalid user type.";
        exit;
}

// Prepare select statement for retrieving data from the source table
$select_sql = "SELECT * FROM $source_table WHERE UserID = '$userid' AND OTP = 'valid'";

$stmt = $conn->query($select_sql);


if ( $stmt->num_rows > 0) {
    // Data found, fetch and store in variables
    $row = $stmt->fetch_assoc();
    $UserID = $row["UserID"];
    $FullName = $row["FullName"];
    $Email = $row["Email"];
    $Phone = $row["Phone"];
    $DOB = $row["DOB"];
    $Gender = $row["Gender"];
    $Address = $row["Address"];
    $Password = $row["Password"];
    $User_Type = $row["User_Type"];
    $Image = $row["Image"];

    // Prepare insert statement for inserting data into target table
    $insert_sql = "INSERT INTO $target_table (FullName, Email, Phone, DOB, Gender, Address, Password, User_Type, Image) 
     VALUES ('$FullName', '$Email', ' $Phone', '$DOB', '$Gender', ' $Address', '$Password', '$User_Type', '$Image')";
    $stmt1= $conn->query( $insert_sql);

    // Data inserted successfully, now delete from source table
    $delete_sql = "DELETE FROM $source_table WHERE UserID = '$userid'";
    $stmt2= $conn->query($delete_sql);
   

    echo "Data inserted and moved successfully.";
} else {
    echo "<script>alert('OTP Invalid'); setTimeout(function() { window.location.href = 'index.php'; }, 3000);</script>";
   
  
}



header('location:pendingsignup.php');

// Close statement
$stmt->close();

// Close connection
$conn->close();
?>
