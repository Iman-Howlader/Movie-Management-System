<?php
session_start();
$user_email = $_SESSION['user_email'];

if (!empty($user_email)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    <style>
        :root {
    --text-color: #fff;
    --bg-color: #F9E3E3;
    --main-color: #04f929;
    --h1-font: 6rem;
    --h2-font: 3rem;
    --p-font: 1rem;
    --card-color: #137db1;
}

        header {
    position:relative;
    background: #000;
    top: 0;
    right: 0;
    left: 0;
    z-index: 1000;
    background: transparent;
    padding: 30px 2%;
    display: flex;
    align-items: center;
    justify-content: space-between;
    transition: all 0.5s ease;
}

.logo {
    font-size: 33px;
    font-weight: 700;
    color: var(--text-color);
}

span {
    color: var(--main-color);
}


.search-form {
    display: flex;
    align-items: center;
}

.search-bar {
    margin-right: 20px;
}

.search-bar input[type=text] {
    padding: 8px;
    border: none;
    font-size: 17px;
    border-radius: 5px;
}

.submit-button button {
    background-color: var(--main-color);
    color: white;
    padding: 8px 15px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 17px;
}

.submit-button button:hover {
    background-color: var(--main-color);
}

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
            background-color: rgba(255, 255, 255, 0.3); /* Transparent white background */
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
            border-bottom: px solid #ddd;
            
            
        }

        th {
            background-color: #ffff80;
           
            
            
            
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
            color: #00ff00;
        }

        /* Image Styles */
        .profile-image {
            display: block;
            margin: 0 auto;
            width: 150px; /* Adjust size as needed */
            height: auto; /* Maintain aspect ratio */
            border-radius: 50%; /* Make it circular */
            margin-bottom: 150px; /* Adjust spacing */
        }

        /*  navbar*/
        .navbar {
    display: flex;
}

.navbar a {
    color: var(--text-color);
    font-size: var(--p-font);
    font-weight: bold;
    margin: 15px 22px;
    transition: all 0.5s ease;
}

.navbar a:hover {
    color: var(--main-color);
}

    </style>
</head>
<body>

<header>
    <a href="homepage.php" class="logo">IZI <span>Movie</span></a>
    <ul class="navbar">
        <li><a href="../test/homepage.php">Home</a></li>
        <li><a href="../movieadmin/AdminShowMovieList.php">Movies</a></li>
        <li><a href="#">Watchlist</a></li>
        <li><a href="#">Directors</a></li>
        <li><a href="#">Top10</a></li>
        <li><a href="#">Trailer</a></li>
        <li><a href="#">Theater</a></li>
        
    </ul>
    <form class="search-form" action="/search" method="GET">
        <div class="search-bar">
            <input type="text" name="query" placeholder="Search...">
        </div>
        <div class="submit-button">
            <button type="submit">Search</button>
        </div>
    </form>
    
</header>
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
     $row = $result->fetch_assoc();
     echo '<img src="../signup/signupImages/' . $row['Image'] . '" alt="User Image" style="display: block; margin-left: auto; margin-right: auto; width: 150px; height: 150px; border-radius: 100%;">';
     echo "<table>";
     echo "<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>DOB</th><th>Gender</th><th>Address</th></tr>";
     echo "<tr>";
     echo "<td>".$row["UserID"]."</td>";
     echo "<td>".$row["FullName"]."</td>";
     echo "<td>".$row["Email"]."</td>";
     echo "<td>".$row["Phone"]."</td>";
     echo "<td>".$row["DOB"]."</td>";
     echo "<td>".$row["Gender"]."</td>";
     echo "<td>".$row["Address"]."</td>";
     echo "</tr>";
     echo "</table>";
 } else {
     echo "0 results";
 }

 echo '</div>';
?>

<div class="menu">
 <!-- Your existing menu content -->
</div>
<?php  }else{
  header('location:../login/login.php');
} ?>
<div class="menu">
    <ul>
        <li><a href="#">Profile</a></li>
        <li><a href="#">Orders</a></li>
        <li><a href="#">Support</a></li>
        <li><a href="#">Notification</a></li>
        <li><a href="../Logout/logout.php">Logout</a></li>
    </ul>
</div>
</body>
</html>
