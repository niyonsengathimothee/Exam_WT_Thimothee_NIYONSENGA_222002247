<?php
include 'dbconnection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SessionID=$_POST['SessionID'];
    $Title=$_POST['Title'];
    $Description=$_POST['Description'];
    $ImageURL=$_POST['ImageURL'];
    $sql="INSERT INTO artworkgallery (SessionID,Title,Description,ImageURL) VALUES('$SessionID','$Title','$Description','$ImageURL')";
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
	<title>artworkgallery</title>
</head>
<body>
		<h1>artworkgallery Form</h1>
<form method="post" action="">

<label for="SessionID">SessionID:</label>
<input type="text" id="SessionID" name="SessionID" required><br><br>

<label for="Title">Title:</label>
<input type="text" id="Title" name="Title" required><br><br>

<label for="Description">Description:</label>
<input type="Text" id="Description" name="Description" required><br><br>

<label for="ImageURL">ImageURL:</label>
<input type="Text" id="ImageURL" name="ImageURL" required><br><br>

<input type="submit" name="add" value="Insert"><br><br>

<a href="./home.html">Go Back to Home</a>

</form>
</body>
</html>