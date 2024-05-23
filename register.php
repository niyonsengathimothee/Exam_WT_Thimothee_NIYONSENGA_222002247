<?php
include 'dbconnection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Username=$_POST['Username'];
    $Password=$_POST['Password'];
    $Email=$_POST['Email'];
    $UserType=$_POST['UserType'];
    $sql="INSERT INTO users (Username,Password,Email,UserType) VALUES('$Username','$Password','$Email','$UserType')";
    $result=$connection->query($sql);
    if ($result) {
        echo"Inserted Successfully";
        header("login.html");
        exit();
    }else{
        echo "Inserted fail";
    }

}

?>