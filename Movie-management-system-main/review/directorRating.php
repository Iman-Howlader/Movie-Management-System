<?php
session_start();
$user_email = $_SESSION['user_email'];

if (!empty($user_email)) {
    // Database connection
    include '../connection/connection.php';

    // Handle rating submission
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['rating'], $_POST['director_id'], $_POST['comment'])) {
        $director_id = intval($_POST['director_id']);
        $rating = intval($_POST['rating']);
        $comment = $conn->real_escape_string($_POST['comment']);
        $user_email = $conn->real_escape_string($user_email);

        // Check if the user has already rated this movie
        $check_sql = "SELECT * FROM directorrating WHERE UserEmail='$user_email' AND DirectorID='$director_id'";
        $check_result = $conn->query($check_sql);

        if ($check_result->num_rows > 0) {
            // Update existing rating and comment
           // $sql = "UPDATE movierating SET Rating=$rating, Comment='$comment' WHERE UserEmail='$user_email' AND MovieID=$movie_id";
          // echo "<script> alert('You previously  rate this  person ,Try another one') </script>";
          echo "
       <div id='customAlert' style='display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background-color:#ff0000; padding:20px; border:2px solid #f5c6cb; border-radius:5px; z-index:1000;'>
       <span style='color:white; font-size:20px;'>You previously rated this person, try another one</span>
      <br><br>
     <button onclick='document.getElementById(\"customAlert\").style.display=\"none\";' style='padding:10px 20px; font-size:16px;'>OK</button>
    </div>
    <script>
     document.getElementById('customAlert').style.display = 'block';
    </script>";



        } else {

            // Insert new rating and comment
            $sql = "INSERT INTO directorrating (UserEmail, DirectorID, Rating, Comment) VALUES ('$user_email', $director_id, $rating, '$comment')";
           // echo "<script> alert('Successful') </script>";
           echo "
           <div id='customAlert' style='display:none; position:fixed; top:50%; left:50%; transform:translate(-50%, -50%); background-color:#008000; padding:20px; border:2px solid #f5c6cb; border-radius:5px; z-index:1000;'>
           <span style='color:white; font-size:20px;'>SuccessFully rated </span>
          <br><br>
         <button onclick='document.getElementById(\"customAlert\").style.display=\"none\";' style='padding:10px 20px; font-size:16px;'>OK</button>
        </div>
        <script>
         document.getElementById('customAlert').style.display = 'block';
        </script>";
    
            $conn->query($sql);
        }
       
    }

    // Fetch movies
    $sql = "SELECT * FROM directors";
    $result = $conn->query($sql);
    ?>

    <!DOCTYPE html>
    <html>
    <head>
        <title>Director Ratings</title>
        <style>
            body {
                font-family: Arial, sans-serif;
                margin: 0;
                padding: 0;
                background-color: #f4f4f4;
            }
            .container {
                width: 80%;
                margin: 0 auto;
                padding: 20px;
            }
            .movie {
                border: 1px solid #ddd;
                margin: 20px 0;
                padding: 20px;
                background-color: #fff;
            }
            .movie img {
                max-width: 200px;
                height: auto;
            }
            .rating-form {
                margin-top: 10px;
            }
            .stars {
                display: flex;
                flex-direction: row-reverse;
                justify-content: flex-end;
            }
            .stars input[type="radio"] {
                display: none;
            }
            .stars label {
                font-size: 2rem;
                color: #ddd;
                cursor: pointer;
            }
            .stars input[type="radio"]:checked ~ label {
                color: #f5b301;
            }
            .stars label:hover,
            .stars label:hover ~ label {
                color: #f5b301;
            }
        </style>
    </head>
    <body>

    <div class="container">
        <h1>Director Ratings</h1>
        <?php if ($result->num_rows > 0): ?>
            <?php while($row = $result->fetch_assoc()): ?>
                <div class="movie">
                    <h2><?php echo htmlspecialchars($row['Name']); ?></h2>
                    <?php
                    $image_filename = htmlspecialchars($row["Image"]);
                    $image_path = '../moviePersons/director/images/' . $image_filename;
                    ?>
                    <img src="<?php echo $image_path; ?>" alt="<?php echo htmlspecialchars($row['Name']); ?>" width='200'>

                    <form class="rating-form" method="POST" action="">
                        <div class="stars">
                            <input type="radio" id="star5_<?php echo $row['DirectorID']; ?>" name="rating" value="5" required /><label for="star5_<?php echo $row['DirectorID']; ?>">&#9733;</label>
                            <input type="radio" id="star4_<?php echo $row['DirectorID']; ?>" name="rating" value="4" required /><label for="star4_<?php echo $row['DirectorID']; ?>">&#9733;</label>
                            <input type="radio" id="star3_<?php echo $row['DirectorID']; ?>" name="rating" value="3" required /><label for="star3_<?php echo $row['DirectorID']; ?>">&#9733;</label>
                            <input type="radio" id="star2_<?php echo $row['DirectorID']; ?>" name="rating" value="2" required /><label for="star2_<?php echo $row['DirectorID']; ?>">&#9733;</label>
                            <input type="radio" id="star1_<?php echo $row['DirectorID']; ?>" name="rating" value="1" required /><label for="star1_<?php echo $row['DirectorID']; ?>">&#9733;</label>
                        </div>
                        <label for="comment_<?php echo $row['DirectorID']; ?>">Comment:</label>
                        <textarea name="comment" id="comment_<?php echo $row['DirectorID']; ?>" rows="4" cols="50" required></textarea>
                        <input type="hidden" name="director_id" value="<?php echo $row['DirectorID']; ?>">
                        <button type="submit">Submit Rating</button>
                    </form>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p>No movies found.</p>
        <?php endif; ?>
    </div>

    </body>
    </html>

    <?php
    $conn->close();
} else {
    header('Location: ../../login/login.php');
    exit();
}
?>
