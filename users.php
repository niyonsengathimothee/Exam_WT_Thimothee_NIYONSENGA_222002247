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
        exit();
    }else{
        echo "Inserted fail";
    }

}

?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Users</title>
</head>
<body>
		<h1>Users Form</h1>
<form method="post" action="">

<label for="Username">Username:</label>
<input type="text" id="Username" name="Username" required><br><br>

<label for="Password">Password:</label>
<input type="text" id="Password" name="Password" required><br><br>

<label for="Email">Email:</label>
<input type="text" id="Email" name="Email" required><br><br>

<label for="UserType">UserType:</label>
<input type="text" id="UserType" name="UserType" required><br><br>

<input type="submit" name="add" value="Insert"><br><br>

<a href="./home.html">Go Back to Home</a>

</form>
</body>
</html>