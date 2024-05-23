<?php
if (isset($_GET["UserID"])) {
    $UserID = $_GET["UserID"];
    
    // Include file that contains the database connection
    include "dbconnection.php";

    // Check if the connection is successful
    if ($connection->connect_error) {
        die("Connection failed: " . $connection->connect_error);
    }

    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare("DELETE FROM notifications WHERE UserID = ?");
    $stmt->bind_param("i", $UserID);

    if ($stmt->execute()) {
        echo "Record deleted successfully";
        // Redirect to viewusers.php
        header("Location: viewusers.php");
        exit;
    } else {
        echo "Error deleting record: " . $stmt->error;
    }

    // Close the prepared statement and the connection
    $stmt->close();
    $connection->close();
}
?>
