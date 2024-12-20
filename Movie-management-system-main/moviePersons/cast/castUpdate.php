<?php
// directorUpdate.php

// Include connection file
include '../../connection/connection.php';

// Check if DirectorID is set
if (isset($_GET['CastID'])) {
    $CastID = $_GET['CastID'];

    // Query to fetch director information
    $sql = "SELECT * FROM casts WHERE CastID = '$CastID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display director information in a form
        ?>
        <html>
        <head>
            <title>Update Cast Information</title>
            <link rel="stylesheet" href="castAdd.css">
        </head>
        <body>
            <div class="container">
                 <h2>Update Cast Information</h2>
                <form action="castUpdate.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="CastID" value="<?php echo $CastID; ?>">

                    <input type="text" name="fullname" value="<?php echo htmlspecialchars($row['Name']); ?>" placeholder="Full Name" required>
                    <label>Date of birth</label>
                    <input type="date" name="dob" value="<?php echo htmlspecialchars($row['Birthdate']); ?>" required>

                    <select name="gender" required>
                        <option value="<?php echo htmlspecialchars($row['Gender']); ?>"><?php echo htmlspecialchars($row['Gender']); ?></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>

                    <input type="text" name="nationality" value="<?php echo htmlspecialchars($row['Nationality']); ?>" placeholder="Nationality" required>

                    <label for="bio">Bio:</label>
                    <textarea id="bio" name="bio" rows="4" cols="50" required><?php echo htmlspecialchars($row['Bio']); ?></textarea><br><br>

                    <label for="contactlink">Social Media:</label>
                    <input type="text" name="contactlink" value="<?php echo htmlspecialchars($row['ContactLink']); ?>" placeholder="Social Media Link">

                    <!-- For Image Upload -->
                    <label for="upfile">Upload Profile Picture:</label>
                    <input type="file" name="upfile" id="image" onchange="previewImage(event)">
                    <input type="hidden" name="previous" value="<?php echo htmlspecialchars($row['Image']); ?>">
                    <img id="preview" src="<?php echo 'images/' . htmlspecialchars($row['Image']); ?>" alt="Image Preview" style="display: block; max-width: 100%; max-height: 200px; margin-top: 10px;">

                    <button type="submit" name="submit">Update</button>
                </form>
            </div>

            <script>
                function previewImage(event) {
                    var preview = document.getElementById('preview');
                    var file = event.target.files[0];
                    var reader = new FileReader();

                    reader.onload = function() {
                        preview.src = reader.result;
                        preview.style.display = 'block';
                    };

                    reader.readAsDataURL(file);
                }
            </script>
        </body>
        </html>
        <?php
    } else {
        echo "Cast not found";
    }
} else {
    echo "CastID not set";
}

// Update cast information
if (isset($_POST['submit'])) {
    $CastID = $_POST['CastID'];
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $bio = $_POST['bio'];
    $link = $_POST['contactlink'];

    $previous_image = $_POST['previous'];
    $new_image = $previous_image;

    // Handle file upload
    if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == UPLOAD_ERR_OK) {
        $image_filename = basename($_FILES['upfile']['name']);
        $tmploc = $_FILES['upfile']['tmp_name'];
        $uploc = "images/" . $image_filename;

        if (move_uploaded_file($tmploc, $uploc)) {
            // Unlink the previous image if a new one is uploaded successfully
            if ($previous_image && file_exists("images/" . $previous_image)) {
                unlink("images/" . $previous_image);
            }
            $new_image = $image_filename;
        } else {
            echo "File upload failed";
        }
    }

    // Update query
    $sql = "UPDATE casts SET Name = '$fullname', Birthdate = '$dob', Gender = '$gender', Nationality = '$nationality', Bio = '$bio', ContactLink = '$link', Image = '$new_image' WHERE CastID = '$CastID'";
    if ($conn->query($sql) === TRUE) {
        echo "Cast information updated successfully";
    } else {
        echo "Error updating cast information: " . $conn->error;
    }
}

$conn->close();
?>