<?php
include('connection.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize the input
    $searchEmployeeId = htmlspecialchars($_POST["Eid"]);


    // Fetch data from the database based on the entered vehicle number
    $sql = "SELECT * FROM attendanc WHERE Eid = '$searchEmployeeId' ";
    $result = mysqli_query($con, $sql);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charging History</title>
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
        ul{
            list-style-type: none;
            margin: 0;
            padding: 0;
            overflow: hidden;
            width: 100%;
            background: #4CAF50;
            display: flex;
        }
        li{
            display: inline-block;
            list-style: none;
            margin-right: 10px;
        }
        li a{
            display: block;
            padding: 8px;
            color: white;
        }
    </style>
</head>
<body>
<nav>
        <ul>
            <li><a href="http://localhost//project/home.html">Home</a></li>
            <li><a href="http://localhost//project/report.html">Back</a></li>
        </ul>
    </nav>
    <h2>Employee</h2>
    <table>
        <thead>
            <tr>
                <th>Date</th>
                <th>time</th>
                <th>Status</th>
    </tr>
        </thead>
        <tbody>
            <?php
                    if ($result->num_rows > 0) {
                        while($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["date"] . "</td>";
                            echo "<td>" . $row["time"] . "</td>";
                            echo "<td>" . $row["Status"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='7'>No records found for the entered date range</td></tr>";
                    }

                    // Close the database connection
                    $con->close();
            ?>
        </tbody>
    </table>

</body>
</html>

