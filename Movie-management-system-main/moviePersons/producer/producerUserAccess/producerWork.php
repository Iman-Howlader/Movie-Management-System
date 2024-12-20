
<?php


/*/

session_start();
$user_id = $_SESSION['user_id'];
if(!empty($user_id)){

*/?>



<?php
ob_start();
 include '../../../connection/connection.php'; 
 ob_end_clean();
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Producer Work</title>
<style>
  body {
    font-family: Arial, sans-serif;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 20px;
  }

  th,
  td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
  }

  th {
    background-color: #f2f2f2;
  }

  .add-movie-btn {
    background-color: #4caf50;
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
    opacity: 0.8;
  }

  .director-container {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-align: center;
    margin-bottom: 20px;
  }

  .director-container img {
    width: 150px;
    height: 150px;
    border-radius: 100%;
    display: block;
    margin: 0 auto;
  }

  .director-details p {
    margin: 5px 0;
    font-size: 16px;
  }
</style>

</head>
<body>
   <?php
          echo "<h1>Producer Work</h1>";
          $ProducerID = $_GET['ProducerID'];
      
          $producer_find = "SELECT * FROM producer WHERE ProducerID ='$ProducerID'";
          $result = $conn->query($producer_find);
          if ($result->num_rows > 0) {
              $row = $result->fetch_assoc();
              echo '<div class="director-container">';
             
              echo '<div class="director-details">';
              echo '<p>' . $row["Name"] . '</p>';
             
             
             
             
              echo '</div>';
              echo '</div>';
              


              
          } else {
              echo "0 results";
          }

           

?>

<table>
<thead>
<tr>

                <th>Title</th>
                <th>Poster</th>
                
                <th>Genre</th>
          <!--      <th>Director</th>   -->
                <th>Release Date</th>
                <th>Duration</th>
                <th>Language</th>
                <th>Description</th>
                <th>Budget</th>
              

</tr>
</thead>
<tbody>
<?php
  $ProducerID = $_GET['ProducerID'];
$sql = "SELECT *
FROM movie
JOIN producerwork ON producerwork.MovieID = movie.MovieID

WHERE producerwork.ProducerID = '$ProducerID'     " ;

$result = $conn->query($sql);

if ($result->num_rows > 0) {
   while ($row = $result->fetch_assoc()) {
       echo "<tr>";
      // echo "<td>" . $row["MovieID"] . "</td>";
       echo "<td>" . $row["Title"] . "</td>";
       // Fetching image filename from the database
       $image_filename = $row["Image"];
       // Generating the image path
       $image_path = "../../../movieadmin/images/" . $image_filename;
       // Displaying the image
       echo "<td><img src='" . $image_path . "' alt='" . $row["Title"] . "' width='100'></td>";

      


       echo "<td>" . $row["Genre"] . "</td>";
       //echo "<td>" . $row["Director"] . "</td>";
       echo "<td>" . $row["Release_date"] . "</td>";
       echo "<td>" . $row["Duration"] . "</td>";
       echo "<td>" . $row["Language"] . "</td>";
       echo "<td>" . $row["Description"] . "</td>";
       echo "<td>" . $row["Budget"] . " TK</td>";
       
       echo "</td>";
       echo "</tr>";
   }
} else {
   echo "<tr><td colspan='11'>No movies found</td></tr>";
}
?>
</tbody>
</table>


</body>
</html>


<?PHP/*
}else{
header('location:../login/login.php');
}
*/?>