<?php
include '../connection.php'; // Include your database connection file
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Signup Data</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: #f2f2f2;
            margin-top: 20px;
        }

        table, th, td {
            border: 2px solid #ddd;
        }

        th, td {
            padding: 12px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Signup Data</h2>
        <?php
        // Fetch data from the signup table
        $sql = "SELECT * FROM usersignup";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Output data in a tabular form
            echo "<table border='1'>";
           
            echo "<tr><th>ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>DOB</th><th>Gender</th><th>Address</th></tr>";
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>".$row["UserID"]."</td>";
                echo "<td>".$row["FullName"]."</td>";
                echo "<td>".$row["Email"]."</td>";
                echo "<td>".$row["Phone"]."</td>";
                echo "<td>".$row["DOB"]."</td>";
                echo "<td>".$row["Gender"]."</td>";
                echo "<td>".$row["Address"]."</td>";
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "0 results";
        }

        $conn->close(); // Close the database connection
        ?>
    </div>
</body>
</html>
