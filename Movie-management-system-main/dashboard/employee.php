<?php
   session_start();
   $user_email = $_SESSION['user_email'];
   
   if(!empty($user_email)){
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://cdn.dribbble.com/users/1646263/screenshots/3549733/camera_build_-_loop_1.gif') no-repeat center center fixed;
            background-size: cover;
        }

        /* Container Styles */
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 40px;
            background-color: rgba(255, 255, 255, 0.8); /* Transparent white background */
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        /* Heading Styles */
        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #ff0000;
            text-align: center;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 5px;
            text-align: center;
            border-bottom: 2px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }

        /* Menu Styles */
        .menu {
            text-align: center;
            margin-top: 30px;
        }

        .menu ul {
            list-style-type: none;
            padding: 0;
        }

        .menu ul li {
            display: inline;
            margin: 0 10px;
        }

        .menu ul li a {
            text-decoration: none;
            color: #ffffff;
            font-size: 18px;
        }

        .menu ul li a:hover {
            color: #ff0000;
        }
    </style>
</head>
<body>

<div class="menu">
        <ul>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Orders</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#">Notification</a></li>
            <li><a href="#">Logout</a></li>
        </ul>
    </div>
    <?php
        include '../connection.php';


        // Assuming you have received the user email from the previous page
       // $user_email ="mayeen52660@gmail.com"; //$_GET['user_email'];

        // Prepare and execute the query to fetch user information based on email

        echo '<div class="container">';
        echo '<h2>User Profile</h2>';

        // Fetch data from the signup table
        $sql = "SELECT * FROM usersignup WHERE Email='$user_email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data in a tabular form
            echo "<table>";
            echo "<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>DOB</th><th>Gender</th><th>Address</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["UserID"]."</td>";
                echo "<td>".$row["FullName"]."</td>";
                echo "<td>".$row["Email"]."</td>";
                echo "<td>".$row["Phone"]."</td>";
                echo "<td>".$row["DOB"]."</td>";
                echo "<td>".$row["Gender"]."</td>";
                echo "<td>".$row["Address"]."</td>";
                echo "</tr>";
               
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        echo '</div>';
    ?>
   
    <div class="menu">
        <ul>
            <li><a href="#">Profile</a></li>
            <li><a href="#">Orders</a></li>
            <li><a href="#">Support</a></li>
            <li><a href="#">Notification</a></li>
            <li><a href="../logout/logout.php">Logout</a></li>
        </ul>
    </div>
    <?php  }else{
         header('location:../login/login.php');
    } ?> 
</body>
</html>
