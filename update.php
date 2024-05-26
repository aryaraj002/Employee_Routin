<?php
include('connection.php');

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST['review_update'])) {
        // Validate and sanitize input
        $id = $_POST['id'];
        $review = $_POST['review'];

        // Update the review in the database
        $update_query = "UPDATE timeshee SET review = '$review' WHERE Eid = '$id'";
        $update_result = mysqli_query($con, $update_query);

        if($update_result) {
            echo "Review updated successfully.";
        } else {
            echo "Error updating review: " . mysqli_error($con);
        }
    }
}
?>