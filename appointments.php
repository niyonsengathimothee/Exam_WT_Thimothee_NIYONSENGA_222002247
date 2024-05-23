<?php
include 'dbconnection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ClientID = $_POST['ClientsID'];
    $TherapistID = $_POST['TherapistID'];
    $AppointmentTime = $_POST['AppointmentTime'];
    $Status = $_POST['Status'];
    $sql = "INSERT INTO appointments (ClientID, TherapistID, AppointmentTime, Status) VALUES ('$ClientID', '$TherapistID', '$AppointmentTime', '$Status')";
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
    <title>appointments</title>
</head>
<body>
    <h1>appointments Form</h1>
    <form method="post" action="">
        <label for="ClientsID">ClientsID:</label>
        <input type="text" id="ClientsID" name="ClientsID" required><br><br>

        <label for="TherapistID">TherapistID:</label>
        <input type="text" id="TherapistID" name="TherapistID" required><br><br>

        <label for="AppointmentTime">AppointmentTime:</label>
        <input type="text" id="AppointmentTime" name="AppointmentTime" required><br><br>

        <label for="Status">Status:</label>
        <input type="text" id="Status" name="Status" required><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    </form>
</body>
</html>
