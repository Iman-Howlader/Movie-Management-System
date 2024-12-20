<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Movies by Language</title>
<style>
body {
    font-family: Arial, sans-serif;
}

.container {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.movie {
    border: 1px solid #ccc;
    margin-bottom: 20px;
    padding: 20px;
    overflow: auto;
}

.movie img {
    max-width: 100px;
    float: left;
    margin-right: 20px;
}

.movie-details {
    float: left;
    width: calc(100% - 140px);
}

.movie h2 {
    margin-top: 0;
}

.movie p {
    margin: 5px 0;
}

.movie a {
    color: blue;
    text-decoration: none;
}

.trailer {
    float: right;
    width: 300px;
    margin-left: 20px;
}

.trailer iframe {
    width: 100%;
    height: 200px;
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

    // Function to extract YouTube video ID from URL
    function getYoutubeVideoId($url) {
        $video_id = false;
        $url_components = parse_url($url);
        if (isset($url_components['query'])) {
            parse_str($url_components['query'], $params);
            if (isset($params['v'])) {
                $video_id = $params['v'];
            }
        }
        return $video_id;
    }

    // Check if language_name is set
    if (isset($_GET['language_name'])) {
        $language_name = $conn->real_escape_string($_GET['language_name']);

        // Fetch movies by language
        $sql = "SELECT m.*, GROUP_CONCAT(c.Name) AS Cast, GROUP_CONCAT(c.CastID) AS CastIDs, d.DirectorID, d.Name AS Director, p.ProducerID, p.Name AS Producer
                FROM movie m
                LEFT JOIN castwork cw ON m.MovieID = cw.MovieID
                LEFT JOIN casts c ON cw.CastID = c.CastId
                LEFT JOIN directorwork dw ON m.MovieID = dw.MovieID
                LEFT JOIN directors d ON dw.DirectorID = d.DirectorID
                LEFT JOIN producerwork pw ON m.MovieID = pw.MovieID
                LEFT JOIN producer p ON pw.ProducerID = p.ProducerID
                WHERE m.Language = '$language_name'
                GROUP BY m.MovieID";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo '<div class="movie">';
                echo '<img src="../movieadmin/images/' . htmlspecialchars($row["Image"]) . '" alt="' . htmlspecialchars($row["Title"]) . '">';
                echo '<div class="movie-details">';
                echo '<h2>' . htmlspecialchars($row["Title"]) . '</h2>';
                echo '<p><strong>Genre:</strong> ' . htmlspecialchars($row["Genre"]) . '</p>';
                echo '<p><strong>Director:</strong> <a href="directorClickShow.php?directorid=' . urlencode($row["DirectorID"]) . '">' . htmlspecialchars($row["Director"]) . '</a></p>';
                echo '<p><strong>Release Date:</strong> ' . htmlspecialchars($row["Release_date"]) . '</p>';
                echo '<p><strong>Duration:</strong> ' . htmlspecialchars($row["Duration"]) . ' mins</p>';
                echo '<p><strong>Language:</strong> ' . htmlspecialchars($row["Language"]) . '</p>';
                echo '<p><strong>Description:</strong> ' . htmlspecialchars($row["Description"]) . '</p>';
                echo '<p><strong>Budget:</strong> $' . htmlspecialchars($row["Budget"]) . '</p>';

                // Display cast details
                if (!empty($row['Cast'])) {
                    echo '<p><strong>Cast:</strong> ';
                    $cast_members = explode(',', $row['Cast']);
                    $cast_ids = explode(',', $row['CastIDs']);
                    for ($i = 0; $i < count($cast_members); $i++) {
                        echo '<a href="castClickShow.php?castid=' . urlencode($cast_ids[$i]) . '">' . htmlspecialchars($cast_members[$i]) . '</a>';
                        if ($i < count($cast_members) - 1) {
                            echo ', ';
                        }
                    }
                    echo '</p>';
                }

                // Display producer details
                if (!empty($row['Producer'])) {
                    echo '<p><strong>Producer:</strong> <a href="producerClickShow.php?producerid=' . urlencode($row["ProducerID"]) . '">' . htmlspecialchars($row["Producer"]) . '</a></p>';
                }

                // Fetch trailer link
                $trailer_sql = "SELECT * FROM trailer WHERE MovieID = " . $row["MovieID"];
                $trailer_result = $conn->query($trailer_sql);
                if ($trailer_result->num_rows > 0) {
                    $trailer_row = $trailer_result->fetch_assoc();
                    $video_id = getYoutubeVideoId($trailer_row["TrailerLink"]);
                    if ($video_id) {
                        echo '<div class="trailer">';
                        echo '<iframe src="https://www.youtube.com/embed/' . $video_id . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        echo '</div>';
                    }
                }

                echo '</div>';
                echo '</div>';
            }
        } else {
            echo "<p>No movies found for language: " . htmlspecialchars($language_name) . ".</p>";
        }
    } else {
        echo "<p>No language specified.</p>";
    }

    $conn->close();
    ?>
</div>

</body>
</html>
