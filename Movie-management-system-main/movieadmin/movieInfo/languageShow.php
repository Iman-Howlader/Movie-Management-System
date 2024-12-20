<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Show Languages</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            padding: 20px;
        }
        .container {
            max-width: 800px;
            margin: auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .container h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ccc;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f8f8f8;
        }
        .form-group {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Languages</h2>
        <table>
            <thead>
                <tr>
                    <th>Language ID</th>
                    <th>Language Name</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the database connection file
                ob_start();
                include '../../connection/connection.php';
                ob_end_clean();

                // Fetch data from the database
                $sql = "SELECT language_id, language_name, description FROM languages";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    // Output data of each row
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["language_id"] . "</td>";
                        echo "<td>" . $row["language_name"] . "</td>";
                        echo "<td>" . $row["description"] . "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='3'>No languages found</td></tr>";
                }

                // Close the database connection
                $conn->close();
                ?>
            </tbody>
        </table>
        <div class="form-group">
            <a href="language.php"><button>Add New Language</button></a>
        </div>
    </div>
</body>
</html>
