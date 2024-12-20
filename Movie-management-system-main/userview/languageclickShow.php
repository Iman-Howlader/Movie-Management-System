<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Language Details</title>
<style>
body {
    font-family: Arial, sans-serif;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.language {
    border: 1px solid #ccc;
    margin-bottom: 20px;
    padding: 20px;
    overflow: auto;
}

.language-details {
    width: 100%;
}

.language h2 {
    margin-top: 0;
}

.language p {
    margin: 5px 0;
}

.language a {
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
    include('../connection.php');
    ob_end_clean();

    // Check if language_id is set
    if (isset($_GET['language_id'])) {
        $language_id = $_GET['language_id'];

        // Fetch language details
        $sql = "SELECT * FROM languages WHERE language_name = '$language_id'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            echo '<div class="language">';
            echo '<div class="language-details">';
            echo '<h2>' . htmlspecialchars($row["language_name"]) . '</h2>';
            echo '<p><strong>Description:</strong> ' . htmlspecialchars($row["description"]) . '</p>';
            echo '<a href="languagemovie.php?language_name=' . urlencode($row["language_name"]) . '">Click to see movies in this language</a>';
            echo '</div>';
            echo '</div>';
        } else {
            echo "<p>Language not found.</p>";
        }
    } else {
        echo "<p>No language specified.</p>";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
