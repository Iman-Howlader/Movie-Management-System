 
 <?php
    include '../connection/connection.php';
 
 if (isset($_POST['email'])) {
            $fullname = $_POST["fullname"];
                
            $email = $_POST["email"];
            $phone = $_POST["phone"];
            $dob = $_POST["dob"];
            $gender = $_POST["gender"];
            $address = $_POST["address"];
            $user_type = $_POST['user_type'];
            $password = $_POST["password"];
            $confirm_password = $_POST["confirm_password"];

               


            if($user_type === 'user'){
                $sql = "INSERT INTO usersignup ( FullName,  Email, Phone, DOB, Gender, Address, Password,User_Type)
                                    VALUES ('$fullname', '$email', '$phone', '$dob', '$gender', '$address', '$password','$user_type')";
                }
            
                else if($user_type==='admin') {
                    $sql = "INSERT INTO adminsignup ( FullName,  Email, Phone, DOB, Gender, Address, Password,User_Type)
                                    VALUES ('$fullname', '$email', '$phone', '$dob', '$gender', '$address', '$password','$user_type')";
             }
               
            
            
            
                // Execute SQL query
                if ($conn->query($sql) === TRUE) {
                    echo "New record created successfully";
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            
            
            
                // For security reasons, don't echo passwords in real application
                $conn->close();
            }


            ?>