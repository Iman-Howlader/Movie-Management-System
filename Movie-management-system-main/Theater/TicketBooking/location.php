<?php
session_start();
$user_email = $_SESSION['user_email'];

if (!empty($user_email)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Choose Booking Date</title>
    <style>
        /* General Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background: url('https://repository-images.githubusercontent.com/201763429/30616780-bd1a-11e9-840c-edafb61c8f99') no-repeat center center fixed;
            background-size: cover;
            color: #fff; /* Set text color to white for better readability */
            margin-top: 250px;
        }

        /* Container Styles */
        .container {
            
            max-width: 600px;
            margin: 30px auto;
            padding: 40px;
            background-color: rgba(0, 0, 0, 0.5); /* Semi-transparent background for better contrast */
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.5); /* Soft shadow effect */
        }

        /* Heading Styles */
        h1 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #ff0000;
            text-align: center;
        }

        /* Form Styles */
        form {
            display: flex;
            flex-direction: column;
        }

        label {
            margin-bottom: 10px;
            color: #fff; /* Set label color to white for better visibility */
        }

        input[type="submit"] {
            background-color: #1464a5;
            color: #fff;
            cursor: pointer;
            transition: background-color 0.3s ease;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 20px;
            align-self: center;
        }

        input[type="submit"]:hover {
            background-color: #1a4d94;
        }

        /* Dropdown Styles */
        select {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 16px;
            width: 100%; /* Make dropdown width 100% */
            margin-bottom: 20px; /* Add some space below the dropdown */
        }

        /* Styling for label */
        label {
            font-weight: bold;
            font-size: 18px;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Choose A Location</h1>
    <form action="ticket.php" method="GET">
    <!-- Locations -->
    <label for="location">Location:</label>
    <select id="location" name="location" required>
        <option value="" disabled selected>Select a location</option>
        <option value="All">All</option>
        <option value="Bashundhara City">Bashundhara City</option>
        <option value="Jamuna Future Park">Jamuna Future Park</option>
        <option value="Simanto Square">Simanto Square</option>
        <option value="North South University">North South University</option>
        <option value="Mirpur">Mirpur</option>
    </select>
    <input type="submit" value="Next" name="submit">
</form>
</div>



</body>
</html>

<?php
} else {
    header('location:../../login/login.php');
}
?>
