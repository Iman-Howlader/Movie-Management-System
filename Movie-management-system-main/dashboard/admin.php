<?php
session_start();
$admin_email = $_SESSION['admin_email'];

if (!empty($admin_email)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Profile</title>
    <style>
        :root {
            --text-color: #fff;
            --bg-color: #F9E3E3;
            --main-color: #04f929;
            --h1-font: 6rem;
            --h2-font: 3rem;
            --p-font: 1rem;
            --card-color: #137db1;
            --color1: #FF5733;
            --color2: #33FFBD;
            --color3: #FF33A1;
        }

        header {
            position: relative;
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
            background-color: rgba(255, 255, 255, 0.3);
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.2);
        }

        .profile-container {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .profile-info {
            margin-bottom: 20px;
            text-align: center;
        }

        .profile-actions-wrapper {
            display: flex;
            align-items: flex-start;
        }

        .action-buttons {
            display: flex;
            flex-direction: column;
            margin-bottom: 20px;
        }

        .action-buttons button {
            margin: 5px 0;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            background-color: var(--color1);
            color: white;
            text-align: left;
            width: 200px;
        }

        .secondary-btn, .child-btn {
            display: none;
            flex-direction: column;
        }

        .secondary-btn.active {
            display: flex;
            flex-direction: column;
            margin-left: 20px;
        }

        .child-btn.active {
            display: flex;
        }

        .intermediate-btn {
            background-color: var(--color2);
            margin: 5px 10px;
            padding: 10px 20px;
            width: auto;
            text-align: left;
        }

        .child-btn div {
            display: none;
            flex-direction: column;
        }

        .child-btn div.active {
            display: flex;
            background-color: var(--color3);
        }

        .child-btn a {
            color: white;
            text-decoration: none;
            padding: 5px;
            display: block;
        }

        .child-btn a:hover {
            text-decoration: underline;
        }
        
        nav {
            display: flex;
        }

        nav ul {
            list-style: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        nav ul li {
            margin: 0 10px;
        }

        nav ul li a {
            color: var(--text-color);
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        nav ul li a:hover {
            background-color: var(--main-color);
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

    </style>
</head>
<body>

<header>
    
    

    <nav>
        <ul>
            <li><a href="../test/homepage.php">Home</a></li>
            <li><a href="../movieadmin/AdminShowMovieList.php">Movies</a></li>

            <li class="dropdown">
                <a href="#">Language</a>
                <div class="dropdown-content">
                    <a href="add_language.php">Add Language</a>
                    <a href="show_language.php">Show Language</a>
                    <a href="delete_language.php">Delete Language</a>
                    <!-- Add more dropdown items as needed -->
                </div>
                
            </li>

            <li class="dropdown">
                <a href="#">Genre</a>
                <div class="dropdown-content">
                    <a href="add_language.php">Add Genre</a>
                    <a href="show_language.php">Show Genre</a>
                    <a href="delete_language.php">Delete Genre</a>
                    <!-- Add more dropdown items as needed -->
                </div>
                
            </li>

            
            
                
          
            
            <!-- Add more top-level navigation items as needed -->
        </ul>
    </nav>
    <form class="search-form" action="/search" method="GET">
        <div class="search-bar">
            <input type="text" name="query" placeholder="Search...">
        </div>
        <div class="submit-button">
            <button type="submit">Search</button>
        </div>
    </form>
</header>

<div class="profile-container">
    <div class="profile-info">
        <?php
        include '../connection/connection.php';

        echo '<div class="container">';
        echo '<h2>Admin Profile</h2>';

        $sql = "SELECT * FROM adminsignup WHERE Email='$admin_email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
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
    </div>

    <div class="profile-actions-wrapper">
        <div class="action-buttons">
            <button id="language">Language</button>
            <button id="genre">Genre</button>
            <button id="director">Director</button>
            <button id="cast">Cast</button>
            <button id="producer">Producer</button>
            <button id="all-movies">All Movies</button>
            <button id="food">Food</button>
            <button id="reviews">Reviews</button>
            <button id="coupon">Coupon</button>
            <button id="producer-income">Producer Income</button>
            <button id="approve-account">Approve Account</button>
            <button id="others">Others</button>
        </div>

        <div class="profile-actions">
            <div class="secondary-btn language-section">
                <a class="intermediate-btn" href="add_language.php">Add Language</a>
                <a class="intermediate-btn" href="show_language.php">Show Language</a>
                <a class="intermediate-btn" href="delete_language.php">Delete Language</a>
            </div>

            <div class="secondary-btn genre-section">
                <a class="intermediate-btn" href="add_genre.php">Add Genre</a>
                <a class="intermediate-btn" href="show_genre.php">Show Genre</a>
                <a class="intermediate-btn" href="delete_genre.php">Delete Genre</a>
            </div>

            <div class="secondary-btn director-section">
                <a class="intermediate-btn" href="add_director.php">Add Director</a>
                <a class="intermediate-btn" href="show_director.php">Show Director</a>
                <a class="intermediate-btn" href="delete_director.php">Delete Director</a>
                <a class="intermediate-btn" href="assign_director.php">Assign Director to Movie</a>
            </div>

            <div class="secondary-btn cast-section">
                <a class="intermediate-btn" href="add_cast.php">Add Cast</a>
                <a class="intermediate-btn" href="show_cast.php">Show Cast</a>
                <a class="intermediate-btn" href="delete_cast.php">Delete Cast</a>
                <a class="intermediate-btn" href="assign_cast.php">Assign Cast to Movie</a>
            </div>

            <div class="secondary-btn producer-section">
                <a class="intermediate-btn" href="add_producer.php">Add Producer</a>
                <a class="intermediate-btn" href="show_producer.php">Show Producer</a>
                <a class="intermediate-btn" href="delete_producer.php">Delete Producer</a>
                <a class="intermediate-btn" href="assign_producer.php">Assign Producer to Movie</a>
            </div>

            <div class="secondary-btn all-movies-section">
                <a class="intermediate-btn" href="add_movie.php">Add Movie</a>
                <a class="intermediate-btn" href="show_movie.php">Show Movie</a>
                <a class="intermediate-btn" href="delete_movie.php">Delete Movie</a>
            </div>

            <div class="secondary-btn food-section">
                <a class="intermediate-btn" href="add_food.php">Add Food</a>
                <a class="intermediate-btn" href="show_food.php">Show Food</a>
                <a class="intermediate-btn" href="delete_food.php">Delete Food</a>
            </div>

            <div class="secondary-btn reviews-section">
                <a class="intermediate-btn" href="movie_rating.php">Movie Rating</a>
                <a class="intermediate-btn" href="cast_rating.php">Cast Rating</a>
                <a class="intermediate-btn" href="director_rating.php">Director Rating</a>
            </div>

            <div class="secondary-btn coupon-section">
                <a class="intermediate-btn" href="add_coupon.php">Add Coupon</a>
                <a class="intermediate-btn" href="show_coupon.php">Show Coupon</a>
                <a class="intermediate-btn" href="delete_coupon.php">Delete Coupon</a>
            </div>

            <div class="secondary-btn producer-income-section">
                <a class="intermediate-btn" href="producer_income.php">Producer Income</a>
            </div>

            <div class="secondary-btn approve-account-section">
                <a class="intermediate-btn" href="approve_account.php">Approve Account</a>
            </div>

            <div class="secondary-btn others-section">
                <a class="intermediate-btn" href="button1.php">Button 1</a>
                <a class="intermediate-btn" href="button2.php">Button 2</a>
                <a class="intermediate-btn" href="button3.php">Button 3</a>
            </div>
        </div>
    </div>

    <div class="child-btn" id="child-btn">
        <div class="add-movies">
            <button><a href="add_movie.php">Add Movies</a></button>
        </div>

        <div class="show-movies">
            <button><a href="show_movie.php">Show Movies</a></button>
        </div>

        <div class="delete-movies">
            <button><a href="delete_movie.php">Delete Movies</a></button>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const actionButtons = document.querySelectorAll('.action-buttons button');
        const secondaryBtnContainer = document.querySelector('.profile-actions');
        const secondarySections = secondaryBtnContainer.querySelectorAll('.secondary-btn');
        const intermediateButtons = document.querySelectorAll('.intermediate-btn');
        const childBtnContainer = document.getElementById('child-btn');
        const childSections = childBtnContainer.querySelectorAll('div');

        actionButtons.forEach(button => {
            button.addEventListener('click', () => {
                const targetClass = button.id + '-section';
                secondarySections.forEach(section => section.classList.remove('active'));
                document.querySelector(`.${targetClass}`).classList.add('active');
                childSections.forEach(section => section.classList.remove('active'));
                childBtnContainer.classList.remove('active');
            });
        });

        intermediateButtons.forEach(button => {
            button.addEventListener('click', () => {
                const target = button.getAttribute('href').split('.php')[0];
                childSections.forEach(section => section.classList.remove('active'));
                document.querySelector(`.${target}`).classList.add('active');
                childBtnContainer.classList.add('active');
            });
        });
    });
</script>

</body>
</html>

<?php
} else {
    header('location:../login/login.php');
}
?>
