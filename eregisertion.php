<?php      
    include('connection.php'); 
    $name = $_POST['name'];
    $mobile = $_POST['phone'];
    $email = $_POST['email'];
    $emid = $_POST['Eid'];
    $usernam = $_POST['username'];
    $password = $_POST['password'];
    
    // Assuming 'AB123456' is a value and not a column name
    $sql = "INSERT INTO employe (name, mobile, email, emid, username, password) 
            VALUES ('$name', '$mobile', '$email', '$emid', '$usernam', '$password')";  
    
    $result = mysqli_query($con, $sql);   
          
    if($result) {  
        echo "<script>alert('Register successful'); window.location.href = 'http://localhost//project/login.html';</script>";
    } else {
        echo "Error: " . mysqli_error($con); // Output any MySQL errors for debugging
    }
?>
