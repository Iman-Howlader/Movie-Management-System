<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Producer Details</title>
<style>
body {
    font-family: Arial, sans-serif;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.producer-details {
    border: 1px solid #ccc;
    padding: 20px;
    overflow: auto;
}

.producer-details img {
    max-width: 150px;
    float: left;
    margin-right: 20px;
}

.producer-details h2 {
    margin-top: 0;
}

.producer-details p {
    margin: 5px 0;
}

.producer-details a {
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

    // Check if producerid is set and is a valid integer
    if (isset($_GET['ProducerID']) && filter_var($_GET['ProducerID'], FILTER_VALIDATE_INT)) {
        $producerid = intval($_GET['ProducerID']);

        // Fetch producer details
        $sql = "SELECT * FROM producer WHERE ProducerID = $producerid";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();

            echo '<div class="producer-details">';
           // echo '<img src="../movieadmin/images/' . htmlspecialchars($row["Image"]) . '" alt="' . htmlspecialchars($row["Name"]) . '">';
            echo '<h2>' . htmlspecialchars($row["Name"]) . '</h2>';
            echo '<p><strong>Company:</strong> ' . htmlspecialchars($row["Company"]) . '</p>';
            
            // Display website link if available
            if (!empty($row["Website"])) {
                echo '<p><strong>Website:</strong> <a href="' . htmlspecialchars($row["Website"]) . '" target="_blank">' . htmlspecialchars($row["Website"]) . '</a></p>';
            }
            
            echo '<a href="../moviePersons/producer/producerUserAccess/producerWork.php?ProducerID=' . urlencode($producerid) . '">Click to see this person\'s work</a>';
            echo '</div>';
        } else {
            echo "<p>Producer not found.</p>";
        }
    } else {
        echo "<p>Invalid producer specified.</p>";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
