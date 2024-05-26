<?php
include('connection.php'); 

// Get POST data
$day = $_POST['day'];
$date = $_POST['date'];
$market = $_POST['marketing'];
$sales = $_POST['sales'];
$target = $_POST['target'];
$remark = $_POST['remarks'];
$Emid = $_POST['emid'];

// Check if Emid is valid
$check_sql = "SELECT * FROM employe WHERE emid = '$Emid'";
$check_result = mysqli_query($con, $check_sql);

if (mysqli_num_rows($check_result) > 0) {
    // Emid is valid, proceed with the insert
    $sql = "INSERT INTO timeshee (date, marketing, sales, target, Remark, Eid, day)
            VALUES ('$date','$market','$sales','$target','$remark','$Emid','$day')";
    $result = mysqli_query($con, $sql);

    if ($result) {
        echo "<script>alert('Submit successful'); window.location.href = 'http://localhost/project/timesheet.html';</script>";
    } else {
        echo "<script>alert('Error submitting data'); window.history.back();</script>";
    }
} else {
    // Emid is not valid, show an error message
    echo "<script>alert('Please Enter Valid Employee ID'); window.history.back();</script>";
}
?>
