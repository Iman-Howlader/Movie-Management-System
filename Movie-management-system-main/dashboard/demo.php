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
    <title>User Profile</title>
    <style>
           :root {
            --bg-color: #f0f0f0;
            --text-color: #333;
            --header-bg: #333;
            --header-text: white;
            --main-color: red;
            --footer-bg: #333;
            --footer-text: white;
            --button-bg:#2D828C ;
            --button-hover-bg: #ff1e26;
        }

        /* body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: var(--bg-color);
            color: var(--text-color);
        } */

        header {
            font-family: Arial, sans-serif;
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
    font-size: 25px;
    margin-top:-15px;
    font-weight: 700;
    color: var(--header-text);
    text-decoration: none;
    white-space: nowrap; /* Ensures the text stays on one line */
}

.logo span {
    color: var(--main-color);
}

        .navbar {
            display: flex;
            margin-left:-30px;
            list-style-type: none;
        }

        .navbar a {
            color: var(--header-text);
            font-size: 13px;
            font-weight: bold;
            margin: 0 7px;
            text-decoration: none;
            transition: all 0.5s ease;
        }

        .navbar a:hover {
            color: var(--main-color);
            font-size: 1.2rem; 
        }

        .search-form {
    display: flex;
    align-items: center;
}

.search-bar {
    margin-right: 5px;
}

.search-bar input[type="text"],
.submit-button button {
    display: inline-block; /* Display as inline-block to place them on the same line */
    vertical-align: middle; /* Align vertically to middle */
}

.search-bar input[type="text"] {
    padding: 8px; /* Retain original padding for vertical size */
    border: none;
    font-size: 17px; /* Retain original font size for vertical size */
    border-radius: 6px;
    margin-right: 4px;
    width: 150px; /* Slightly reduced width from the previous example */
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
    background-color: var(--button-hover-bg);
}

.user-image {
    display: flex;
    align-items: right;
}

.user-image img {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    cursor: pointer;
    /* This will float the image to the left */
    margin-left: 20px; /* Adjust as needed for spacing */
    margin-top: 10px;
}

.user-image1 img {
    width: 30px;
    height: 30px;
    border-radius: 40%;
    cursor: pointer;
    margin-left: 5px; /* Adjusted margin to reduce gap between images */
}

.dropdown {
    position: relative;
    display: inline-block;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 200px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}

.dropdown-content a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-content a:hover {
    background-color: #DEA2D4  ;
}

.dropdown:hover .dropdown-content {
    display: block;
}

.dropdowncorner {
    position: relative;
    display: inline-block;
}

.dropdown-contentcorner {
    display: none;
    position: absolute;
    background-color: #0080ff;
    width: 160px; /* Width remains the same */
    min-height: 200px; /* Adjust the height as needed */
    box-shadow: 0px 8px 16px 0px rgba(1,2,0,0.2);
    z-index: 1;
    left: -65px; /* Adjust this value to move the dropdown to the left */
}

.dropdowncorner:hover .dropdown-contentcorner {
    display: block;
}

/* Style for the menu items */
.dropdown-contentcorner a {
    color: black;
    padding: 12px 16px;
    text-decoration: none;
    display: block;
}

.dropdown-contentcorner a:hover {
    background-color: #f1f1f1;
}

/* Style for the logout link */
.dropdown-contentcorner a.logout {
    color: red;
}


    </style>
</head>
<body>

