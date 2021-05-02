<?php
//$servername = "localhost";
//$username = "root";
//$password = FALSE;
//$dbname = "eproj";

//$servername = "remotemysql.com";
//$username = "BOadPXODJN";
//$password = "yUDwIELXFv";
//$dbname = "BOadPXODJN";

$servername = "remotemysql.com";
$username = "P1Z1pVnyDJ";
$password = "Y7yrat7lHe";
$dbname = "P1Z1pVnyDJ";

//Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

//Check connection
if(!$conn){
	die("Connection failed: ".mysqli_connect_error);
}
?>
