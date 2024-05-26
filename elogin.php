<?php      
    include('connection.php');  
    $username = $_POST['email'];  
    $password = $_POST['password'];  
      
        //to prevent from mysqli injection  
        $username = stripcslashes($username);  
        $password = stripcslashes($password);  
        $username = mysqli_real_escape_string($con, $username);  
        $password = mysqli_real_escape_string($con, $password);  
      
        $sql = "select *from employe where username = '$username' and password = '$password'";  
        $result = mysqli_query($con, $sql);  
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);  
        $count = mysqli_num_rows($result);  
          
        if($count == 1){  
            echo "<script>alert('Login successful'); window.location.href = 'http://localhost//project/timesheet.html';</script>";
        }  
        else{  
            echo "<script>alert('Invalid username or password'); window.location.href = 'http://localhost//project/login.html';</script>";
        }     
        $userName = "select name from user where username = '$username' and password = '$password'";
        echo json_encode(["name" => $userName]);
?>  