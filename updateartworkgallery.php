<?php
include "dbconnection.php";

$ArtworkID = $SessionID = $Title = $Description = $ImageURL = $CreationDate = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["ArtworkID"])) {
        header("Location: artworkgallery.php");
        exit;
    }
    $ArtworkID = $_GET["ArtworkID"];

    $sql = "SELECT * FROM artworkgallery WHERE ArtworkID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $ArtworkID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $SessionID = $row['SessionID'];
        $Title = $row["Title"];
        $Description = $row["Description"];
        $ImageURL = $row["ImageURL"];
        $CreationDate = $row["CreationDate"];
    } else {
        header("Location: viewartworkgallery.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $ArtworkID = $_POST["ArtworkID"];
    $SessionID = $_POST['SessionID'];
    $Title = $_POST["Title"];
    $Description = $_POST["Description"];
    $ImageURL = $_POST["ImageURL"];
    $CreationDate = $_POST["CreationDate"];

    if (empty($ArtworkID) || empty($SessionID) || empty($Title) || empty($Description) || empty($ImageURL) || empty($CreationDate)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE artworkgallery SET SessionID=?, Title=?, Description=? , ImageURL=? , CreationDate=? WHERE ArtworkID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("issssi", $SessionID, $Title, $Description, $ImageURL, $CreationDate, $ArtworkID);
        
        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("Location: viewartworkgallery.php");
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
        <h3 style="color: green;">UPDATE INFORMATION OF ARTWORKGALLERY</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Therapist ID</label><br>
                <input type="text" name="ArtworkID" readonly class="input" value="<?php echo $ArtworkID; ?>"><br>
                <label>User ID</label><br>
                <input type="text" name="SessionID" readonly class="input" value="<?php echo $SessionID; ?>"><br>
                <label>Title</label><br>
                <input type="text" name="Title" class="input" value="<?php echo $Title; ?>"><br>
                <label>Description</label><br>
                <input type="TEXT" name="Description" value="<?php echo $Description; ?>" class="input"><br>
                <label>ImageURL</label><br>
                <input type="text" name="ImageURL" value="<?php echo $ImageURL; ?>" class="input"><br>
                <label>CreationDate</label><br>
                <input type="Date" name="CreationDate" value="<?php echo $CreationDate; ?>" class="input"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color: white; text-align: center; margin-top: 40px; background-color: black; height: 40px;"><marquee>&copy; Copy_2024 &reg; Designed By Thimothee</marquee></p>
    </footer>
</body>
</html>
