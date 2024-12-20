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
            display: grid;
            grid-template-columns: 1fr 4fr;
            gap: 20px;
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

        .action-btns button.order-btn {
            background-color: #27ae60; /* Green */
            color: white;
        }

        .action-btns button.quantity-btn {
            background-color: #3498db; /* Blue */
            color: white;
        }

        .action-btns button.quantity-btn:disabled {
            background-color: #7f8c8d; /* Gray */
            cursor: not-allowed;
        }

        .action-btns button.quantity-btn:hover {
            background-color: #2980b9; /* Darker blue on hover */
        }

        .sidebar {
            background-color: #ddd;
            padding: 10px;
            border-radius: 5px;
        }

        .sidebar input[type="number"] {
            width: 80px;
        }

        .sidebar button {
            margin-top: 10px;
            padding: 5px 10px;
            border: none;
            background-color: #4CAF50; /* Green */
            color: white;
            border-radius: 3px;
            cursor: pointer;
        }

        .category-buttons {
            margin-top: 20px;
        }

        .availability-buttons {
            margin-top: 10px;
        }

        /* Added styles for checkbox container */
        .checkbox-container {
            margin-top: 10px;
            text-align: center;
        }
        
    </style>
</head>
<body>
    <div class="container">
        <div class="sidebar">
            <h2>Price Filter</h2>
            <label for="min-price">Min Price:</label>
            <input type="number" id="min-price" min="0" max="1000" value="0">
            <input type="range" id="price-slider-min" min="0" max="1000" value="0" oninput="updatePriceSliderValue('min')">
            <br>
            <label for="max-price">Max Price:</label>
            <input type="number" id="max-price" min="0" max="1000" value="1000">
            <input type="range" id="price-slider-max" min="0" max="1000" value="1000" oninput="updatePriceSliderValue('max')">
            <div class="action-buttons">
                <button onclick="filterPrice()">Apply Filter</button>
                
            </div>
            <!-- Checkbox container moved here -->
            <div class="checkbox-container">
                <div class="category-buttons">
                <label for="category"><h4 style="color:Red; border: 1px solid black;">Category</h4></label>
                   
                   
                    <input type="checkbox" id="fastfood" onclick="filterCategory(this)"checked>Fast Food <br>
                    <input type="checkbox" id="drinks" onclick="filterCategory(this)" checked>  Drinks<br>
                    <input type="checkbox" id="combo" onclick="filterCategory(this)"checked>    Combo<br>
                    <input type="checkbox" id="others" onclick="filterCategory(this)"checked>   Others<br>
                </div>
                <div class="availability-buttons">
                <label for="availabilty(foof status)"><h4 style="color:Red; border: 1px solid black;">Avalability</h4></label>
                    <input type="checkbox" id="available-now" onclick="filterAvailability()" checked> Available Now <br>
                    <input type="checkbox" id="not-available-now" onclick="filterAvailability()" checked> Not Available Now <br>
                </div>
            </div>
        </div>
        <div>
            <h1>Food List</h1>
            <table>
                <thead>
                    <tr>
                        <th>Food Name</th>
                        <th>Image</th>
                        <th>Price</th>
                        <th>Category</th>
                        <th>Availability</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody id="food-list">
                    <?php
                    include '../connection.php'; // Assuming this file includes database connection details

                    // Retrieve food information from the database
                    $sql = "SELECT * FROM foods";
                    $result = $conn->query($sql);

                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr class='food-item' data-category='" . $row["FoodCategory"] . "' data-availability='" . $row["FoodStatus"] . "'>";
                            echo "<td>" . $row["FoodName"] . "</td>";
                            echo "<td><img src='../movieadmin/foodimages/" . $row["FoodImage"] . "' alt='" . $row["FoodName"] . "'></td>";
                            echo "<td>" . $row["FoodPrice"] . " TK</td>";
                            echo "<td>" . ucfirst($row["FoodCategory"]) . "</td>";
                            echo "<td>" . ($row["FoodStatus"] == 1 ? 'Available Now' : 'Not Available Now') . "</td>";
                            echo "<td class='action-btns'>";
                            if ($row["FoodStatus"] == 1) {
                                echo "<button class='order-btn' onclick='orderFood(" . $row["FoodID"] . ")'>Order</button>";
                                echo "<button class='quantity-btn' onclick='incrementQuantity(" . $row["FoodID"] . ")'>+</button>";
                                echo "<button class='quantity-btn' onclick='decrementQuantity(" . $row["FoodID"] . ")'>-</button>";
                            } else {
                                echo "<button class='quantity-btn' disabled>Order</button>";
                                echo "<button class='quantity-btn' disabled>+</button>";
                                echo "<button class='quantity-btn' disabled>-</button>";
                            }
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='6'>No food items found</td></tr>";
                    }
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        function orderFood(foodID) {
            // Implement your order functionality here
            alert("Order placed for food ID: " + foodID);
        }

        function incrementQuantity(foodID) {
            // Implement increment quantity functionality here
            alert("Increment quantity for food ID: " + foodID);
        }

        function decrementQuantity(foodID) {
            // Implement decrement quantity functionality here
            alert("Decrement quantity for food ID: " + foodID);
        }

        function filterCategory(checkbox) {
            var foodItems = document.getElementsByClassName('food-item');
            var checkedCategories = [];

    // Loop through checkboxes to get checked categories
    var checkboxes = document.querySelectorAll('.category-buttons input[type="checkbox"]');
    for (var i = 0; i < checkboxes.length; i++) {
        if (checkboxes[i].checked) {
            checkedCategories.push(checkboxes[i].id);
        }
    }

    for (var i = 0; i < foodItems.length; i++) {
        var foodCategory = foodItems[i].getAttribute('data-category');
        var foodAvailability = foodItems[i].getAttribute('data-availability');

        if (checkedCategories.length === 0 || checkedCategories.includes(foodCategory)) {
            if ((document.getElementById('available-now').checked && foodAvailability == 1) ||
                (document.getElementById('not-available-now').checked && foodAvailability == 0)) {
                foodItems[i].style.display = 'table-row';
            } else {
                foodItems[i].style.display = 'none';
            }
        } else {
            foodItems[i].style.display = 'none';
        }
    }
        }

        function filterAvailability() {
            var foodItems = document.getElementsByClassName('food-item');
            var checkedCategories = [];

            // Loop through checkboxes to get checked categories
            var checkboxes = document.querySelectorAll('.category-buttons input[type="checkbox"]');
            for (var i = 0; i < checkboxes.length; i++) {
                if (checkboxes[i].checked) {
                    checkedCategories.push(checkboxes[i].id);
                }
            }

            for (var i = 0; i < foodItems.length; i++) {
                var foodCategory = foodItems[i].getAttribute('data-category');
                var foodAvailability = foodItems[i].getAttribute('data-availability');
                if (checkedCategories.length === 0 || checkedCategories.includes(foodCategory)) {
                    if ((document.getElementById('available-now').checked && foodAvailability == 1) ||
                        (document.getElementById('not-available-now').checked && foodAvailability == 0)) {
                        foodItems[i].style.display = 'table-row';
                    } else {
                        foodItems[i].style.display = 'none';
                    }
                } else {
                    foodItems[i].style.display = 'none';
                }
            }
        }

        function filterPrice() {
            var minPrice = parseFloat(document.getElementById('min-price').value);
            var maxPrice = parseFloat(document.getElementById('max-price').value);
            var foodItems = document.getElementsByClassName('food-item');

            for (var i = 0; i < foodItems.length; i++) {
                var foodPrice = parseFloat(foodItems[i].querySelector('td:nth-child(3)').innerText.replace(' TK', ''));

                if (foodPrice >= minPrice && foodPrice <= maxPrice) {
                    foodItems[i].style.display = 'table-row';
                } else {
                    foodItems[i].style.display = 'none';
                }
            }
        }

        function updatePriceSliderValue(type) {
            if (type === 'min') {
                var sliderValue = document.getElementById('price-slider-min').value;
                document.getElementById('min-price').value = sliderValue;
            } else if (type === 'max') {
                var sliderValue = document.getElementById('price-slider-max').value;
                document.getElementById('max-price').value = sliderValue;
            }
            filterPrice(); // Update food list based on the new slider value
        }
    </script>
</body>
</html>
