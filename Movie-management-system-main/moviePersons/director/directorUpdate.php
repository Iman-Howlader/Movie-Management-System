<?php
// directorUpdate.php

// Include connection file
include '../../connection/connection.php';

// Check if DirectorID is set
if (isset($_GET['DirectorID'])) {
    $DirectorID = $_GET['DirectorID'];

    // Query to fetch director information
    $sql = "SELECT * FROM directors WHERE DirectorID = '$DirectorID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display director information in a form
        ?>
        <html>
        <head>
            <title>Update Director Information</title>
            <link rel="stylesheet" href="directorAdd.css">
        </head>
        <body>
            <div class="container">
                <h2>Update Director Information</h2>
                <form action="directorUpdate.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="DirectorID" value="<?php echo $DirectorID; ?>">

                    <input type="text" name="fullname" value="<?php echo $row['Name']; ?>" placeholder="Full Name" required>
                    <label>Date of birth</label>
                    <input type="date" name="dob" value="<?php echo $row['Birthdate']; ?>" required>

                    <select name="gender" required>
                        <option value="<?php echo $row['Gender']; ?>"><?php echo $row['Gender']; ?></option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                        <option value="other">Other</option>
                    </select>

                    <input type="text" name="nationality" value="<?php echo $row['Nationality']; ?>" placeholder="Nationality" required>

                    <label for="bio">Bio:</label>
                    <textarea id="bio" name="bio" rows="4" cols="50" required><?php echo $row['Bio']; ?></textarea><br><br>

                    <!-- For Image Upload -->
                    <label for="upfile">Upload Profile Picture:</label>
                    <input type="file" name="upfile" id="image" onchange="previewImage(event)">
                    <input type="hidden" name="previous" value="<?php echo $row['Image']; ?>">
                    <img id="preview" src="<?php echo 'images/' . $row['Image']; ?>" alt="Image Preview" style="display: block; max-width: 100%; max-height: 200px; margin-top: 10px;">

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
        echo "Director not found";
    }
} else {
    echo "DirectorID not set";
}

// Update director information
if (isset($_POST['submit'])) {
    $DirectorID = $_POST['DirectorID'];
    $fullname = $_POST['fullname'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $nationality = $_POST['nationality'];
    $bio = $_POST['bio'];

    $previous_image = $_POST['previous'];
    $new_image = $previous_image;

    if (isset($_FILES['upfile']) && $_FILES['upfile']['error'] == UPLOAD_ERR_OK) {
        $image_filename = basename($_FILES['upfile']['name']);
        $tmploc = $_FILES['upfile']['tmp_name'];
        $uploc = "images/" . $image_filename;

        if (move_uploaded_file($tmploc, $uploc)) {
            echo "Uploaded.";
            // Unlink the previous image if a new one is uploaded successfully
            if ($previous_image && file_exists("images/" . $previous_image)) {
                unlink("images/" . $previous_image);
            }
            $new_image = $image_filename;
        } else {
            echo "Not uploaded";
        }
    }

    $sql = "UPDATE directors SET Name = '$fullname', Birthdate = '$dob', Gender = '$gender', Nationality = '$nationality', Bio = '$bio', Image = '$new_image' WHERE DirectorID = '$DirectorID'";
    $result = $conn->query($sql);

    if ($result) {
        echo "Director information updated successfully";
    } else {
        echo "Error updating director information";
    }
}
?>
