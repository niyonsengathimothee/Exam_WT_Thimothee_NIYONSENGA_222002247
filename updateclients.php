<?php
include "dbconnection.php";

$ClientID = $UserID = $TherapyBackground = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["ClientID"])) {
        header("Location: viewclients.php");
        exit;
    }
    $ClientID = $_GET["ClientID"];

    $sql = "SELECT * FROM clients WHERE ClientID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $ClientID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row['UserID'];
        $TherapyBackground = $row["TherapyBackground"];
    } else {
        header("Location: viewclients.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ClientID = $_POST["ClientID"];
    $UserID = $_POST['UserID'];
    $TherapyBackground = $_POST["TherapyBackground"];

    if (empty($ClientID) || empty($UserID) || empty($TherapyBackground)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE clients SET UserID=?, TherapyBackground=? WHERE ClientID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("isi", $UserID, $TherapyBackground, $ClientID);
        
        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("Location: viewclients.php");
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
        <h3 style="color: green;">UPDATE INFORMATION OF CLIENTS</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Therapist ID</label><br>
                <input type="text" name="ClientID" readonly class="input" value="<?php echo $ClientID; ?>"><br>
                <label>User ID</label><br>
                <input type="text" name="UserID" readonly class="input" value="<?php echo $UserID; ?>"><br>
                <label>TherapyBackground</label><br>
                <input type="text" name="TherapyBackground" class="input" value="<?php echo $TherapyBackground; ?>"><br>s
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color: white; text-align: center; margin-top: 40px; background-color: black; height: 40px;"><marquee>&copy; Copy_2024 &reg; Designed By Thimothee</marquee></p>
    </footer>
</body>
</html>
