<?php
include "dbconnection.php";

$NoteID = $SessionID = $TherapistID = $NoteText = $NoteDate = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["NoteID"])) {
        header("Location: viewprogressnotes.php");
        exit;
    }
    $NoteID = $_GET["NoteID"];

    $sql = "SELECT * FROM progressnotes WHERE NoteID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $NoteID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $SessionID = $row['SessionID'];
        $TherapistID = $row["TherapistID"];
        $NoteText = $row["NoteText"];
        $NoteDate = $row["NoteDate"];
    } else {
        header("Location: viewprogressnotes.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $NoteID = $_POST["NoteID"];
    $SessionID = $_POST['SessionID'];
    $TherapistID = $_POST["TherapistID"];
    $NoteText = $_POST["NoteText"];
    $NoteDate = $_POST["NoteDate"];

    if (empty($NoteID) || empty($SessionID) || empty($TherapistID) || empty($NoteText) || empty($NoteDate)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE progressnotes SET SessionID=?, TherapistID=?, NoteText=? , NoteDate=? WHERE NoteID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iissi", $SessionID, $TherapistID, $NoteText, $NoteDate, $NoteID);
        
        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("Location: viewprogressnotes.php");
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
        <h3 style="color: green;">UPDATE INFORMATION OF PROGRESSNOTES</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Therapist ID</label><br>
                <input type="text" name="NoteID" readonly class="input" value="<?php echo $NoteID; ?>"><br>
                <label>User ID</label><br>
                <input type="text" name="SessionID" readonly class="input" value="<?php echo $SessionID; ?>"><br>
                <label>TherapistID</label><br>
                <input type="text" name="TherapistID" class="input" value="<?php echo $TherapistID; ?>"><br>
                <label>SessionDate</label><br>
                <label>NoteText</label><br>
                <input type="text" name="NoteText" value="<?php echo $NoteText; ?>" class="input"><br>
                <label>NoteDate</label><br>
                <input type="date" name="NoteDate" value="<?php echo $NoteDate; ?>" class="input"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color: white; text-align: center; margin-top: 40px; background-color: black; height: 40px;"><marquee>&copy; Copy_2024 &reg; Designed By Thimothee</marquee></p>
    </footer>
</body>
</html>
