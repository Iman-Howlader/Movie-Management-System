
<?php
session_start();
$admin_email = $_SESSION['admin_email'];

if (!empty($admin_email)) {
?>


<?php



ob_start();
include '../connection/connection.php';
ob_end_clean();

// Fetch user details from the database
$admin_email = $_SESSION['admin_email'];
$sql = "SELECT * FROM adminsignup WHERE Email=?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $admin_email);
$stmt->execute();
$result = $stmt->get_result();
$row = $result->fetch_assoc();

// Close statement and connection


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Admin Profile</title>
    <style>
        body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

.container {
    max-width: 500px;
    margin: 50px auto;
    padding: 20px;
    background-color: #333;
    border-radius: 10px;
    color: #fff;
}

.container h2 {
    text-align: center;
}

.container form {
    margin-top: 20px;
}

.container input[type="text"],
.container input[type="email"],
.container input[type="tel"],
.container input[type="date"],
.container select,
.container input[type="password"],
.container button {
    width: 100%;
    padding: 10px;
    margin-bottom: 10px;
    border: none;
    border-radius: 5px;
    box-sizing: border-box;
}

.container input[type="file"] {
    margin-top: 10px;
}

.container button {
    background-color: #4CAF50;
    color: white;
    padding: 15px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
}

.container button:hover {
    background-color: #45a049;
}

#error_message {
    text-align: center;
}

.container p {
    text-align: center;
}

.container a {
    color: #fff;
}

    </style>
</head>
<body>
    <div class="container">
        <h2>Edit Admin Profile</h2>
        <form action="updateProfileAdmin.php" method="POST" enctype="multipart/form-data">
            <input type="text" name="fullname" placeholder="Full Name" value="<?php echo $row['FullName']; ?>" required>
            <input type="email" name="email" placeholder="Email" value="<?php echo $row['Email']; ?>" required readonly>
            <input type="tel" name="phone" placeholder="Phone" value="<?php echo $row['Phone']; ?>" required>
            <input type="date" name="dob" value="<?php echo $row['DOB']; ?>" required>
            
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="male" <?php if ($row['Gender'] == 'male') echo 'selected'; ?>>Male</option>
                <option value="female" <?php if ($row['Gender'] == 'female') echo 'selected'; ?>>Female</option>
                <option value="other" <?php if ($row['Gender'] == 'other') echo 'selected'; ?>>Other</option>
            </select>

            <input type="text" name="address" placeholder="Address" value="<?php echo $row['Address']; ?>" required>

           

            <!--For Image Upload-->
            <label for="Upload profile picture" style="color: aliceblue;">Upload Profile Picture:</label>
            <input class="filee" type="file" id="image" name="upfile" placeholder="Image" onchange="previewImage(event)">
            <br>
            <img id="preview" src="../signup/signupImages/<?php echo $row['Image']; ?>" alt="Image Preview" style="max-width: 100%; max-height: 200px; margin-top: 10px;">

            <button type="submit" name="submit">Update Profile</button>
        </form>
       
    </div>

    <!-- pop up when password and confirmed password doesn't match -->
    <script>
        //live image preview in form 
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

<?php  }else{
  header('location:../login/login.php');
} ?>
</body>
</html>
