<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Notice Board</title>
  <link rel="stylesheet" href="notice.css">
</head>
<body>
  <div class="container">
    <nav>
      <ul>
        <li><a href="http://localhost//project/home.html">Home</a></li>
      </ul>
    </nav>
    <div class="notice">
      <h1>Notice Board</h1>
    </div>
    <table>
      <thead>
        <tr>
          <th>Date</th>
          <th>Subject</th>
          <th>PDF</th>
        </tr>
      </thead>
      <tbody>
        <?php
        // Database connection parameters
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
        // Get today's date in the correct format for MySQL
        $currentDate = date('Y-m-d');
        $sql = "SELECT * FROM notice WHERE DATE(date) = '$currentDate'";
        $result = $conn->query($sql);
        
        // Check if query was successful
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["date"] . "</td>";
                echo "<td>" . $row["notice"] . "</td>";
                echo "<td><a href='notice/" . $row["pdf"] . "' target='_blank'>" . $row["pdf"] . "</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No notices found for today.</td></tr>";
        }
        
        // Close the database connection
        $conn->close();
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
