<?php
include('connection.php'); 

$employeeId = $_POST['employeeId'];
$employeeName = $_POST['employeeName'];
$currentDate = $_POST['currentDate'];
$currentTime = $_POST['currentTime'];
$timeParts = explode(':', $currentTime);
$hours = intval($timeParts[0]);
$minutes = intval($timeParts[1]);

// Convert time to total minutes
$totalMinutes = $hours * 60 + $minutes;

// Determine attendance status
if ($totalMinutes >= 525 && $totalMinutes <= 570) { // 8:45 to 9:30
    $status = 'Present';
} elseif ($totalMinutes > 570 && $totalMinutes <= 780) { // 9:30 to 13:00
    $status = 'Half Day';
} else {
    $status = 'Absent';
}

// Check if employeeId is valid using prepared statements
$check_sql = "SELECT * FROM employe WHERE emid = ?";
$stmt = $con->prepare($check_sql);
$stmt->bind_param("s", $employeeId);
$stmt->execute();
$check_result = $stmt->get_result();

if ($check_result->num_rows > 0) {
    // employeeId is valid, proceed with the insert
    $insert_sql = "INSERT INTO attendanc (Eid, Name, date, time, Status) VALUES (?, ?, ?, ?, ?)";
    $insert_stmt = $con->prepare($insert_sql);
    $insert_stmt->bind_param("sssss", $employeeId, $employeeName, $currentDate, $currentTime, $status);
    $result = $insert_stmt->execute();

    if ($result) {
        echo "<script>alert('Attendance Mark successful'); window.location.href = 'http://localhost/project/home.html';</script>";
    } else {
        echo "Error: " . $insert_stmt->error; // Output any errors for debugging
    }
} else {
    // employeeId is not valid, show an error message
    echo "<script>alert('Invalid Employee ID'); window.history.back();</script>";
}
?>
