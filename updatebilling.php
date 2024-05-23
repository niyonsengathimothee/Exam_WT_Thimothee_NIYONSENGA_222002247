<?php
include "dbconnection.php";

$BillingID = $SessionID = $Amount = $PaymentStatus = $PaymentDate = "";

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (!isset($_GET["BillingID"])) {
        header("Location: viewbilling.php");
        exit;
    }
    $BillingID = $_GET["BillingID"];

    $sql = "SELECT * FROM billing WHERE BillingID = ?";
    $stmt = $connection->prepare($sql);
    $stmt->bind_param("i", $BillingID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $SessionID = $row['SessionID'];
        $Amount = $row["Amount"];
        $PaymentStatus = $row["PaymentStatus"];
        $PaymentDate = $row["PaymentDate"];
    } else {
        header("Location: viewbilling.php");
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $BillingID = $_POST["BillingID"];
    $SessionID = $_POST['SessionID'];
    $Amount = $_POST["Amount"];
    $PaymentStatus = $_POST["PaymentStatus"];
    $PaymentDate = $_POST["PaymentDate"];

    if (empty($BillingID) || empty($SessionID) || empty($Amount) || empty($PaymentStatus) || empty($PaymentDate)) {
        echo "All fields are required!";
    } else {
        $sql = "UPDATE billing SET SessionID=?, Amount=?, PaymentStatus=? , PaymentDate=? WHERE BillingID=?";
        $stmt = $connection->prepare($sql);
        $stmt->bind_param("iisii", $SessionID, $Amount, $PaymentStatus, $PaymentDate, $BillingID);
        
        if ($stmt->execute()) {
            echo "Information updated successfully";
            header("Location: viewbilling.php");
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
        <h3 style="color: green;">UPDATE INFORMATION OF BILLING</h3>
        <section class="forms">
            <form method="POST" onsubmit="return confirmUpdate();">
                <label>Billing ID</label><br>
                <input type="text" name="BillingID" readonly class="input" value="<?php echo $BillingID; ?>"><br>
                <label>User ID</label><br>
                <input type="text" name="SessionID" readonly class="input" value="<?php echo $SessionID; ?>"><br>
                <label>Amount</label><br>
                <input type="text" name="Amount" class="input" value="<?php echo $Amount; ?>"><br>
                <label>PaymentStatus</label><br>
                <input type="text" name="PaymentStatus" value="<?php echo $PaymentStatus; ?>" class="input"><br>
                <label>PaymentDate</label><br>
                <input type="date" name="PaymentDate" value="<?php echo $PaymentDate; ?>" class="input"><br>
                <input type="submit" name="submit" value="Update" class="sb">
            </form>
        </section>
    </center>
    <footer>
        <p style="color: white; text-align: center; margin-top: 40px; background-color: black; height: 40px;"><marquee>&copy; Copy_2024 &reg; Designed By Thimothee</marquee></p>
    </footer>
</body>
</html>
