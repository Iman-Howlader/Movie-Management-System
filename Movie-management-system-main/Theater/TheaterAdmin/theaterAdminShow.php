<?php
include '../../connection.php';

// Query to fetch movie information from theaterMovie and movie tables
$query = "SELECT theatermovie.*, movie.* FROM theatermovie INNER JOIN movie ON theatermovie.MovieID = movie.MovieID";
$result = mysqli_query($conn, $query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Management</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        container {
    width: 95%; /* Adjust width as needed */
    margin: 20px auto;
    background-color: #fff;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}



        h1 {
            text-align: center;
            margin: 20px 0;
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 12px;
            border-bottom: 1px solid #dee2e6;
            text-align: left;
            border-right: 1px solid #dee2e6;
        }

        th {
            background-color: #007bff;
            color: #fff;
        }

        td img {
            display: block;
            margin: 0 auto;
            max-width: 100px;
            height: auto;
            border-radius: 5px;
        }

        td a.delete-btn {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            color: #fff;
            background-color: #dc3545;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        td a.delete-btn:hover {
            background-color: #c82333;
        }

        td a.edit-btn {
            display: inline-block;
            padding: 8px 16px;
            text-decoration: none;
            color: #fff;
            background-color: #007bff;
            border-radius: 4px;
            transition: background-color 0.3s;
        }

        td a.edit-btn:hover {
            background-color: #0056b3;
        }

        @media screen and (max-width: 768px) {
            .container {
                width: 95%;
            }

            table {
                font-size: 14px;
            }

            th, td {
                padding: 10px;
            }

            td img {
                max-width: 80px;
            }
        }
        
    </style>
</head>
<body>
    <div class="container">
        <h1>Hall Runng Show Movie</h1>
        <table>
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Genre</th>
                    <th>Director</th>
                    <th>Release Date</th>
                    <th>Duration</th>
                    <th>Language</th>
                    <th>Budget</th>
                    <th>Image</th>
                    <th>Category</th>
                    <th>Start Time</th>
                    <th>End Time</th>
                    <th>Location</th>
                    <th>Ticket Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each movie entry
                while($row = mysqli_fetch_assoc($result)) {
                    ?>
                    <tr>
                        <td><?php echo $row['Title']; ?></td>
                        <td><?php echo $row['Genre']; ?></td>
                        <td><?php echo $row['Director']; ?></td>
                        <td><?php echo $row['Release_date']; ?></td>
                        <td><?php echo $row['Duration']; ?></td>
                        <td><?php echo $row['Language']; ?></td>
                        <td><?php echo $row['Budget']; ?></td>
                        <td><img src="../../movieadmin/images/<?php echo $row['Image']; ?>" alt="<?php echo $row['Title']; ?>"></td>
                        <td><?php echo $row['Category']; ?></td>
                        <td><?php echo $row['StartTime']; ?></td>
                        <td><?php echo $row['EndTime']; ?></td>
                        <td><?php echo $row['Location']; ?></td>
                        <td><?php echo $row['TicketPrice']; ?></td>
                        <td>
                            <a href="theaterAdminDelete.php?hallmovieID=<?php echo $row['HallMovieID'];?>" class="delete-btn">Delete</a>
                            
                            <a href="theaterAdminUpdate.php?hallmovieID=<?php echo $row['HallMovieID']; ?>" class="edit-btn">Edit</a>
                        </td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
