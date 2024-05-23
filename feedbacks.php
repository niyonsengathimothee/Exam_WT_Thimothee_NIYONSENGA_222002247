<?php
include 'dbconnection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SessionID = $_POST['SessionID'];
    $ClientID = $_POST['ClientID'];
    $Rating = $_POST['Rating'];
    $Comment = $_POST['Comment'];
    $sql = "INSERT INTO feedback (SessionID, ClientID, Rating, Comment) VALUES ('$SessionID', '$ClientID', '$Rating', '$Comment')";
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
    <title>Feedbacks</title>
</head>
<body>
    <h1>Feedbacks Form</h1>
    <form method="post" action="">
        <label for="SessionID">SessionID:</label>
        <input type="text" id="SessionID" name="SessionID" required><br><br>

        <label for="ClientID">ClientID:</label>
        <input type="text" id="ClientID" name="ClientID" required><br><br>

        <label for="Rating">Rating:</label>
        <input type="text" id="Rating" name="Rating" required><br><br>

        <label for="Comment">Comment:</label>
        <input type="text" id="Comment" name="Comment" required><br><br>

        <input type="submit" name="add" value="Insert"><br><br>

        <a href="./home.html">Go Back to Home</a>
    </form>
</body>
</html>
