
<?php/*/

session_start();
$user_id = $_SESSION['user_id'];
if(!empty($user_id)){

*/?>



<?php include '../../connection/connection.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Director List</title>
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
color: white;
}

.action-btns button:hover {
background-color: #ff8080;
opacity: 0.8;
}
.link-button {
  text-decoration: none;
  color: #337ab7;
  transition: color 0.2s ease;
}

.link-button:hover {
  color: #00ff00; /* change the color on hover */
}
</style>
</head>
<body>
<h1>Movie Management</h1>

<table>
<thead>
<tr>

<th>Cast Name</th>
<th>Image</th>
<th>Birthday</th>
<th>Geder</th>
<th>Nationality</th>
<th>Bio</th>
<th>Works</th>
<th>Contact</th>
<th>Action</th>


</tr>
</thead>
<tbody>
<?php
$sql = "SELECT * FROM casts";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
while ($row = $result->fetch_assoc()) {
   echo "<tr>";
  
   echo "<td>" . $row["Name"] . "</td>";
   // Fetching image filename from the database
   $image_filename = $row["Image"];
   // Generating the image path
   $image_path = "images/" . $image_filename;
   // Displaying the image
   echo "<td><img src='" . $image_path . "' alt='" . $row["Image"] . "' width='100'></td>";
   echo "<td>" . $row["Birthdate"] . "</td>";
   echo "<td>" . $row["Gender"] . "</td>";
   echo "<td>" . $row["Nationality"] . "</td>";
   echo "<td>" . $row["Bio"] . "</td>";

   echo "<td><a href='DirectorMovie.php?DirectorID=". $row["CastID"]. "' style='text-decoration: none; color: #337ab7; transition: color 0.2s ease;'>Click To Show Movies </a></td>";
   echo "<td><a href='".$row["ContactLink"]."' target='_blank' style='text-decoration: none; color: #337ab7; transition: color 0.2s ease;'>Click To show Social midea  </a></td>";
   echo "<td class='action-btns'>";
   echo "<button class='delete-btn' onclick='window.location.href=\"castDelete.php?CastID=" . $row["CastID"] . "\"'>Delete</button>";
   echo "<button class='update-btn' onclick='window.location.href=\"castUpdate.php?CastID=" . $row["CastID"] . "\"'>Update</button>";
   
   echo "</td>";
   echo "</tr>";
}
} else {
echo "<tr><td colspan='11'>No movies found</td></tr>";
}
?>
</tbody>
</table>

<button class="add-movie-btn" onclick="window.location.href='castAdd.php'">Add Cast to the database</button>
</body>
</html>


<?PHP/*
}else{
header('location:../login/login.php');
}
*/?>