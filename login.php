<?php
session_start();
include "dbconnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $Email = $_POST['Email'];
    $Password = $_POST['Password'];
    
    // Use prepared statements to prevent SQL injection
    $stmt = $connection->prepare("SELECT * FROM users WHERE Email = ? AND Password = ?");
    $stmt->bind_param("ss", $Email, $Password);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        $user_id = $row['id'];
        
        $_SESSION['user_id'] = $user_id;
        $_SESSION['Email'] = $Email;
        
        header("Location: home.html"); 
        exit();
    } else {
        echo "Invalid Email or Password";
        exit();
    }
    
    $stmt->close();
}

$connection->close();
?>