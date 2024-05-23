<?php
session_start();
include "dbconnection.php";

// Initialize variables
$NotificationID = $UserID = $Message = $NotificationType = $Seen = $NotificationDate = "";

// Handle GET request
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["NotificationID"])) {
        header("Location: viewnotifications.php");
        exit;
    }
    $NotificationID = $_GET["NotificationID"];

    // Prepare and execute the SELECT statement
    $sql = "SELECT * FROM notifications WHERE NotificationID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $NotificationID);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the notification exists and populate variables
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $Message = $row["Message"];
        $NotificationType = $row["NotificationType"];
        $Seen = $row["Seen"];
        $NotificationDate = $row["NotificationDate"];
    } else {
        header("Location: viewnotifications.php");
        exit;
    }
}
// Handle POST request
elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $NotificationID = $_POST["NotificationID"];
    $UserID = $_POST['UserID'];
    $Message = $_POST["Message"];
    $NotificationType = $_POST["NotificationType"];
    $Seen = $_POST["Seen"];
    $NotificationDate = $_POST["NotificationDate"];

    // Check if any field is empty
    if (empty($NotificationID) || empty($UserID) || empty($Message) || empty($NotificationType) || empty($Seen) || empty($NotificationDate)) {
        echo "All fields are required!";
    } else {
        // Prepare and execute the UPDATE statement
        $sql = "UPDATE notifications SET UserID=?, Message=?, NotificationType=?, Seen=?, NotificationDate=? WHERE NotificationID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("issssi", $UserID, $Message, $NotificationType, $Seen, $NotificationDate, $NotificationID);
        
        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("Location: viewnotifications.php");
            exit;
        } else {
            echo "Error updating record: " . $connection->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Virtual Art Therapy Sessions Platform</title>
    <script>
        function confirmUpdate() {
            return confirm('Do you want to update this record?');
        }
    </script>
    <style>
        h2 {
            font-family: Castellar;
            color: darkblue;
        }
        label {
            font-family: Elephant;
            font-size: 20px;
        }
        .sb {
            font-family: Georgia;
            padding: 10px;
            border-color: blue;
            background-color: skyblue;
            width: 200px;
            margin-top: 5px;
            border-radius: 12px;
            font-weight: bold;
            color: blue;
        }
        .input {
            width: 350px;
            height: 35px;
            border-radius: 12px;
            border-color: green;
        }
    </style>
</head>
<body>
    <center>
        <h2>VIRTUAL ART THERAPY SESSIONS PLATFORM</h2>
        <h3 style="color: green;">UPDATE INFORMATION OF NOTIFICATIONS</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Notification ID</label><br>
                <input type="text" name="NotificationID" readonly class="input" value="<?php echo $NotificationID; ?>"><br>
                <label>User ID</label><br>
                <input type="text" name="UserID" readonly class="input" value="<?php echo $UserID; ?>"><br>
                <label>Message</label><br>
                <input type="text" name="Message" class="input" value="<?php echo $Message; ?>"><br>
                <label>Notification Type</label><br>
                <input type="text" name="NotificationType" value="<?php echo $NotificationType; ?>" class="input"><br>
                <label>Seen</label><br>
                <input type="text" name="Seen" value="<?php echo $Seen; ?>" class="input"><br>
                <label>Notification Date</label><br>
                <input type="date" name="NotificationDate" value="<?php echo $NotificationDate; ?>" class="input"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color: white; text-align: center; margin-top: 40px; background-color: black; height: 40px;"><marquee>&copy; Copy_2024 &reg; Designed By Thimothee</marquee></p>
    </footer>
</body>
</html>
