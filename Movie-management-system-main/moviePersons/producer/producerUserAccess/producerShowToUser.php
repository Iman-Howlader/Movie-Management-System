<?php/*
session_start();
$user_id = $_SESSION['user_id'];
if (!empty($user_id)) {

    */
?>

<?php include '../../../connection/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Producer List</title>
<style>
body {
    font-family: Arial, sans-serif;
}

table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
}

th, td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

th {
    background-color: #f2f2f2;
}

.add-movie-btn {
    background-color: #4CAF50;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 20px;
    cursor: pointer;
    font-size: 16px;
}

.add-movie-btn:hover {
    background-color: #45a049;
}

.action-btns {
    display: flex;
    justify-content: space-around;
}

.action-btns button {
    padding: 5px 10px;
    margin-right: 5px;
    cursor: pointer;
    border: none;
    border-radius: 3px;
}

.action-btns button.delete-btn {
    background-color: #f44336;
    color: white;
}

.action-btns button.update-btn {
    background-color: #007bff;
    color:white;
}

.action-btns button:hover {
    opacity: 0.8;
}

.link-button {
    text-decoration: none;
    color: #337ab7;
    transition: color 0.2s ease;
}

.link-button:hover {
    color: #00ff00;
}
</style>
</head>
<body>
<h1>Producer Management</h1>

<table>
<thead>
<tr>
    <th>Producer Name</th>
    <th>Email</th>
    <th>Phone</th>
    <th>Company</th>
    <th>Work</th>
    
    <th>Website</th>
   
    
</tr>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM producer";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row["Name"] . "</td>";
        echo "<td>" . $row["Email"] . "</td>";
        echo "<td>" . $row["Phone"] . "</td>";
        echo "<td>" . $row["Company"] . "</td>";
        echo "<td><a href='producerWork.php?ProducerID=" . $row["ProducerID"] . "' style='text-decoration: none; color: #337ab7; transition: color 0.2s ease;'>Click To Show Movies </a></td>";
        
        echo "<td><a href='" . $row["Website"] . "' target='_blank'>" . $row["Website"] . "</a></td>";

        // Fetching image filename from the database
       

        
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='8'>No producers found</td></tr>";
}
?>
</tbody>
</table>

<button class="add-movie-btn" onclick="window.location.href='producerAdd.php'">Add Producer to the Database</button>
<?php/*
} else {
    header('location:../login/login.php');
}
*/
?>
</body>
</html>



 