<header>
    <a href="homepage.php" class="logo">IZI <span>Movie</span></a>
    <ul class="navbar">
        <li><a href="../test/homepage.php">Home</a></li>
        <li><a href="../userview/movie.php">Movies</a></li>
        <!-- genre -->
        <li class="dropdown">
            <a href="#">Genre</a>
            <div class="dropdown-content">
                <?php
                $genreSearch = "SELECT * FROM genres";
                $result = $conn->query($genreSearch);
                while($row = $result->fetch_assoc()){
                    echo "<a href='../userview/genremovie.php?genre_name=".$row['genre_name']."'>" . $row['genre_name'] . "</a>";
                }
                ?>
            </div>
        </li>
        <!--Language-->
        <li class="dropdown">
            <a href="#">Language</a>
            <div class="dropdown-content">
                <?php
                $languageSearch = "SELECT * FROM languages";
                $result = $conn->query($languageSearch);
                while($row = $result->fetch_assoc()){
                    echo "<a href='../userview/languagemovie.php?language_name=".$row['language_name']."'>" . $row['language_name'] . "</a>";
                }
                ?>
            </div>
        </li>
        <!-- Actor -->
        <li class="dropdown">
            <a href="#">Actor</a>
            <div class="dropdown-content">
                <?php
                $actorSearch = "SELECT * FROM casts WHERE Gender ='male'";
                $result = $conn->query($actorSearch);
                $count = 0;
                while($row = $result->fetch_assoc()){
                    if($count >= 4){
                        echo ' <a href="../userview/">See all</a> ';
                        break;
                    } else {
                        echo "<a href='../userview/languagemovie.php?language_name=".$row['Name']."'>" . $row['Name'] . "</a>";
                        $count++;
                    }
                }
                ?>
            </div>
        </li>

        <!--Actress -->
        <li class="dropdown">
            <a href="#">Actress</a>
            <div class="dropdown-content">
                <?php
                $actressSearch = "SELECT * FROM casts WHERE Gender ='female'";
                $result = $conn->query($actressSearch);
                $count = 0;
                while($row = $result->fetch_assoc()){
                    if($count >= 4){
                        echo ' <a href="../userview/">See all</a> ';
                        break;
                    } else {
                        echo "<a href='../userview/languagemovie.php?language_name=".$row['Name']."'>" . $row['Name'] . "</a>";
                        $count++;
                    }
                }
                ?>
            </div>
        </li>

        <!-- Director -->
        <li class="dropdown">
            <a href="#">Directors</a>
            <div class="dropdown-content">
                <?php
                $directorSearch = "SELECT * FROM directors ";
                $result = $conn->query($directorSearch);
                $count = 0;
                while($row = $result->fetch_assoc()){
                    if($count >= 4){
                        echo ' <a href="../userview/">See all</a> ';
                        break;
                    } else {
                        echo "<a href='../userview/languagemovie.php?language_name=".$row['Name']."'>" . $row['Name'] . "</a>";
                        $count++;
                    }
                }
                ?>
            </div>
        </li>

        <!--Producer-->
        
         <li class="dropdown">
            <a href="#">Producers</a>
            <div class="dropdown-content">
                <?php
                $directorSearch = "SELECT * FROM producer ";
                $result = $conn->query($directorSearch);
                $count = 0;
                while($row = $result->fetch_assoc()){
                    if($count >= 4){
                        echo ' <a href="../userview/">See all</a> ';
                        break;
                    } else {
                        echo "<a href='../userview/languagemovie.php?language_name=".$row['Name']."'>" . $row['Name'] . "</a>";
                        $count++;
                    }
                }
                ?>
            </div>
        </li>

        <!--Rating -->
        <li class="dropdown">
            <a href="#">Rating</a>
            <div class="dropdown-content">
               
                    <a href=''> Movie Rating</a>
                    <a href=''> Actor actrss  Rating</a>
                    <a href=''> Director  Rating</a>
                
        
            </div>
        </li>
         <!-- TOP 10 -->
         <li class="dropdown">
            <a href="#">TOP10</a>
            <div class="dropdown-content">
               
                    <a href=''> Movies</a>
                    <a href=''> Actor</a>
                    <a href=''> Actress</a>
                    <a href=''> Director</a>
                    
                
        
            </div>
        </li>
        


        <!--<li><a href="#">Watchlist</a></li> -->
        
        <li><a href="#">News</a></li>

         <!-- Theater -->
         <li class="dropdown">
            <a href="#">Theater</a>
            <div class="dropdown-content">
                    <a href=''>List running movie shows</a>
                    <a href=''>Buy Movie Tickets</a>
                    <a href=''> Buy Food</a>
            </div>
        </li>
        <!--Coupons -->
        <li><a href="#">Coupons</a></li>
     <!--Notification -->
     <a href="../connection.php"><div class="user-image1">
        <img src="../image_bacground/NotificationIcon.png" alt="NotificationIcon">
    </div></a>

    <!--cart -->
    <a href="../connection.php"><div class="user-image1">
        <img src="../image_bacground/cartIcon.png" alt="NotificationIcon">
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
    

    <!-- Profile corner-->
    <li class="dropdowncorner">
            <a href="../connection.php"><div class="user-image">
        <img src="../signup/signupimages/<?php echo $user_image; ?>" alt="User Image">
    </div></a>
            <div class="dropdown-contentcorner">
                    <a href=''>Edit Profile </a>
                    <a href=''>Chnage Password</a>
                    <a href=''>Order History</a>
                    <a href='' class='logout'>LogOUT</a>
                 
            </div>
          
        </li>

</header>
</body>
</html>
