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
    <title>User Order History</title>
    <style>
       body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        /* Define CSS classes for different order numbers */
        .order-color-1 {
            background-color: #80ffff;
        }
        .order-color-2 {
            background-color: #00ff80;
        }
        .order-color- {
            background-color: #ff8080;
        }
        
        
    </style>
</head>
<body>
    <h1>User Order History</h1>
    <?php
    ob_start();
    include '../connection/connection.php';
    ob_end_clean();

    // User email (this should be dynamically set, e.g., from session or request)
    $userEmail = $user_email;

    // Fetch order history
    $sql = "
        SELECT oh.OrderID, oh.Email, oh.TransactionID, oh.ProductType, oh.TypeOrderID, oh.OrderTime, oh.PaymentStatus,
            fb.FoodID, fb.Quantity, fb.bookingTime AS foodBookingTime, f.FoodName, f.FoodPrice, f.FoodCategory, f.FoodStatus, f.FoodImage,
            b.HallMovieID, b.BookingDate, b.SeatNumber, b.bookingTime AS movieBookingTime, m.Title, m.Genre, m.Director, m.Release_date, m.Duration, m.Language, m.Description, m.Budget, m.Image
        FROM orderhistory oh
        LEFT JOIN foodbookings fb ON oh.ProductType = 'food' AND oh.TypeOrderID = fb.booking_id
        LEFT JOIN foods f ON fb.FoodID = f.FoodID
        LEFT JOIN bookings b ON oh.ProductType = 'movie' AND oh.TypeOrderID = b.booking_id
        LEFT JOIN movie m ON b.HallMovieID = m.MovieID
        WHERE oh.Email = ?
        ORDER BY oh.TransactionID, oh.OrderID
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $userEmail);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Order No</th><th>Order ID</th><th>Transaction ID</th><th>Product Type</th><th>Details</th><th>Order Time</th><th>Payment Status</th></tr>";

        $prevTransactionID = null;
        $orderNumber = 1;
       

        while ($row = $result->fetch_assoc()) {
            // Print order number if transaction ID changes
            if ($row['TransactionID'] !== $prevTransactionID) {
                // Assign CSS class based on order number
                $orderClass = 'order-color-' . ($orderNumber % 2 + 1);
                echo "<tr class='{$orderClass}'>";
                echo "<td>{$orderNumber}</td>";
                $orderNumber++;
            } else {
                // Empty cell for subsequent rows with the same transaction ID
                echo "<tr>";
                echo "<td></td>";
            }
           
            
            echo "<td>{$row['OrderID']}</td>";
            echo "<td>{$row['TransactionID']}</td>";
            echo "<td>{$row['ProductType']}</td>";
            echo "<td>";

            if ($row['ProductType'] == 'food') {
                echo "Food Name: {$row['FoodName']}<br>";
                echo "Quantity: {$row['Quantity']}<br>";
                echo "Price: {$row['FoodPrice']}<br>";
                echo "Category: {$row['FoodCategory']}<br>";
                echo "Status: {$row['FoodStatus']}<br>";
                if (!empty($row['FoodImage'])) {
                    echo "<img src='{$row['FoodImage']}' alt='{$row['FoodName']}' style='width:50px; height:50px;'><br>";
                }
            } elseif ($row['ProductType'] == 'movie') {
                echo "Movie Title: {$row['Title']}<br>";
                echo "Genre: {$row['Genre']}<br>";
                echo "Director: {$row['Director']}<br>";
                echo "Release Date: {$row['Release_date']}<br>";
                echo "Duration: {$row['Duration']} minutes<br>";
                echo "Language: {$row['Language']}<br>";
                echo "Description: {$row['Description']}<br>";
                echo "Seat Number: {$row['SeatNumber']}<br>";
                echo "Booking Date: {$row['BookingDate']}<br>";
                if (!empty($row['Image'])) {
                    echo "<img src='{$row['Image']}' alt='{$row['Title']}' style='width:50px; height:50px;'><br>";
                }
            }

            echo "</td>";
            echo "<td>{$row['OrderTime']}</td>";
            echo "<td>{$row['PaymentStatus']}</td>";
            echo "</tr>";

            $prevTransactionID = $row['TransactionID'];
        }

        echo "</table>";
    } else {
        echo "<p>No order history found for this user.</p>";
    }

    $stmt->close();
    $conn->close();
    ?>

<?php } else {
    header('location:../login/login.php');
} ?>
</body>
</html>