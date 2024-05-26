<?php
include('connection.php');

// Handle form submission for updating review
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['review_update'])) {
    // Validate and sanitize input
    $id = htmlspecialchars($_POST['id']);
    $review = htmlspecialchars($_POST['review']);

    // Update the review in the database
    $update_query = "UPDATE timeshee SET review = ? WHERE Eid = ?";
    $stmt = $con->prepare($update_query);
    $stmt->bind_param("si", $review, $id);
    $update_result = $stmt->execute();

    if ($update_result) {
        echo "<script>alert('Update successfully'); window.history.back();</script>";
    } else {
        echo "Error updating review: " . $con->error;
    }
}

// Fetch data from the database based on the entered employee id
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["Eid"])) {
    $searchEmployeeId = htmlspecialchars($_POST["Eid"]);

    // Fetch timesheet data
    $sql_timesheet = "SELECT * FROM timeshee WHERE Eid = ?";
    $stmt_timesheet = $con->prepare($sql_timesheet);
    $stmt_timesheet->bind_param("i", $searchEmployeeId);
    $stmt_timesheet->execute();
    $result_timesheet = $stmt_timesheet->get_result();

    // Fetch attendance data
    $sql_attendance = "SELECT * FROM attendanc WHERE Eid = ?";
    $stmt_attendance = $con->prepare($sql_attendance);
    $stmt_attendance->bind_param("i", $searchEmployeeId);
    $stmt_attendance->execute();
    $result_attendance = $stmt_attendance->get_result();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Report</title>
    <style>
        body {
            background-image: url('download.jpeg');
            background-size: cover;
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        form {
            max-width: 600px;
            margin: auto;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input, select {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }
        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            cursor: pointer;
        }
        .back-button {
            display: block;
            margin: 20px auto;
            text-align: center;
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            width: 100px;
        }
    </style>
</head>
<body>

    <h2>Employee Timesheet</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Marketing Work</th>
                <th>Sales Work</th>
                <th>Target Report</th>
                <th>Remarks</th>
                <th>Day</th>
                <th>Review</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($result_timesheet) && $result_timesheet->num_rows > 0) {
                while ($row = $result_timesheet->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["marketing"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["sales"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["target"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["Remark"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["day"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["review"]) . "</td>";
                    echo "<td>
                            <form action='' method='post'>
                                <input type='hidden' name='id' value='" . htmlspecialchars($row['Eid']) . "'>
                                <select name='review'>
                                    <option value='0'>0</option>
                                    <option value='1'>1</option>
                                    <option value='2'>2</option>
                                    <option value='3'>3</option>
                                    <option value='4'>4</option>
                                    <option value='5'>5</option>
                                </select>
                                <input type='submit' name='review_update' value='Update'>
                            </form>
                          </td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='8'>No records found for the entered employee id</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <h2>Employee Attendance</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>Time</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php
            if (isset($result_attendance) && $result_attendance->num_rows > 0) {
                while ($row = $result_attendance->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row["date"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["time"]) . "</td>";
                    echo "<td>" . htmlspecialchars($row["Status"]) . "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='3'>No records found for the entered employee id</td></tr>";
            }
            ?>
        </tbody>
    </table>
    <a href="http://localhost/project/emreview.html" class="back-button">Back</a>
</body>
</html>

<?php
// Close the database connection
$con->close();
?>
