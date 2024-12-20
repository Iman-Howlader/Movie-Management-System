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
    <title>Choose Booking Date</title>
    <style>
        
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://repository-images.githubusercontent.com/201763429/30616780-bd1a-11e9-840c-edafb61c8f99') no-repeat center center fixed;
            background-size: cover;
        }

        /* Container Styles */
        .container {
            max-width: 600px;
            margin: 30px auto;
            padding: 140px;
            background-color: rgba(255, 255, 255, 0.); /* Transparent white background */
            border-radius: 50px;
            box-shadow: 1 1 15px rgba(0, 0, 0, 0.1);
        }

        /* Heading Styles */
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #ff0000;
            text-align: center;
        }

        /* Form Styles */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            color: #ffffff;
        }

        input[type="date"], input[type="submit"] {
            margin-bottom: 80px;
            padding: 8px 15px;
            border-radius: 4px;
            border: 3px solid #ccc;
            font-size: 16px;
        }

        input[type="submit"] {
            background-color: #1464a5;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {

            background-color: #1a4d94;
           
            border: 2px solid #ccc;
           
           
        }

        /* Red background for invalid dates */
        input[type="date"].invalid-date {
            background-color: #ff5151;
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
    background: lightcyan;
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
<div class="container">
    <h1>Choose Booking Date</h1>
    <form action="booking.php" method="GET" onsubmit="return validateDate()">
        <label for="bookingDate">Select Date:</label>
        <!-- PHP code to generate dates -->
        <input type="date" id="bookingDate" name="bookingDate" required>
        <?php
        // Check if hallMovieID is set in the URL
        if(isset($_GET['hallMovieID'])) {
            // Store hallMovieID in a variable
            $hallMovieID = $_GET['hallMovieID'];
            // Output hallMovieID as a hidden input field in the form
            echo '<input type="hidden" name="hallMovieID" value="'.$hallMovieID.'">';
        }
        ?>
        <input type="submit" value="Next">
    </form>
</div>
<script>
    function validateDate() {
        var selectedDate = new Date(document.getElementById('bookingDate').value);
        var today = new Date();
        var maxDate = new Date(today);
        maxDate.setDate(today.getDate() + 7); // Max date is 7 days from today

        if (selectedDate < today || selectedDate > maxDate) {
            document.getElementById('bookingDate').classList.add('invalid-date');
            return false;
        } else {
            document.getElementById('bookingDate').classList.remove('invalid-date');
            return true;
        }
    }

    // Set minimum date attribute dynamically to today's date
    document.getElementById('bookingDate').setAttribute('min', new Date().toISOString().split('T')[0]);
</script>
<?php  }else{
  header('location:../../login/login.php');
} ?>
</body>
</html>
