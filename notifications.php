<?php
include 'dbconnection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UserID=$_POST['UserID'];
    $Message=$_POST['Message'];
    $NotificationType=$_POST['NotificationType'];
    $Seen=$_POST['Seen'];
    $sql="INSERT INTO notifications (UserID,Message,NotificationType,Seen) VALUES('$UserID','$Message','$NotificationType','$Seen')";
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
	<title>Notifications</title>
</head>
<body>
		<h1>Notifications Form</h1>
<form method="post" action="">
<label for="UserID">UserID:</label>
<input type="text" id="UserID" name="UserID" required><br><br>

<label for="Message">Message:</label>
<input type="text" id="Message" name="Message" required><br><br>

<label for="NotificationType">NotificationType:</label>
<input type="Text" id="NotificationType" name="NotificationType" required><br><br>

<label for="Seen">Seen:</label>
<input type="text" id="Seen" name="Seen" required><br><br>

<input type="submit" name="add" value="Insert"><br><br>

<a href="./home.html">Go Back to Home</a>

</form>
</body>
</html>