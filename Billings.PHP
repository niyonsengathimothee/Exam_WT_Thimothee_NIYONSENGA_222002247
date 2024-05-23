<?php
include 'dbconnection.php';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $SessionID=$_POST['SessionID'];
    $Amount=$_POST['Amount'];
    $PaymentStatus=$_POST['PaymentStatus'];
    $PaymentDate=$_POST['PaymentDate'];
    $sql="INSERT INTO billing (SessionID,Amount,PaymentStatus,PaymentDate) VALUES('$SessionID','$Amount','$PaymentStatus','$PaymentDate')";
   $result=$connection->query($sql);
    if ($result) {
        echo"Inserted Successfully";
        exit();
    }else{
        echo "Inserted fail";
    }

}

?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Billings</title>
</head>
<body>
		<h1>Billings Form</h1>
<form method="post" action="Billings.php">
<label for="SessionID">SessionID:</label>
<input type="text" id="SessionID" name="SessionID" required><br><br>

<label for="Amount">Amount:</label>
<input type="text" id="Amount" name="Amount" required><br><br>

<label for="PaymentStatus">PaymentStatus:</label>
<input type="Text" id="PaymentStatus" name="PaymentStatus" required><br><br>

<label for="PaymentDate">PaymentDate:</label>
<input type="Date" id="PaymentDate" name="PaymentDate" required><br><br>


<input type="submit" name="add" value="Insert"><br><br>

<a href="./home.html">Go Back to Home</a>

</form>
</body>
</html>