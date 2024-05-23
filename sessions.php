<?php
include 'dbconnection.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $TherapistID = $_POST['TherapistID'];
    $ClientID = $_POST['ClientsID']; // Corrected ClientsID variable name
    $SessionDate = $_POST['SessionDate'];
    $SessionDuration = $_POST['SessionDuration']; // Corrected SessionDuration variable name
    $SessionType = $_POST['SessionType']; // Corrected SessionType variable name

    $sql = "INSERT INTO sessions (TherapistID, ClientID, SessionDate, SessionDuration, SessionType) 
            VALUES ('$TherapistID', '$ClientID', '$SessionDate', '$SessionDuration', '$SessionType')";

    $result = $connection->query($sql);

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
    <title>Sessions</title>
</head>
<body>
    <h1>Sessions Form</h1>
    <form method="post" action="Sessions.php">

        <label for="TherapistID">TherapistID:</label>
        <input type="text" id="TherapistID" name="TherapistID" required><br><br>

        <label for="ClientsID">ClientsID:</label>
        <input type="text" id="ClientsID" name="ClientsID" required><br><br>

        <label for="SessionDate">SessionDate:</label>
        <input type="date" id="SessionDate" name="SessionDate" required><br><br>

        <label for="SessionDuration">SessionDuration:</label>
        <input type="text" id="SessionDuration" name="SessionDuration" required><br><br>

        <label for="SessionType">SessionType:</label>
        <input type="text" id="SessionType" name="SessionType" required><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>

    </form>
</body>
</html>
