<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Genre</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 500px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
        }
        .form-group {
            margin-bottom: 15px;
        }
        .form-group label {
            display: block;
            margin-bottom: 5px;
        }
        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        .form-group button {
            width: 100%;
            padding: 10px;
            background-color: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .form-group button:hover {
            background-color: #218838;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Add a New Genre</h2>
        <form action="" method="post">
            <div class="form-group">
                <label for="genre_name">Genre Name</label>
                <input type="text" id="genre_name" name="genre_name" required>
            </div>
            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <button type="submit" name="submit">Add Genre</button>
            </div>
        </form>
    </div>

    <?php
    if (isset($_POST['submit'])) {
        ob_start();
        include '../../connection/connection.php';
        ob_end_clean();
        $genre_name = $conn->real_escape_string($_POST['genre_name']);
        $description = $conn->real_escape_string($_POST['description']);

        $sql = "INSERT INTO genres (genre_name, description) VALUES ('$genre_name', '$description')";

        if ($conn->query($sql) === TRUE) {
            echo "<script>alert('>New genre added successfully') </script>";
        } else {
            echo "<p>Error: " . $sql . "<br>" . $conn->error . "</p>";
        }

        $conn->close();
    }
    ?>
</body>
</html>
