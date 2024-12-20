<?php
include '../connection.php';
session_start();
$user_email = $_SESSION['user_email'];
if (!empty($user_email)) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Slip</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
        }

        .payment-details {
            margin-top: 20px;
            border-top: 2px solid #ccc;
            padding-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .logo {
            width: 150px;
            height: 150px;
        }

        .info {
            flex-grow: 1;
            padding-left: 20px;
        }

        .order-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        button {
            padding: 5px 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #ff0000;
        }

        img {
            max-width: 100px;
            max-height: 100px;
            border: 2px solid #ccc;
            border-radius: 4px;
        }

        #addpayLink {
            display: inline-block;
            background-color: darkcyan;
            color: white;
            padding: 8px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 17px;
            text-decoration: none;
            margin-left: 10px;
        }

        #addpayLink:hover {
            background-color: #9C94BC;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Payment Slip</h1>
        <div class="payment-details">
            <div class="logo">
                <!-- Your logo here -->
            </div>
            <div class="info">
                <?php
                include '../connection.php';
                if(isset($_GET['discount_price']) AND $_GET['total_price'] ){
                $discountPrice = $_GET['discount_price'];
                $totalPrice = $_GET['total_price'] - $discountPrice;
                }
                else{
                    header('location:cart.php');
                }

                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    // Handle food item deletion
                    if (isset($_POST['delete_food'])) {
                        $foodID = $_POST['foodID'];
                        $deleteFoodSql = "DELETE FROM foodbookings WHERE FoodID = $foodID";
                        if ($conn->query($deleteFoodSql) === TRUE) {
                            echo "Food item deleted successfully";
                        } else {
                            echo "Error deleting food item: " . $conn->error;
                        }
                    }

                    // Handle movie ticket deletion
                    if (isset($_POST['delete_movie'])) {
                        $bookingID = $_POST['bookingID'];
                        $deleteMovieSql = "DELETE FROM bookings WHERE booking_id = $bookingID";
                        if ($conn->query($deleteMovieSql) === TRUE) {
                            echo "Movie ticket deleted successfully";
                        } else {
                            echo "Error deleting movie ticket: " . $conn->error;
                        }
                    }
                }

                // Fetch food data from the database
                $foodSql = "SELECT foods.FoodID, foods.FoodName, foods.FoodImage, foodbookings.Quantity, foods.FoodPrice, foodbookings.Email
                            FROM foods
                            INNER JOIN foodbookings ON foods.FoodID = foodbookings.FoodID
                            WHERE foodbookings.Email = '$user_email' AND foodbookings.PaymentStatus = 'unpaid'
                            ORDER BY foods.FoodPrice";

                $foodResult = $conn->query($foodSql);

                $movieSql = "SELECT bookings.booking_id, theatermovie.Title, theatermovie.Image, theatermovie.Category, theatermovie.StartTime, theatermovie.EndTime, theatermovie.Location, theatermovie.TicketPrice, bookings.SeatNumber, bookings.Email
                            FROM bookings
                            INNER JOIN theatermovie ON bookings.HallMovieID = theatermovie.HallMovieId 
                            WHERE bookings.Email = '$user_email' AND bookings.PaymentStatus = 'unpaid'
                            ORDER BY bookings.SeatNumber";

                $movieResult = $conn->query($movieSql);

                // Display food items
                echo "<h1>Your Ordered Food:</h1>";

                if ($foodResult->num_rows > 0) {
                    while ($row = $foodResult->fetch_assoc()) {
                        echo "<div class='order-info'>";
                        echo "<img src='../movieadmin/foodimages/" . $row["FoodImage"] . "' alt='" . $row["FoodName"] . "'>";
                        echo "<p><strong>" . $row["FoodName"] . "</strong> - Quantity: <span id='quantity_" . $row["FoodID"] . "'>" . $row["Quantity"] . "</span> - Unit Price: $" . $row["FoodPrice"] . " - Subtotal: <span class='subtotal' id='subtotal_" . $row["FoodID"] . "'>$" . ($row["Quantity"] * $row["FoodPrice"]) . "</span></p>";
                        // Add buttons for incrementing and decrementing quantity
                        echo "<button onclick='incrementQuantity(" . $row["FoodID"] . ", " . $row["FoodPrice"] . ")'>+</button>";
                        echo "<button onclick='decrementQuantity(" . $row["FoodID"] . ", " . $row["FoodPrice"] . ")'>-</button>";
                        // Add delete button for food item
                        echo "<form method='post'><input type='hidden' name='foodID' value='" . $row["FoodID"] . "'><button type='submit' name='delete_food'>Delete</button></form>";
                        echo "</div>";
                    }
                }

                echo "<h1>Your Booked Movie and Seats:</h1>";
                // Display movie tickets
                if ($movieResult->num_rows > 0) {
                    while ($row = $movieResult->fetch_assoc()) {
                        echo "<div class='order-info'>";
                        echo "<img src='../movieadmin/images/" . $row["Image"] . "' alt='" . $row["Title"] . "'>";
                        echo "<p><strong>" . $row["Title"] . "</strong> - Seat Number: " . $row["SeatNumber"] . " - Category: " . $row["Category"] . " - Time: " . $row["StartTime"] . " to " . $row["EndTime"] . " - Location: " . $row["Location"] . " - Price: <span class='movie-price'>$" . $row["TicketPrice"] . "</span></p>";
                        // Add delete button for movie ticket
                        echo "<form method='post'><input type='hidden' name='bookingID' value='" . $row["booking_id"] . "'><button type='submit' name='delete_movie'>Delete</button></form>";
                        echo "</div>";
                    }
                }

                // Output total price
                echo "<p><strong>Total Price: <span id='totalPrice'>$totalPrice</span></strong></p>";
                echo "<p><strong>Total Your got discount: <span id='discountPrice'>$discountPrice</span></strong></p>";
                ?>

            </div>
        </div>
        <form id="orderForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <?php
            // Fetch data from the database again to get the current state
            $result = $conn->query($foodSql);
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<input type='hidden' name='foodID[]' value='" . $row["FoodID"] . "'>";
                    echo "<input type='hidden' name='quantity[]' value='" . $row["Quantity"] . "'>";
                }
            }
            ?>
            <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
            <button type="button" onclick="submitOrderForm()">Confirm Order</button>
        </form>
        <form id="pdfForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <input type="hidden" name="totalPrice" value="<?php echo $totalPrice; ?>">
            <button type="submit">Download PDF</button>
            <a href="payment.php?total_amount=<?php echo $totalPrice; ?>" id="addpayLink">Payment</a>
        </form>
        <a href="../cart/cart.php?" id="addpayLink">Pay card</a>
    </div>

    <script>
        function updateSubtotalAndTotalPrice(foodID, quantity, unitPrice) {
            var quantityElement = document.getElementById('quantity_' + foodID);
            var subtotalElement = document.getElementById('subtotal_' + foodID);
            var totalElement = document.getElementById('totalPrice');
            var discountElement = document.getElementById('discountPrice');
            var originalTotal = parseFloat(totalElement.innerText);
            var discount = parseFloat(discountElement.innerText);

            // Update quantity
            quantityElement.innerText = quantity;

            // Update subtotal
            var subtotal = quantity * unitPrice;
            subtotalElement.innerText = '$' + subtotal.toFixed(2);

            // Update total price
            var totalPriceElements = document.querySelectorAll('.subtotal');
            var totalPrice = 0;
            totalPriceElements.forEach(function(element) {
                totalPrice += parseFloat(element.innerText.replace('$', ''));
            });

            // Include movie prices in the total price calculation
            var moviePriceElements = document.querySelectorAll('.movie-price');
            moviePriceElements.forEach(function(element) {
                totalPrice += parseFloat(element.innerText.replace('$', ''));
            });

            var newTotalPrice = totalPrice - discount;
            totalElement.innerText = newTotalPrice.toFixed(2);
        }

        function updateQuantity(foodID, newQuantity, unitPrice) {
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "update_quantity.php", true);
            xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        // Quantity updated successfully
                        updateSubtotalAndTotalPrice(foodID, newQuantity, unitPrice);
                    } else {
                        console.error("Error updating quantity: " + xhr.responseText);
                    }
                }
            };
            xhr.send("foodID=" + foodID + "&quantity=" + newQuantity);
        }

        function incrementQuantity(foodID, unitPrice) {
            var quantityElement = document.getElementById('quantity_' + foodID);
            var currentQuantity = parseInt(quantityElement.innerText);
            var newQuantity = currentQuantity + 1;
            updateQuantity(foodID, newQuantity, unitPrice);
        }

        function decrementQuantity(foodID, unitPrice) {
            var quantityElement = document.getElementById('quantity_' + foodID);
            var currentQuantity = parseInt(quantityElement.innerText);
            if (currentQuantity > 1) {
                var newQuantity = currentQuantity - 1;
                updateQuantity(foodID, newQuantity, unitPrice);
            }
        }

        function submitOrderForm() {
            document.getElementById('orderForm').submit();
        }
    </script>

    <?php
} else {
    header('Location: ../login/login.php');
}
?>
</body>
</html>
