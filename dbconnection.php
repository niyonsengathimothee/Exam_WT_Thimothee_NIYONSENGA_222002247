<?php  
$servername="localhost";
$username="timo";
$password="222002247";
$databasename="virtual art therapy sessions platform";
$connection=new mysqli($servername,$username,$password,$databasename);
if ($connection->connect_error) {
    die("connection failed.".$connection->connect_error);
}
?>