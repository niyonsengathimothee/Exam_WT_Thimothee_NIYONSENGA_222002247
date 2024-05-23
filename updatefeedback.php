<?php
include "dbconnection.php";

$FeedbackID = $SessionID = $ClientID = $Rating = $Comment = $FeedbackDate = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["FeedbackID"])) {
        header("Location: viewfeedback.php");
        exit;
    }
    $FeedbackID = $_GET["FeedbackID"];

    $sql = "SELECT * FROM feedback WHERE FeedbackID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $FeedbackID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $SessionID = $row['SessionID'];
        $ClientID = $row["ClientID"];
        $Rating = $row["Rating"];
        $Comment = $row["Comment"];
        $FeedbackDate = $row["FeedbackDate"];
    } else {
        header("Location: viewfeedback.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $FeedbackID = $_POST["FeedbackID"];
    $SessionID = $_POST['SessionID'];
    $ClientID = $_POST["ClientID"];
    $Rating = $_POST["Rating"];
    $Comment = $_POST["Comment"];
    $FeedbackDate = $_POST["FeedbackDate"];

    if (empty($FeedbackID) || empty($SessionID) || empty($ClientID) || empty($Rating) || empty($Comment) || empty($FeedbackDate)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE feedback SET SessionID=?, ClientID=?, Rating=? , Comment=? , FeedbackDate=? WHERE FeedbackID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iissii", $SessionID, $ClientID, $Rating, $Comment, $FeedbackDate, $FeedbackID);
        
        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("Location: viewfeedback.php");
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
        <h3 style="color: green;">UPDATE INFORMATION OF FEEDBACK</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Feedback ID</label><br>
                <input type="text" name="FeedbackID" readonly class="input" value="<?php echo $FeedbackID; ?>"><br>
                <label>User ID</label><br>
                <input type="text" name="SessionID" readonly class="input" value="<?php echo $SessionID; ?>"><br>
                <label>ClientID</label><br>
                <input type="text" name="ClientID" class="input" value="<?php echo $ClientID; ?>"><br>
                <label>Rating</label><br>
                <input type="text" name="Rating" value="<?php echo $Rating; ?>" class="input"><br>
                <label>Comment</label><br>
                <input type="text" name="Comment" value="<?php echo $Comment; ?>" class="input"><br>
                <label>FeedbackDate</label><br>
                <input type="date" name="FeedbackDate" value="<?php echo $FeedbackDate; ?>" class="input"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color: white; text-align: center; margin-top: 40px; background-color: black; height: 40px;"><marquee>&copy; Copy_2024 &reg; Designed By Thimothee</marquee></p>
    </footer>
</body>
</html>
