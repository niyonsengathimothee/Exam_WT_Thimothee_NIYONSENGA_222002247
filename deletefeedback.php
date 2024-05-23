<?php
if (isset($_GET["FeedbackID"])) {
    $FeedbackID = $_GET["FeedbackID"];
    
    // Include file that contains the database connection
    include "dbconnection.php";

    // Check if the connection is successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM feedback WHERE FeedbackID = ?");
    $stmt->bind_param("i", $FeedbackID);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
        // Redirect to viewusers.php
        header("Location: viewfeedback.php");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the prepared statement and the connection
    $stmt->close();
    $connection->close();
}
?>
