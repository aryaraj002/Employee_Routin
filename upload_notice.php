<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input
    $notice = $_POST["subject"];
    $filename = $_FILES["pdf"]["name"];
    $tempfile = $_FILES["pdf"]["tmp_name"];
    $folder = "notice/" . $filename;
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "timesheet";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare and bind the SQL statement
    $sql = "INSERT INTO notice (date, notice, pdf) VALUES (CURRENT_TIMESTAMP, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $notice, $filename); // Bind two parameters (notice and filename)

    // Execute the statement
    if ($stmt->execute() === TRUE) {
        move_uploaded_file($tempfile, $folder);
        echo "<script>alert('Notice Upload Sucessfully'); window.history.back();</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
}
?>
