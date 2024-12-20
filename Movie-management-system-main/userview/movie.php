

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Movie Database</title>
<header>
   <?php include '../navbar/nav.php';?>
</header>

<style>
body {
    padding-top: 70px;
    font-family: Arial, sans-serif;
}

.container {
    margin-top: 20px;
    max-width: 800px;
    margin: 0 auto;
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
    width: calc(100% - 140px); /* Adjust this value as needed */
}

.movie h2 {
    margin-top: 0;
}

.cast-details, .director-details, .producer-details {
    margin-top: 10px;
}

.cast, .director, .producer {
    font-weight: bold;
}

.trailer {
    float: right;
    width: 300px; /* Adjust this value as needed */
    margin-left: 20px;
}

.trailer iframe {
    width: 100%;
    height: 200px; /* Adjust the height as needed */
}
</style>
</head>
<body>
    <h1 class="container"> MOVIES LIST</h1>


<div class="container">
    <?php
    // Include the connection file
    ob_start();
    include_once('../connection.php');
    ob_end_clean();

    // Function to fetch and display movies
    function displayMovies($conn) {
        $sql = "SELECT m.*, GROUP_CONCAT(c.Name) AS CastNames, GROUP_CONCAT(c.CastID) AS CastIDs, 
                       d.Name AS Director, d.DirectorID, p.Name AS Producer, p.ProducerID
                FROM movie m
                LEFT JOIN castwork cw ON m.MovieID = cw.MovieID
                LEFT JOIN casts c ON cw.CastID = c.CastID
                LEFT JOIN directorwork dw ON m.MovieID = dw.MovieID
                LEFT JOIN directors d ON dw.DirectorID = d.DirectorID
                LEFT JOIN producerwork pw ON m.MovieID = pw.MovieID
                LEFT JOIN producer p ON pw.ProducerID = p.ProducerID
                GROUP BY m.MovieID"; // Grouping cast members by movie ID
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="movie">';
                echo '<img src="../movieadmin/images/' . htmlspecialchars($row["Image"]) . '" alt="' . htmlspecialchars($row["Title"]) . '">';
                echo '<div class="movie-details">';
                echo '<h2>' . htmlspecialchars($row["Title"]) . '</h2>';
                echo '<p><strong>Genre:</strong> <a href="genreclickSHow.php?genreid=' . urlencode($row["Genre"]) . '">' . htmlspecialchars($row["Genre"]) . '</a></p>';
               // echo '<p><strong>Director:</strong> <a href="show.php?directorid=' . urlencode($row["DirectorID"]) . '">' . htmlspecialchars($row["Director"]) . '</a></p>';
                echo '<p><strong>Release Date:</strong> ' . htmlspecialchars($row["Release_date"]) . '</p>';
                echo '<p><strong>Duration:</strong> ' . htmlspecialchars($row["Duration"]) . ' mins</p>';
                echo '<p><strong>Language:</strong> <a href="languageclickShow.php?language_id=' . urlencode($row["Language"]) . '">' . htmlspecialchars($row["Language"]) . '</a></p>';
                echo '<p><strong>Description:</strong> ' . htmlspecialchars($row["Description"]) . '</p>';
                echo '<p><strong>Budget:</strong> $' . htmlspecialchars($row["Budget"]) . '</p>';

                // Display cast details
                if (!empty($row['CastNames'])) {
                    echo '<div class="cast-details">';
                    echo '<p class="cast">Cast:</p>';
                    // Displaying all cast members
                    $cast_names = explode(',', $row['CastNames']);
                    $cast_ids = explode(',', $row['CastIDs']);
                    for ($i = 0; $i < count($cast_names); $i++) {
                        echo '<p><a href="castclickShow.php?castid=' . urlencode($cast_ids[$i]) . '">' . htmlspecialchars($cast_names[$i]) . '</a></p>';
                    }
                    echo '</div>';
                }

                // Display director details
                if (!empty($row['Director'])) {
                    echo '<div class="director-details">';
                    echo '<p class="director">Director:</p>';
                    echo '<p><a href="directorclickShow.php?DirectorID=' . urlencode($row['DirectorID']) . '">' . htmlspecialchars($row['Director']) . '</a></p>';
                    echo '</div>';
                }

                // Display producer details
                if (!empty($row['Producer'])) {
                    echo '<div class="producer-details">';
                    echo '<p class="producer">Producer:</p>';
                    echo '<p><a href="producerclickShow.php?ProducerID=' . urlencode($row['ProducerID']) . '">' . htmlspecialchars($row['Producer']) . '</a></p>';
                    echo '</div>';
                }

                echo '</div>';

                // Fetch trailer link
                $trailer_sql = "SELECT * FROM trailer WHERE MovieID = " . intval($row["MovieID"]);
                $trailer_result = $conn->query($trailer_sql);
                if ($trailer_result->num_rows > 0) {
                    $trailer_row = $trailer_result->fetch_assoc();
                    // Extract video ID from YouTube link
                    $video_id = getYoutubeVideoId($trailer_row["TrailerLink"]);
                    if ($video_id) {
                        echo '<div class="trailer">';
                        echo '<iframe width="720" height="315" src="https://www.youtube.com/embed/' . htmlspecialchars($video_id) . '" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>';
                        echo '</div>';
                    } else {
                        echo '<p>Invalid YouTube link</p>';
                    }
                }

                echo '</div>';
            }
        } else {
            echo "No movies found.";
        }
    }

    // Display movies
    displayMovies($conn);

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
    ?>

</div>

</body>
</html>
