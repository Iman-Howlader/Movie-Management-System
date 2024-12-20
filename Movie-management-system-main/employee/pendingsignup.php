<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>User Approval System</title>
<style>
    table {
        width: 100%;
        border-collapse: collapse;
    }
    th, td {
        padding: 8px;
        text-align: left;
        border-bottom: 1px solid #ddd;
    }
    th {
        background-color: #f2f2f2;
    }
    .btn-approve, .btn-decline {
        padding: 5px 10px;
        border: none;
        cursor: pointer;
    }
    .btn-approve {
        background-color: green;
        color: white;
    }
    .btn-decline {
        background-color: red;
        color: white;
    }
</style>
</head>
<body>

<?php
// Connect to database
include '../connection.php';

// Retrieve data from tempusersignup table
$sql = "SELECT * FROM tempusersignup";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Temporary User Signups</h2>";
    echo "<table>";
    echo "<tr><th>User ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>DOB</th><th>Gender</th><th>Address</th><th>User Type</th><th>OTP</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["UserID"]."</td><td>".$row["FullName"]."</td><td>".$row["Email"]."</td><td>".$row["Phone"]."</td><td>".$row["DOB"]."</td><td>".$row["Gender"]."</td><td>".$row["Address"]."</td><td>".$row["User_Type"]."</td><td>".$row["OTP"]."</td>";
        echo "<td><a href='approve.php?UserID=".$row["UserID"]."&user_type=".$row["User_Type"]."' class='btn-approve'>Approve</a> <a href='decline.php?UserID=".$row["UserID"]."&user_type=".$row["User_Type"]."' class='btn-decline'>Decline</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No temporary user signups found.</p>";
}

// Retrieve data from tempadminsignup table
$sql = "SELECT * FROM tempadminsignup";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Temporary Admin Signups</h2>";
    echo "<table>";
    echo "<tr><th>User ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>DOB</th><th>Gender</th><th>Address</th><th>User Type</th><th>OTP</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["UserID"]."</td><td>".$row["FullName"]."</td><td>".$row["Email"]."</td><td>".$row["Phone"]."</td><td>".$row["DOB"]."</td><td>".$row["Gender"]."</td><td>".$row["Address"]."</td><td>".$row["User_Type"]."</td><td>".$row["OTP"]."</td>";
        echo "<td><a href='approve.php?email=".$row["Email"]."&user_type=".$row["User_Type"]."' class='btn-approve'>Approve</a> <a href='decline.php?email=".$row["Email"]."&user_type=".$row["User_Type"]."' class='btn-decline'>Decline</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No temporary admin signups found.</p>";
}

// Retrieve data from tempemployeesignup table
$sql = "SELECT * FROM tempemployeesignup";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Temporary Employee Signups</h2>";
    echo "<table>";
    echo "<tr><th>User ID</th><th>Full Name</th><th>Email</th><th>Phone</th><th>DOB</th><th>Gender</th><th>Address</th><th>User Type</th><th>OTP</th><th>Action</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>".$row["UserID"]."</td><td>".$row["FullName"]."</td><td>".$row["Email"]."</td><td>".$row["Phone"]."</td><td>".$row["DOB"]."</td><td>".$row["Gender"]."</td><td>".$row["Address"]."</td><td>".$row["User_Type"]."</td><td>".$row["OTP"]."</td>";
        echo "<td><a href='approve.php?email=".$row["Email"]."&user_type=".$row["User_Type"]."' class='btn-approve'>Approve</a> <a href='decline.php?email=".$row["Email"]."&user_type=".$row["User_Type"]."' class='btn-decline'>Decline</a></td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<p>No temporary employee signups found.</p>";
}

// Close connection
$conn->close();
?>

</body>
</html>
