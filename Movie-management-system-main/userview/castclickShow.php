<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Cast Details</title>
<style>
body {
    font-family: Arial, sans-serif;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.cast-details {
    border: 1px solid #ccc;
    padding: 20px;
    overflow: auto;
}

.cast-details img {
    max-width: 150px;
    float: left;
    margin-right: 20px;
}

.cast-details h2 {
    margin-top: 0;
}

.cast-details p {
    margin: 5px 0;
}

.cast-details a {
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
    include_once('../connection.php');
    ob_end_clean();

    // Check if castid is set and is a valid integer
    if (isset($_GET['castid']) && filter_var($_GET['castid'], FILTER_VALIDATE_INT)) {
        $castid = intval($_GET['castid']);

        // Fetch cast details
        $sql = "SELECT * FROM casts WHERE CastID = $castid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo '<div class="cast-details">';
            echo '<img src="../moviePersons/cast/images/' . htmlspecialchars($row["Image"]) . '" alt="' . htmlspecialchars($row["Name"]) . '">';
            echo '<h2>' . htmlspecialchars($row["Name"]) . '</h2>';
            echo '<p><strong>Birthdate:</strong> ' . htmlspecialchars($row["Birthdate"]) . '</p>';
            echo '<p><strong>Gender:</strong> ' . htmlspecialchars($row["Gender"]) . '</p>';
            echo '<p><strong>Nationality:</strong> ' . htmlspecialchars($row["Nationality"]) . '</p>';
            echo '<p><strong>Bio:</strong> ' . htmlspecialchars($row["Bio"]) . '</p>';
            echo '<p><strong>Contact:</strong> <a href="' . htmlspecialchars($row["ContactLink"]) . '" target="_blank">Contact Link</a></p>';
            echo '<a href="../moviePersons/cast/castUseraccess/castWork.php?CastID=' . urlencode($castid) . '">Click to see others of this person</a>';
            echo '</div>';
        } else {
            echo "<p>Cast member not found.</p>";
        }
    } else {
        echo "<p>Invalid cast member specified.</p>";
    }

    $conn->close();
    ?>
</div>  

</body>
</html>
