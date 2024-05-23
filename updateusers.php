<?php 
include "dbconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["UserID"])) {
        header("location: viewusers.php");
        exit;
    }

    $UserID = $_GET["UserID"];

    $sql = "SELECT * FROM users WHERE UserID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $UserID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $UserID = $row["UserID"];
        $Username  = $row["Username "];
        $Password = $row["Password"];
    } else {
        header("location:viewinstructors.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UserID = $_POST["UserID"];
    $Username  = $_POST["Username "];
    $Password = $_POST["Password"];

    if (empty($UserID) || empty($Username ) || empty($Password)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE instructors SET Username  = ?, Password = ? WHERE UserID = ?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("ssi", $Username , $Password, $UserID);

        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("location:viewusers.php");
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
    <title>Virtual Internet of Things Workshops Platform</title>
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
        <h2>Virtual Internet of Things Workshops Platform</h2>
        <h3 style="color:green;">UPDATE INSTRUCTORS HERE</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>UserID</label><br>
                <input type="text" name="UserID" readonly class="input" value="<?php echo $UserID; ?>"><br>
                <label>Username </label><br>
                <input type="text" name="Username " class="input" value="<?php echo $Username ; ?>"><br> 
                <label>Password</label><br>
                <input type="text" name="Password" class="input" value="<?php echo $Password; ?>"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color:blue; text-align: center; margin-top:40px;"><marquee> &copy; copy right&reg; Thimothee_CBE_BIT_Year2_Group_2.</marquee> </p>
    </footer>
</body>
</html>
