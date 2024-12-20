<?php
include '../../connection/connection.php';

// Enable exception handling for MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Assign Director to Movie</title>
    <style>
        /* add some basic styling to the form */
        form {
            width: 50%;
            margin: 40px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #3e8e41;
        }
    </style>
    <script>
        function showError(message) {
            alert(message);
        }
    </script>
</head>
<body>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <label for="director_id">Director:</label>
        <select name="director_id" id="director_id">
            <?php
            // assume you have a query to retrieve all directors from the directors table
            $directors = mysqli_query($conn, "SELECT * FROM directors");
            while ($director = mysqli_fetch_assoc($directors)) {
                echo "<option value='" . $director['DirectorID'] . "'>" . $director['Name'] . "</option>";
            }
            ?>
        </select>
        <label for="movie_id">Movie:</label>
        <select name="movie_id" id="movie_id">
            <?php
            // assume you have a query to retrieve all movies from the movie table
            $movies = mysqli_query($conn, "SELECT * FROM Movie");
            while ($movie = mysqli_fetch_assoc($movies)) {
                echo "<option value='" . $movie['MovieID'] . "'>" . $movie['Title'] . "</option>";
            }
            ?>
        </select>
        <input type="submit" value="Assign Director to Movie">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $director_id = $_POST['director_id'];
        $movie_id = $_POST['movie_id'];
        $sql = "INSERT INTO directorWork (DirectorID, MovieID) VALUES ('$director_id', '$movie_id')";

        try {
            mysqli_query($conn, $sql);
            echo "<script>alert('Director assigned to movie successfully!');</script>";
        } catch (mysqli_sql_exception $e) {
            if ($e->getCode() == 1062) { // Duplicate entry error code
                echo "<script>showError('This movie is directed by Another person');</script>";
            } else {
                echo "<script>showError('An error occurred: " . addslashes($e->getMessage()) . "');</script>";
            }
        }
    }
    ?>
</body>
</html>
