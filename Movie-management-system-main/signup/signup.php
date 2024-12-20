
<?php
include '../connection.php';
include 'signup.html';

?>  


<?php
 
     

// Process signup form data
if (isset($_POST['submit'])) {
    $fullname = $_POST["fullname"];
    
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $user_type = $_POST['user_type'];
    $password = $_POST["password"];
    $confirm_password = $_POST["confirm_password"];

    //for image
    // Image upload handling
    $filename = $_FILES['upfile']['name'];
    $tmploc= $_FILES['upfile']['tmp_name'];
    $uploc ="signupImages/".$filename;

    if(move_uploaded_file($tmploc,$uploc)){
         echo "Uploaded.";

    }else{
        echo "Not uploaded";
    }
     

    $today = date("Y-m-d");
    if ($dob >= $today) {
        echo '<script>alert("Date of birth must be before today\'s date.");</script>';
        exit;
    }
   



    //checking is the any duplicate email or phone number or user id 
    if($user_type === 'user'){
    $checkUser = "SELECT * FROM usersignup 
                WHERE Email = '$email' OR Phone = '$phone'  ";
    }
    else if($user_type==='admin'){
        $checkUser = "SELECT * FROM adminsignup 
                WHERE Email = '$email' OR Phone = '$phone'  ";
    }
    else if($user_type==='employee'){
        $checkUser = "SELECT * FROM employeesignUp 
                WHERE Email = '$email' OR Phone = '$phone'  ";
    }

    $result  = mysqli_query($conn,$checkUser);
    $count   = mysqli_num_rows($result);

    if($count>0){
        echo '<script>alert("user Already sign up using this Phone Number Or Email.")</script>'; 
       // echo "user Already sign up using this Phone Number Or Email.";
       // header("location:signup:.html");
    }
    else{


    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match. Please try again.')</script>";
        echo "<script>window.location.href = 'signup.html';</script>";
        exit;
    }
    

    // Construct SQL query
    if($user_type === 'user'){
    $sql = "INSERT INTO tempusersignup ( FullName,  Email, Phone, DOB, Gender, Address, Password,User_Type,Image,OTP)
                        VALUES ('$fullname', '$email', '$phone', '$dob', '$gender', '$address', '$password','$user_type','$filename','invalid')";
    }

    else if($user_type==='admin') {
        $sql = "INSERT INTO tempadminsignup ( FullName,  Email, Phone, DOB, Gender, Address, Password,User_Type,Image,OTP)
                        VALUES ('$fullname', '$email', '$phone', '$dob', '$gender', '$address', '$password','$user_type','$filename','invalid')";

 }
    else if($user_type==='employee') {
              $joiningDate = date("Y-m-d");
            $sql = "INSERT INTO tempemployeeSignUp ( FullName,  Email, Phone, DOB, Gender, Address, Password,User_Type,JoiningDate,Image,OTP)
                    VALUES ('$fullname', '$email', '$phone', '$dob', '$gender', '$address', '$password','$user_type','$joiningdate','$filename','invalid')";
    }
   



    // Execute SQL query
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }



    // For security reasons, don't echo passwords in real application
    $conn->close();
    header('location:sendOTP.php?email='.$email. ' & user_type='.$user_type);

}
}

?>