<?php 
ob_start();
include '../connection/connection.php';
ob_end_clean();
session_start();
$user_email = $_SESSION['user_email'];
$query1 = "SELECT Image FROM usersignup WHERE Email='$user_email'";
$result1 = $conn->query($query1);
$row1 = $result1->fetch_assoc();
$user_image = $row1['Image'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>admin Profile</title>
    <style>
    :root {
        --bg-color: #f0f0f0;
        --text-color: #333;
        --header-bg: #333;
        --header-text: white;
        --main-color: red;
        --footer-bg: #333;
        --footer-text: white;
        --button-bg: #2D828C;
        --button-hover-bg: #ff1e26;
    }

    body {
        font-family: Arial, sans-serif;
        margin: 0;
        padding: 0;
        background-color: var(--bg-color);
        color: var(--text-color);
    }

    header {
        position: fixed;
        top: 0;
        right: 0;
        left: 0;
        z-index: 1000;
        background: var(--header-bg);
        padding: 10px 2%;
        display: flex;
        align-items: center;
        justify-content: space-between;
        transition: all 0.5s ease;
    }

    .logo {
        font-size: 24px;
        font-weight: 700;
        color: var(--header-text);
        text-decoration: none;
        white-space: nowrap;
    }

    .logo span {
        color: var(--main-color);
    }

    .navbar {
        display: flex;
        flex-wrap: wrap;
        list-style-type: none;
        padding: 0;
        margin: 0;
        flex-grow: 1;
        align-items: center;
    }

    .navbar li {
        margin: 0 10px;
        display: flex;
        align-items: center;
        position: relative;
    }

    .navbar a {
        color: var(--header-text);
        font-size: 16px;
        font-weight: bold;
        text-decoration: none;
        transition: all 0.5s ease;
    }

    .navbar a:hover {
        color: var(--main-color);
        font-size: 1.2rem;
    }

    .dropdown .dropdown-content {
        display: none;
        position: absolute;
        background-color: #f9f9f9;
        min-width: 200px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        top: 100%;
    }

    .dropdown:hover .dropdown-content {
        display: block;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-content a:hover {
        background-color: #DEA2D4;
    }

    .search-form {
        display: flex;
        align-items: center;
        margin-left: auto;
    }

    .search-bar input[type="text"],
    .submit-button button {
        padding: 8px;
        border: none;
        font-size: 17px;
        border-radius: 6px;
    }

    .search-bar input[type="text"] {
        margin-right: 4px;
        width: 150px;
    }

    .submit-button button {
        background-color: var(--main-color);
        color: white;
        cursor: pointer;
    }

    .submit-button button:hover {
        background-color: var(--button-hover-bg);
    }

    .user-image img {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        margin-left: 20px;
    }

    .user-image1 img {
        width: 30px;
        height: 30px;
        border-radius: 40%;
        cursor: pointer;
        margin-left: 5px;
    }

    .dropdowncorner {
        position: relative;
        display: inline-block;
        list-style-type: none;
    }

    .dropdown-contentcorner {
        display: none;
        position: absolute;
        background-color: #0080ff;
        width: 160px;
        min-height: 200px;
        box-shadow: 0px 8px 16px 0px rgba(1,2,0,0.2);
        z-index: 1;
        left: -65px;
        top: 100%;
    }

    .dropdowncorner:hover .dropdown-contentcorner {
        display: block;
    }

    .dropdown-contentcorner a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
    }

    .dropdown-contentcorner a:hover {
        background-color: #f1f1f1;
    }

    .dropdown-contentcorner a.logout {
        color: red;
    }

    .mini-circle {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        object-fit: cover;
    }

    .right-side {
        display: flex;
        align-items: center;
    }

    @media (max-width: 768px) {
        .navbar {
            flex-direction: row;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .navbar li {
            margin: 5px 10px;
        }

        .logo {
            font-size: 20px;
        }

        .search-bar input[type="text"] {
            width: 100px;
        }

        .mini-circle {
            width: 20px;
            height: 20px;
        }
    }

    @media (max-width: 480px) {
        .navbar {
            flex-direction: row;
            flex-wrap: nowrap;
            overflow-x: auto;
        }

        .logo {
            font-size: 18px;
        }

        .search-form {
            width: 100%;
            justify-content: flex-end;
        }

        .search-bar input[type="text"] {
            width: 80px;
        }

        .mini-circle {
            width: 25px;
            height: 25px;
        }

        .user-image img {
            width: 30px;
            height: 30px;
        }
    }

    </style>
</head>
<body>
<header>
    <a href="homepage.php" class="logo">IZI <span>Movie</span></a>
    <ul class="navbar">
        <li><a href="../test/homepage.php">Home</a></li>
        <li><a href="../userview/movie.php">Account Approval</a></li>
        <li class="dropdown">
            <a href="#">Movies</a>
            <div class="dropdown-content">
                <a href=''>Add new movie</a>
                <a href=''>Show and manage Movies</a>
                <a href=''>Update Movies</a>
                <a href=''>Delete movies</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Theater_Manage</a>
            <div class="dropdown-content">
                <a href=''>Add show(movie)</a>
                <a href=''>Show and Manage Movies running hall</a>
                <a href=''>Update Movies</a>
                <a href=''>Delete movies</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Food</a>
            <div class="dropdown-content">
                <a href=''>Add New(Food)</a>
                <a href=''>Show and Management Food</a>
                <a href=''>Update Food</a>
                <a href=''>Delete Food</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Cast</a>
            <div class="dropdown-content">
                <a href=''>Add New(cast)</a>
                <a href=''>Show and Manage cast</a>
                <a href=''>Assign Cast to Movie</a>
                <a href=''>Update cast</a>
                <a href=''>Delete cast</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Directors</a>
            <div class="dropdown-content">
                <a href=''>Add New(Director)</a>
                <a href=''>Show and Manage Director</a>
                <a href=''>Assign Director to Movie</a>
                <a href=''>Update Director</a>
                <a href=''>Delete Director</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Producer</a>
            <div class="dropdown-content">
                <a href=''>Add New(Producer)</a>
                <a href=''>Show and Manage Producer</a>
                <a href=''>Assign Producer to Movie</a>
                <a href=''>Update Producer</a>
                <a href=''>Delete Producer</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Language</a>
            <div class="dropdown-content">
                <a href=''>Add New(Language)</a>
                <a href=''>Show and Manage Language</a>
                <a href=''>Assign Language to Movie</a>
                <a href=''>Update Language</a>
                <a href=''>Delete Language</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Genre</a>
            <div class="dropdown-content">
                <a href=''>Add New(Genre)</a>
                <a href=''>Show and Manage Genre</a>
                <a href=''>Assign Genre to Movie</a>
                <a href=''>Update Genre</a>
                <a href=''>Delete Genre</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Coupons</a>
            <div class="dropdown-content">
                <a href=''>Coupons</a>
                <a href=''>Show and Manage Coupons</a>
                <a href=''>Assign Coupons to Movie</a>
                <a href=''>Update Coupons</a>
                <a href=''>Delete Coupons</a>
            </div>
        </li>
        <li class="dropdown">
            <a href="#">Rating</a>
            <div class="dropdown-content">
                <a href=''>Movie Rating</a>
                <a href=''>Actor/Actress Rating</a>
                <a href=''>Director Rating</a>
            </div>
        </li>
        <a href="../connection.php"><div class="user-image1">
            <img src="../image_bacground/NotificationIcon.png" alt="Notification Icon">
        </div></a>
       
    </ul>
    <form class="search-form" action="/search" method="GET">
        <div class="search-bar">
            <input type="text" name="query" placeholder="Search...">
        </div>
        <div class="submit-button">
            <button type="submit">Search</button>
        </div>
    </form>
    <li class="dropdowncorner">
        <a href="../connection.php"><div class="user-image">
            <img src="../signup/signupimages/<?php echo $user_image; ?>" alt="User Image">
        </div></a>
        <div class="dropdown-contentcorner">
            <a href=''>Edit Profile</a>
            <a href=''>Change Password</a>
            <a href=''>Order History</a>
            <a href='' class='logout'>LogOUT</a>
        </div>
    </li>
</header>
</body>
</html>
