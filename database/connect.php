<?php
//$servername = "localhost";
//$username = "root";
//$password = FALSE;
//$dbname = "eproj";

$servername = "remotemysql.com";
$username = "BOadPXODJN";
$password = "yUDwIELXFv";
$dbname = "BOadPXODJN";

//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Check connection
if(!$conn){
	die("Connection failed: ".mysqli_connect_error);
}
?>
