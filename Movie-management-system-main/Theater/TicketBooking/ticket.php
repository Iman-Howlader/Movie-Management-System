<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Management</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image:url("../../image_bacground/aspect-ratio-video-beginners-borrowlenses.jpg");
        }

        /* Container Styles */
        .container {
            max-width: 900px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.2);
            overflow-x: auto; /* Allow horizontal scrolling for small screens */
        }

        /* Heading Styles */
        h1 {
            font-size: 32px;
            margin-bottom: 20px;
            color: #333;
            text-align: center;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 8px;
            margin-top: 20px;
            border: 2px solid #CDDBE6; /* Add border to the table */
            border-radius: 10px;
            background-color: rgba(0, 0, 0,0.10);
            backdrop-filter:saturate(180%) blur(15px);
        }

        th, td {
            padding: 15px;
            text-align: left;
            border-bottom: 2px solid #F1B533;
        }

        th {
            background-color: #CEAFAF;
            color: #fff;
            font-weight: bold;
        }

        /* Apply alternating background colors to table rows */
        tr:nth-child(even) {
            background-color: rgba(0, 0, 0,0.10);
    backdrop-filter:saturate(180%) blur(15px);
        }

        /* Image Styles */
        img {
            max-width: 120px;
            height: auto;
            display: block;
            margin: 0 auto;
            border-radius: 8px;
            border: 2px solid #fff;
            box-shadow: 0 0 8px rgba(0, 0, 0, 0.1);
            cursor: pointer; /* Change cursor to pointer on hover */
        }

        /* Link Styles */
        a {
            text-decoration: none;
            color: #2d68c4;
            font-weight: bold;
        }

        a:hover {
            color: #1a4d94;
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
    position:fixed;
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
    </style>
</head>
<body>
    
<header>
        <a href="homepage.php" class="logo">IZI <span>Movie</span></a>
        <ul class="navbar">
            <li><a href="../../test/homepage.php">Home</a></li>
            <li><a href="../../movieadmin/AdminShowMovieList.php">Movies</a></li>
            <li><a href="#">Watchlist</a></li>
            <li><a href="#">Directors</a></li>
            <li><a href="#">Top10</a></li>
            <li><a href="#">Trailer</a></li>
            <li><a href="ticket.php">Theater</a></li>
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
    <br>
    <br>
    <br>
    
<div class="container">
    <h1>Hall Running Show Movies</h1>
    <table>
        <thead>
        <tr>
            <th>Movie Name</th>
            <th>Poster</th>
            <th>Start Time</th>
            <th>End Time</th>
            <th>Ticket Price</th>
        </tr>
        </thead>
        <tbody>
        <?php
        ob_start();
        include '../../connection.php';
        ob_end_clean();
        $location="";

         if(isset($_GET['location'])){
        $location = $_GET['location'];
         }
       
        // Query to fetch movie information from theaterMovie and movie tables
        if($location==="All"){
        $query = "SELECT theatermovie.*, movie.* 
        FROM theatermovie 
        INNER JOIN movie 
        ON theatermovie.MovieID = movie.MovieID ";
       
       
        }
        else{
          $query = "SELECT theatermovie.*, movie.* 
        FROM theatermovie 
        INNER JOIN movie 
        ON theatermovie.MovieID = movie.MovieID 
        WHERE theatermovie.Location = '$location'";
        

        }
        $result = mysqli_query($conn, $query);

        // Check if query executed successfully and returned a valid result
        if ($result && mysqli_num_rows($result) > 0) {
            // Loop through each movie entry
            while($row = mysqli_fetch_assoc($result)) {
                ?>
                <tr>  
                    <td>
                        <!-- Movie name with a link -->
                        <a href="#" onclick="selectMovie('<?php echo $row['Title']; ?>')"><?php echo $row['Title']; ?></a>
                    </td>
                    <td>
                        <!-- Clickable poster with confirmation popup -->
                        <a href="javascript:void(0);" onclick="showConfirmation('<?php echo $row['Title']; ?>', '<?php echo $row['HallMovieID']; ?>')">
                            <img src="../../movieadmin/images/<?php echo $row['Image']; ?>" alt="<?php echo $row['Title']; ?>">
                        </a>
                    </td>
                    <td><?php echo $row['StartTime']; ?></td>
                    <td><?php echo $row['EndTime']; ?></td>
                    <td>$<?php echo $row['TicketPrice']; ?></td>
                </tr>
                <?php
            }
        } else {
            // Display a message if no movies found
            echo "<tr><td colspan='5'>No movies found</td></tr>";
        }
        ?>
        </tbody>
    </table>
</div>

<!-- JavaScript function to select a movie -->
<script>
    function selectMovie(movieName) {
        // You can perform any action here, like storing the selected movie name in a variable or redirecting to another page
        alert("You have selected: " + movieName);
    }

    function showConfirmation(movieName, hallMovieID) {
        if (confirm("Are you sure you want to book tickets for '" + movieName + "'?")) {
            window.location.href = "bookingDate.php?hallMovieID=" + hallMovieID;
        }
    }
</script>
</body>
</html>
