
    <?php/*/

                 session_start();
                 $user_id = $_SESSION['user_id'];
                 if(!empty($user_id)){
     
    */?>
    

    
<?php include '../connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Management</title>
    <style>
       


       body {
    color: var(--text-color);
    background-image:url("../image_bacground/aspect-ratio-video-beginners-borrowlenses.jpg");
}

       .logo {
    font-size: 33px;
    font-weight: 700;
    color: var(--text-color);
}

span {
    color: var(--main-color);
}
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            background-color: rgba(0, 0, 0,0.10);
    backdrop-filter:saturate(180%) blur(15px);
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #CEAFAF;
        }

        .add-movie-btn {
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
        }

        .add-movie-btn:hover {
            background-color: #45a049;
        }

        .action-btns {
            display: flex;
            justify-content: space-around;
        }

        .action-btns button {
            padding: 5px 10px;
            margin-right: 5px;
            cursor: pointer;
            border: none;
            border-radius: 3px;
        }

        .action-btns button.delete-btn {
            background-color: #f44336;
            color: white;
        }

        .action-btns button.update-btn {
            background-color: #007bff;
            color: white;
        }

        .action-btns button:hover {
            opacity: 0.8;
        }
        :root {
    --text-color: #fff;
    --bg-color: #000000;
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

.submit-button button:hover {
    background-color: var(--main-color);
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
    
<br>
<br>
<br>


    <table>
        <thead>
            <tr>
                <th>MovieID</th>
                <th>Title</th>
                <th>Poster</th>
                <th>Genre</th>
                <th>Director</th>
                <th>Release Date</th>
                <th>Duration</th>
                <th>Language</th>
                <th>Description</th>
                <th>Budget</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $sql = "SELECT * FROM movie";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["MovieID"] . "</td>";
                    echo "<td>" . $row["Title"] . "</td>";
                    // Fetching image filename from the database
                    $image_filename = $row["Image"];
                    // Generating the image path
                    $image_path = "images/" . $image_filename;
                    // Displaying the image
                    echo "<td><img src='" . $image_path . "' alt='" . $row["Title"] . "' width='100'></td>";
                    echo "<td>" . $row["Genre"] . "</td>";
                    echo "<td>" . $row["Director"] . "</td>";
                    echo "<td>" . $row["Release_date"] . "</td>";
                    echo "<td>" . $row["Duration"] . "</td>";
                    echo "<td>" . $row["Language"] . "</td>";
                    echo "<td>" . $row["Description"] . "</td>";
                    echo "<td>" . $row["Budget"] . "</td>";
                    echo "<td class='action-btns'>";
                    echo "<button class='delete-btn' onclick='window.location.href=\"AdminDeleteMovie.php?MovieID=" . $row["MovieID"] . "\"'>Delete</button>";
                    echo "<button class='update-btn' onclick='window.location.href=\"AdminUpdateMovie.php?MovieID=" . $row["MovieID"] . "\"'>Update</button>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='11'>No movies found</td></tr>";
            }
            ?>
        </tbody>
    </table>

    <button class="add-movie-btn" onclick="window.location.href='AdminAddMovie.php'">Add Movie</button>
</body>
</html>


<?PHP/*
        }else{
               header('location:../login/login.php');
        }
*/?>