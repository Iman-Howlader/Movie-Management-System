<?php
include '../connection.php';
include 'welcome.html';
session_start();
$user_full_name = $_SESSION['user_full_name'];
if(!empty($user_full_name)) {

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>This is movie ইরফান </h1>
</body>
</html>


<?php
}
  else {
    header("location:../login/login.php");
  }



