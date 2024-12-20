<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Management - Food List</title>
    <style>
      body {
    font-family: Arial, sans-serif;
    background-color: #f4f4f4;
}

.container {
    width: 80%;
    margin: 20px auto;
    background-color: #78c2ad; /* Green */
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    padding: 20px;
    overflow-x: auto;
}

h1 {
    margin-top: 0;
    text-align: center;
    color: #333;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
    background-color: #C7DAB8; /* Yellow */
}

th, td {
    border: 1px solid #ddd;
    padding: 10px;
    text-align: center;
}

th {
    background-color: #e55039; /* Red */
    color: white;
    text-transform: uppercase;
}

tr:nth-child(even) {
    background-color: #e5e5e5; /* Light gray */
}

img {
    max-width: 100px;
    max-height: 100px;
    display: block;
    margin: 0 auto;
}

.action-buttons {
    display: flex;
    justify-content: center;
}

.action-buttons button {
    margin: 5px;
    padding: 3px 7px; /* Adjust size here */
    border: none;
    cursor: pointer;
    border-radius: 3px;
}

/* Add this CSS */
.action-btns button.delete-btn {
    background-color: #ff6b81; /* Red */
    color: white;
}

.action-btns button.update-btn {
    background-color: #3c40c6; /* Blue */
    color: white;
}

.action-btns button.delete-btn {
    background-color: #ff6b81; /* Red */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.action-btns button.delete-btn:hover {
    background-color: #e74c3c; /* Darker red on hover */
}

.action-btns button.update-btn {
    background-color: #3c40c6; /* Blue */
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    transition: background-color 0.3s;
}

.action-btns button.update-btn:hover {
    background-color: #34495e; /* Darker blue on hover */
}


    </style>
</head>
<body>
    <div class="container">
        <h1>Food List</h1>
        <table>
            <thead>
                <tr>
                    <th>Food ID</th>
                    <th>Food Name</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Category</th>
                    <th>Availability</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                include '../connection.php'; // Assuming this file includes database connection details

                // Retrieve food information from the database
                $sql = "SELECT * FROM foods";
                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["FoodID"] . "</td>";
                        echo "<td>" . $row["FoodName"] . "</td>";
                        echo "<td><img src='foodimages/" . $row["FoodImage"] . "' alt='" . $row["FoodName"] . "'></td>";
                        echo "<td>" . $row["FoodPrice"] . " TK</td>";
                        echo "<td>" . ucfirst($row["FoodCategory"]) . "</td>";
                        echo "<td>" . ($row["FoodStatus"] == 1 ? 'Available Now' : 'Not Available Now') . "</td>";
                        echo "<td class='action-btns'>";
                        echo "<button class='delete-btn' onclick='window.location.href=\"FoodDelete.php?food_id=" . $row["FoodID"] . "\"'>Delete</button>";
                        echo "<button class='update-btn' onclick='window.location.href=\"FoodUpdate.php?food_id=" . $row["FoodID"] . "\"'>Update</button>";
                        echo "</td>";
                        echo "</tr>";
                        
                    }
                } else {
                    echo "<tr><td colspan='7'>No food items found</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
