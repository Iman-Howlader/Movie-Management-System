<?php

include '../connection.php';
session_start();

if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['user_type'])){

    $user_email = $_POST['email'];
    $user_password = $_POST['password'];
    $user_type = $_POST['user_type'];   

    $sql = "SELECT * FROM signup WHERE 
            Email='$user_email' AND Password='$user_password' AND UserType='$user_type'";

    $query = $conn->query($sql);

    if(mysqli_num_rows($query) > 0){
        $data = mysqli_fetch_array($query);
        $user_full_name = $data['FullName'];

        $_SESSION['user_full_name'] = $user_full_name;
        
        if($user_type == 'admin') {
            header("location:../AdminShowMovieList.php");
        } else {
            header("location:../welcome/welcome.php");
        }
    } else {
       header("location:login.php"); // Redirect back to login if credentials are incorrect
    }
} else {
    header("location:login.php"); // Redirect back to login if form fields are not set
}
?>
