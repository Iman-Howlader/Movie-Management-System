<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Director Details</title>
<style>
body {
    font-family: Arial, sans-serif;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.director-details {
    border: 1px solid #ccc;
    padding: 20px;
    overflow: auto;
}

.director-details img {
    max-width: 150px;
    float: left;
    margin-right: 20px;
}

.director-details h2 {
    margin-top: 0;
}

.director-details p {
    margin: 5px 0;
}

.director-details a {
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
    include_once('../connection/connection.php');
    ob_end_clean();

    // Check if directorid is set and is a valid integer
    if (isset($_GET['DirectorID']) && filter_var($_GET['DirectorID'], FILTER_VALIDATE_INT)) {
        $directorid = intval($_GET['DirectorID']);

        // Fetch director details
        $sql = "SELECT * FROM directors WHERE DirectorID = $directorid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo '<div class="director-details">';
            echo '<img src="../moviePersons/director/images/' . htmlspecialchars($row["Image"]) . '" alt="' . htmlspecialchars($row["Name"]) . '">';
            echo '<h2>' . htmlspecialchars($row["Name"]) . '</h2>';
            echo '<p><strong>Birthdate:</strong> ' . htmlspecialchars($row["Birthdate"]) . '</p>';
            echo '<p><strong>Gender:</strong> ' . htmlspecialchars($row["Gender"]) . '</p>';
            echo '<p><strong>Nationality:</strong> ' . htmlspecialchars($row["Nationality"]) . '</p>';
            echo '<p><strong>Bio:</strong> ' . htmlspecialchars($row["Bio"]) . '</p>';
            echo '<a href="../moviePersons/director/directorUserAccess/directorWork.php?DirectorID=' . urlencode($directorid) . '">Click to see this person\'s work</a>';
            echo '</div>';
        } else {
            echo "<p>Director not found.</p>";
        }
    } else {
        echo "<p>Invalid director specified.</p>";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
