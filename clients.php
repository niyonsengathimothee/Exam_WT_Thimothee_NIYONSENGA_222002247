<?php
include 'dbconnection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UserID = $_POST['UserID'];
    $TherapyBackground = $_POST['TherapyBackground'];
    $sql = "INSERT INTO clients (UserID, TherapyBackground) VALUES ('$UserID', '$TherapyBackground')";
    $result=$connection->query($sql);
    if ($result) {
        echo "Inserted Successfully";
        exit();
    } else {
        echo "Insertion failed";
    }
}
?>


<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>clients</title>
</head>
<body>
		<h1>clients Form</h1>
<form method="post" action="clients.php">

<label for="UserID">UserID:</label>
<input type="text" id="UserID" name="UserID" required><br><br>

<label for="TherapyBackground">TherapyBackground:</label>
<input type="text" id="TherapyBackground" name="TherapyBackground" required><br><br>


<input type="submit" name="add" value="Insert"><br><br>

<a href="./home.html">Go Back to Home</a>

</form>
</body>
</html>