<?php
include "dbconnection.php";

$SessionID = $TherapistID = $ClientID = $SessionDate = $SessionDuration = $SessionType = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["SessionID"])) {
        header("Location: viewsessions.php");
        exit;
    }
    $SessionID = $_GET["SessionID"];

    $sql = "SELECT * FROM sessions WHERE SessionID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $SessionID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $TherapistID = $row['TherapistID'];
        $ClientID = $row["ClientID"];
        $SessionDate = $row["SessionDate"];
        $SessionDuration = $row["SessionDuration"];
        $SessionType = $row["SessionType"];
    } else {
        header("Location: viewsessions.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SessionID = $_POST["SessionID"];
    $TherapistID = $_POST['TherapistID'];
    $ClientID = $_POST["ClientID"];
    $SessionDate = $_POST["SessionDate"];
    $SessionDuration = $_POST["SessionDuration"];
    $SessionType = $_POST["SessionType"];

    if (empty($SessionID) || empty($TherapistID) || empty($ClientID) || empty($SessionDate) || empty($SessionDuration) || empty($SessionType)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE sessions SET TherapistID=?, ClientID=?, SessionDate=? , SessionDuration=? , SessionType=? WHERE SessionID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iisssi", $TherapistID, $ClientID, $SessionDate, $SessionDuration, $SessionType, $SessionID);
        
        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("Location: viewsessions.php");
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
        <h3 style="color: green;">UPDATE INFORMATION OF SESSIONS</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Therapist ID</label><br>
                <input type="text" name="SessionID" readonly class="input" value="<?php echo $SessionID; ?>"><br>
                <label>User ID</label><br>
                <input type="text" name="TherapistID" readonly class="input" value="<?php echo $TherapistID; ?>"><br>
                <label>ClientID</label><br>
                <input type="text" name="ClientID" class="input" value="<?php echo $ClientID; ?>"><br>
                <label>SessionDate</label><br>
                <input type="date" name="SessionDate" value="<?php echo $SessionDate; ?>" class="input"><br>
                <label>SessionDuration</label><br>
                <input type="text" name="SessionDuration" value="<?php echo $SessionDuration; ?>" class="input"><br>
                <label>SessionType</label><br>
                <input type="text" name="SessionType" value="<?php echo $SessionType; ?>" class="input"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color: white; text-align: center; margin-top: 40px; background-color: black; height: 40px;"><marquee>&copy; Copy_2024 &reg; Designed By Thimothee</marquee></p>
    </footer>
</body>
</html>
