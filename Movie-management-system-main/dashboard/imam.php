<?php
session_start();
$user_email = $_SESSION['user_email'];

if (!empty($user_email)) {
    ob_start();
    include '../connection/connection.php';
    ob_end_clean();
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
            --text-color: #fff;
            --bg-color: #00ffff;
            --main-color: #04f929;
            --h1-font: 6rem;
            --h2-font: 3rem;
            --p-font: 1rem;
            --card-color: #137db1;
            z-index: 1000;
        }

        header {
            position: relative;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1000;
            background: linear-gradient(135deg, #43144f 0%, #193b38 100%);
            padding: 5px 1%;
            display: flex;
            align-items: center;
            justify-content: space-between;
            transition: all 0.5s ease;
        }

        .logo {
            font-size: 25px;
            font-weight: 600;
            color: var(--text-color);
        }

        span {
            color: var(--main-color);
        }

        .navbar {
            display: flex;
            align-items: center;
        }

        .navbar a {
            color: var(--text-color);
            font-size: var(--p-font);
            font-weight: bold;
            margin: -5px 12px;
            transition: all 0.2s ease;
        }

        .navbar a:hover {
            color: var(--main-color);
        }

        .search-form {
            display: flex;
            align-items: center;
        }

        .search-bar input[type=text] {
            padding: 8px;
            border: none;
            font-size: 17px;
            border-radius: 6px;
            margin-right: 10px;
        }

        .submit-button button {
            background-color: var(--main-color);
            color: white;
            padding: 8px 10px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 17px;
            margin-right: 10px;
        }

        .submit-button button:hover {
            background-color: var(--main-color);
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
    margin-right: 90px; /* Adjust as needed for spacing */
    margin-top: -20px;
}

        .user-image1 img {
            width:30px;
            height: 30px;
            border-radius: 50%;
            cursor: pointer;
            
        margin-left: 10px;
        }

        .submit-button button:hover {
            background-color: var(--main-color);
        }

        .profile-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .profile-actions-container {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            top: -px;
            position: relative;
        }

        .profile-actions a {
            margin: 10px 0;
            padding: 10px 20px;
            background-color: var(--main-color);
            color: black;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://cdn.dribbble.com/users/1646263/screenshots/3549733/camera_build_-_loop_1.gif') no-repeat center center fixed;
            background-size: cover;
        }

        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 40px;
           
            opacity: 0.9;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(255, 255, 255,0.3);
            top: -200px;
            position: relative;
        }
  

        h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #ffffff;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            padding: 5px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }

        th {
            background-color: #ffff80;
        }

        .primary-btn {
            display: flex;
            flex-direction: column;
            gap: 10px;
            align-items: flex-start;
            top: -700px;
            position: relative;
        }

        button {
            padding: 15px 30px;
            border: none;
            background-color: #028df7;
            color: white;
            border-radius: 50px;
            cursor: pointer;
            font-size: 18px;
            font-weight: 600;
            transition: all 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.3);
            margin: 10px;
        }

        button:hover {
            background-color: #ff574d;
            transform: translateY(-2px);
        }

        button:active {
            background-color: #ff3e36;
            transform: translateY(0);
        }

        .secondary-btn {
            display: none;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            max-width: 80%;
            margin: 20px auto;
            text-align: center;
            position: absolute;
            top: calc(100% + 20px);
            left: 50%;
            transform: translateX(-50%);
        }
      

        .secondary-btn > div {
            display: none;
            width: 100%;
        }

        .btn-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 20px;
        }

        .btn-group button {
            padding: 12px 24px;
            font-size: 16px;
            border-radius: 6px;
            background-color: #f0f0f0;
            color: #555;
            border: 1px solid #ccc;
            transition: background-color 0.3s, color 0.3s;
            cursor: pointer;
        }

        .btn-group button:hover {
            background-color: #e0e0e0;
        }

        .btn-group button.active {
            background-color: #ffc107;
            color: #333;
            border: 1px solid transparent;
        }

        .menu {
            text-align: center;
            margin-top: 30px;
            top: -550px;
            position: relative;
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
            margin: 10px 0;
            padding: 10px 20px;
            background-color: var(--main-color);
            color: black;
            font-weight: bold;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s ease;
        }

        .menu ul li a:hover {
            background-color: yellow;
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
            background-color: #f1f1f1;
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
        <li><a href="../userview/movie.php">All Movies</a></li>
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
        
        <li><a href="#">NEWS</a></li>

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
       









<!--
    <a href="user.php">
    <div class="user-image">
        <img src="../signup/signupimages/<?php echo $user_image; ?>" alt="User Image">
    </div>
</a>
            -->
</header>

<div class="profile-actions">
    <div class="profile-actions-container">
        <a href="#">Edit Profile</a>
        <a href="#">Change Password</a>
        <a href="#">Order History</a>
    </div>
</div>


<?php
ob_start();
 include '../connection.php';

 ob_end_clean();
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
     echo '<h2>Welcome, '. $row['FullName'] .'   </h2>';
     echo '<img src="../signup/signupImages/' . htmlspecialchars($row['Image']) . '" alt="User Image" style="display: block; margin-left: auto; margin-right: auto; width: 150px; height: 150px; border-radius: 50%; border: 7px solid #808040; box-shadow: 0 4px 8px rgba(0, 0, 0);">';
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
<div class="primary-btn">
            <button id="main-btn">Watchlist</button>
            <button id="movies-btn">Statistics</button>
            <button id="food-btn">Recommendations</button>
            <button id="review-btn">Reviews</button>
        </div>
    <div class="secondary-btn" id="secondary-btn">
        <div class="watch-btn">
            <button class="intermediate-btn" data-target="mov-list">All Movies</button>
            <button class="intermediate-btn" data-target="eng-mov-list">English Movies</button>
            <button class="intermediate-btn" data-target="cast-mov-list">By Cast</button>
            <button class="intermediate-btn" data-target="prod-mov-list">By Producer</button>
        </div>
 
        <div class="stat-btn">
            <button class="intermediate-btn" data-target="cnt-mov">Movies Watched</button>
            <button class="intermediate-btn" data-target="lst-wat-mov">Last Watched</button>
        </div>
 
        <div class="food">
            <button class="intermediate-btn" data-target="rec-mov">Recommended</button>
        </div>
 
        <div class="review">
            <button class="intermediate-btn" data-target="add-review">Add Movie Review</button>
            <button class="intermediate-btn" data-target="add-review">Add Cast Review</button>
            <button class="intermediate-btn" data-target="add-review">Add Director Review</button>
            <button class="intermediate-btn" data-target="show-review">Show Reviews</button>
        </div>
    </div>
    
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
<script>
        document.addEventListener('DOMContentLoaded', () => {
            const primaryButtons = document.querySelectorAll('.primary-btn button');
            const secondaryBtnContainer = document.querySelector('.secondary-btn');
            const secondarySections = document.querySelectorAll('.secondary-btn > div');
            const intermediateButtons = document.querySelectorAll('.intermediate-btn');
 
            primaryButtons.forEach((button, index) => {
                button.addEventListener('click', () => {
                    secondarySections.forEach(section => section.style.display = 'none');
                    secondarySections[index].style.display = 'block';
                    secondaryBtnContainer.style.display = 'block';
                    intermediateButtons.forEach(btn => btn.classList.remove('active'));
                    button.classList.add('active');
                });
            });
 
        });
    </script>
</html>
