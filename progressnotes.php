<?php
include 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SessionID = $_POST['SessionID']; // Corrected variable name
    $TherapistID = $_POST['TherapistID'];
    $NoteText = $_POST['NoteText'];

    $sql = "INSERT INTO progressnotes (SessionID, TherapistID, NoteText) 
            VALUES ('$SessionID', '$TherapistID', '$NoteText')"; // Corrected variable name in query

    $result = $connection->query($sql);

    if ($result) {
        echo "Inserted Successfully";
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
	<title>Progressnotes</title>
</head>
<body>
		<h1>Progressnotes Form</h1>
<form method="post" action="Progressnotes.php">
<label for="SessionID">SessionID:</label>
<input type="text" id="SessionID" name="SessionID" required><br><br>

<label for="TherapistID">TherapistID:</label>
<input type="text" id="TherapistID" name="TherapistID" required><br><br>

<label for="NoteText">NoteText:</label>
<input type="Text" id="NoteText" name="NoteText" required><br><br>

<input type="submit" name="add" value="Insert"><br><br>

<a href="./home.html">Go Back to Home</a>

</form>
</body>
