<?php
include '../../connection/connection.php';

// Enable exception handling for MySQLi
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Trailer to Movie</title>
    <style>
        /* Add some basic styling to the form */
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
        <label for="movie_id">Movie:</label>
        <select name="movie_id" id="movie_id">
            <?php
            // Query to retrieve all movies from the movie table
            $movies = mysqli_query($conn, "SELECT * FROM Movie");
            while ($movie = mysqli_fetch_assoc($movies)) {
                echo "<option value='" . $movie['MovieID'] . "'>" . $movie['Title'] . "</option>";
            }
            ?>
        </select>
        <label for="trailer_link">Trailer Link:</label>
        <input type="text" name="trailer_link" id="trailer_link" required>
        <input type="submit" value="Add Trailer">
    </form>
    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $movie_id = $_POST['movie_id'];
        $trailer_link = $_POST['trailer_link'];
        $sql = "INSERT INTO trailer (MovieID, TrailerLink) VALUES ('$movie_id', '$trailer_link')";

        try {
            mysqli_query($conn, $sql);
            echo "<script>alert('Trailer added to movie successfully!');</script>";
        } catch (mysqli_sql_exception $e) {
            echo "<script>showError('An error occurred: " . addslashes($e->getMessage()) . "');</script>";
        }
    }
    ?>
</body>
</html>
