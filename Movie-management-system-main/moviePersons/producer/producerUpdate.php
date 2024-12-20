<?php
// producerUpdate.php

// Include connection file
include '../../connection/connection.php';

// Check if id is set
if (isset($_GET['ProducerID'])) {
    $ProducerID = $_GET['ProducerID'];

    // Query to fetch producer information
    $sql = "SELECT * FROM producer WHERE ProducerID = '$ProducerID'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display producer information in a form
        ?>
        <html>
        <head>
            <title>Update Producer Information</title>
            <link rel="stylesheet" href="producerAdd.css">
        </head>
        <body>
            <div class="container">
                <h2>Update Producer Information</h2>
                <form action="producerUpdate.php" method="POST" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?php echo $id; ?>">

                    <input type="text" name="name" value="<?php echo $row['Name']; ?>" placeholder="Name" required>
                    <input type="email" name="email" value="<?php echo $row['Email']; ?>" placeholder="Email" required>
                    <input type="text" name="phone" value="<?php echo $row['Phone']; ?>" placeholder="Phone" required>
                    <input type="text" name="company" value="<?php echo $row['Company']; ?>" placeholder="Company" required>
                   
                    <input type="url" name="website" value="<?php echo $row['Website']; ?>" placeholder="Website" required>

                   

                    <button type="submit" name="submit">Update</button>
                </form>
            </div>

         
        </body>
        </html>
        <?php
    } else {
        echo "Producer not found";
    }
} else {
    echo "ID not set";
}

// Update producer information
if (isset($_POST['submit'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $company = $_POST['company'];
  
    $website = $_POST['website'];

   

   

    $sql = "UPDATE producer SET Name = '$name', Email = '$email', Phone = '$phone', Company = '$company',  Website = '$website' WHERE ProducerID = '$ProducerID'";
    $result = $conn->query($sql);

    if ($result) {
        echo "Producer information updated successfully";
    } else {
        echo "Error updating producer information";
    }
}
?>
