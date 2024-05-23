<?php
include "dbconnection.php";

$TherapistID = $UserID = $Qualifications = $yearofexperience = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["TherapistID"])) {
        header("Location: viewtherapists.php");
        exit;
    }
    $TherapistID = $_GET["TherapistID"];

    $sql = "SELECT * FROM therapists WHERE TherapistID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $TherapistID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $Qualifications = $row["Qualifications"];
        $yearofexperience = $row["yearofexperience"];
    } else {
        header("Location: viewtherapists.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $TherapistID = $_POST["TherapistID"];
    $UserID = $_POST['UserID'];
    $Qualifications = $_POST["Qualifications"];
    $yearofexperience = $_POST["yearofexperience"];

    if (empty($TherapistID) || empty($UserID) || empty($Qualifications) || empty($yearofexperience)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE therapists SET UserID=?, Qualifications=?, yearofexperience=? WHERE TherapistID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("issi", $UserID, $Qualifications, $yearofexperience, $TherapistID);
        
        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("Location: viewtherapists.php");
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
        <h3 style="color: green;">UPDATE INFORMATION OF USERS</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Therapist ID</label><br>
                <input type="text" name="TherapistID" readonly class="input" value="<?php echo $TherapistID; ?>"><br>
                <label>User ID</label><br>
                <input type="text" name="UserID" readonly class="input" value="<?php echo $UserID; ?>"><br>
                <label>Qualifications</label><br>
                <input type="text" name="Qualifications" class="input" value="<?php echo $Qualifications; ?>"><br>
                <label>Years of Experience</label><br>
                <input type="text" name="yearofexperience" value="<?php echo $yearofexperience; ?>" class="input"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color: white; text-align: center; margin-top: 40px; background-color: black; height: 40px;"><marquee>&copy; Copy_2024 &reg; Designed By Thimothee</marquee></p>
    </footer>
</body>
</html>
