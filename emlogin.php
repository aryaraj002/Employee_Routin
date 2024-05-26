<?php        
    $username = $_POST['email'];  
    $password = $_POST['password'];  
            
        if(($username == 'Admin123')||($password=='123')){  
            echo "<script>alert('Login successful'); window.location.href = 'http://localhost//project/emreview.html';</script>";
        }  
        else{  
            echo "<script>alert('Invalid username or password'); window.location.href = 'http://localhost//project/login.html';</script>";
        }     
        $userName = "select name from user where username = '$username' and password = '$password'";
        echo json_encode(["name" => $userName]);
?>  