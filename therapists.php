<?php
include 'dbconnection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UserID = $_POST['UserID'];
    $Qualifications = $_POST['Qualifications'];
    $yearofexperience = $_POST['yearofexperience'];
    $sql = "INSERT INTO therapists (UserID, Qualifications, yearofexperience) VALUES ('$UserID', '$Qualifications', '$yearofexperience')";
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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Therapists</title>
</head>
<body>
    <h1>Therapists Form</h1>
    <form method="post" action="therapists.php">
        <label for="UserID">UserID:</label>
        <input type="text" id="UserID" name="UserID" required><br><br>

        <label for="Qualifications">Qualifications:</label>
        <input type="text" id="Qualifications" name="Qualifications" required><br><br>

        <label for="yearofexperience">Years of Experience:</label>
        <input type="text" id="yearofexperience" name="yearofexperience" required><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    </form>
</body>
</html>
