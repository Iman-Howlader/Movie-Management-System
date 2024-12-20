<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Genre Details</title>
<style>
body {
    font-family: Arial, sans-serif;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.genre-details {
    border: 1px solid #ccc;
    padding: 20px;
    overflow: auto;
}

.genre-details h2 {
    margin-top: 0;
}

.genre-details p {
    margin: 5px 0;
}

.genre-details a {
    display: block;
    margin-top: 10px;
    color: blue;
    text-decoration: none;
}
</style>
</head>
<body>

<div class="container">
    <?php
    // Include the connection file
    ob_start();
    include ('../connection.php');
    ob_end_clean();
    // Check if genreid is set and is a valid integer
    if (isset($_GET['genreid'])) {
        $genreid = $_GET['genreid'];

        // Fetch genre details
        $sql = "SELECT * FROM genres WHERE genre_name = '$genreid'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo '<div class="genre-details">';
            echo '<h2>' . htmlspecialchars($row["genre_name"]) . '</h2>';
            echo '<p><strong>Description:</strong> ' . htmlspecialchars($row["description"]) . '</p>';
            echo '<a href="genremovie.php?genre_name=' . urlencode($genreid) . '">Click to see movies of this genre</a>';
            echo '</div>';
        } else {
            echo "<p>Genre not found.</p>";
        }
    } else {
        echo "<p>Invalid genre specified.</p>";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
