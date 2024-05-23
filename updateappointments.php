<?php
include "dbconnection.php";

$AppointmentID = $ClientID = $TherapistID = $AppointmentTime = $Status = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["AppointmentID"])) {
        header("Location: viewappointments.php");
        exit;
    }
    $AppointmentID = $_GET["AppointmentID"];

    $sql = "SELECT * FROM appointments WHERE AppointmentID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $AppointmentID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $ClientID = $row['ClientID'];
        $TherapistID = $row["TherapistID"];
        $AppointmentTime = $row["AppointmentTime"];
        $Status = $row["Status"];
    } else {
        header("Location: viewappointments.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $AppointmentID = $_POST["AppointmentID"];
    $ClientID = $_POST['ClientID'];
    $TherapistID = $_POST["TherapistID"];
    $AppointmentTime = $_POST["AppointmentTime"];
    $Status = $_POST["Status"];

    if (empty($AppointmentID) || empty($ClientID) || empty($TherapistID) || empty($AppointmentTime) || empty($Status)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE appointments SET ClientID=?, TherapistID=?, AppointmentTime=? , Status=? WHERE AppointmentID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iiisi", $ClientID, $TherapistID, $AppointmentTime, $Status, $AppointmentID);
        
        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("Location: viewappointments.php");
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
    <title>Virtual art therapy sessions Platform</title>
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
            font-family: elephant;
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
        <h3 style="color: green;">UPDATE INFORMATION OF APPOINTMENTS</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Appointment ID</label><br>
                <input type="text" name="AppointmentID" readonly class="input" value="<?php echo $AppointmentID; ?>"><br>
                <label>User ID</label><br>
                <input type="text" name="ClientID" readonly class="input" value="<?php echo $ClientID; ?>"><br>
                <label>TherapistID</label><br>
                <input type="text" name="TherapistID" class="input" value="<?php echo $TherapistID; ?>"><br>
                <label>AppointmentTime</label><br>
                <input type="text" name="AppointmentTime" value="<?php echo $AppointmentTime; ?>" class="input"><br>
                <label>Status</label><br>
                <input type="TEXT" name="Status" value="<?php echo $Status; ?>" class="input"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color: white; text-align: center; margin-top: 40px; background-color: black; height: 40px;"><marquee>&copy; Copy_2024 &reg; Designed By Thimothee</marquee></p>
    </footer>
</body>
</html>
