<?php
//Connect database
	include "database/connect.php";

	//Read session
	include 'session.php';
	$uid=$_SESSION['UserID'];
	if($uid=='' || $uid==null){
		$message="Please login to continue";
		echo "<script type='text/javascript'>alert('$message');</script>";
		header("Refresh: 0, login_register.php");
	}

	//input
		//Manage user
		if (isset($_POST['adduser'])) {
			header('Refresh: 0; user_mangeadd.php');
		}
		
		else if (isset($_POST['deleteuser'])) {
			header('Refresh: 0; user_manage_delete.php');
		}
		else if (isset($_POST['viewuser'])) {
			header('Refresh: 0; user_manage_view.php');
		}
		//Manage Event
		else if (isset($_POST['addevent'])) {
			header('Refresh: 0; event_manageadd.php');
		}
		
		else if (isset($_POST['deleteevent'])) {
			header('Refresh: 0; event_manage_delete.php');
		}
		else if (isset($_POST['viewevent'])) {
			header('Refresh: 0; event_manage_view.php');
		}
		//Manage Venue
		else if (isset($_POST['addvenue'])) {
			header('Refresh: 0; venue_manage_add.php');
		}

		else if (isset($_POST['deletevenue'])) {
			header('Refresh: 0; venue_manage_delete.php');
		}
		else if (isset($_POST['viewvenue'])) {
			header('Refresh: 0; venue_manage_view.php');
		}
?>

<!DOCTYPE html>
<html>
<head>
	<title>Events-Admin </title>
	<style type="text/css">
		a:hover{
			font-size: 24px;
		}
		a{
			color: blue;
		}
		form{
			margin-left: 60px;
			margin-top: 15px;
			margin-right: 60px;
		}
		table{
			text-align: center;
			background-color: white;
			font-size: 28px;
			font-weight: 900;
			width: 850px;
		}
		input[type=submit]{
			padding: 10px;
			color: black;
			border: none;
			background-color: #66CDAA;
			font-weight: 900;
			font-family: Times New Roman;
			font-size: 28px;
			text-align: center;
			width: 150px;
		}
		input[type=submit]:hover{
			background-color: #20B2AA;
		}
		.dropdown{
			display: inline-block;
			position: relative;
		}
		.dropdown-content{
			display: none;
			position: absolute;
			z-index: 1;
			min-width: 250%;
			background: #E0FFFF;
		}
		.dropdown-button{
			display: inline-block;
			min-width: 45%;
			padding: 5px 5px;
			font-family: Times New Roman;
			font-size: 20px;
			background: #E0FFFF;
			border-top: none;
			border-left: none;
			border-right: none;
			border-bottom: 2px #66CDAA solid;
		}
		.dropdown-button:hover{
			background-color: #66CDAA;
		}
	</style>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
	        $(".dropdown").mouseleave(function(){
	        	$(".dropdown-content").hide();
	        });
	    });
		$(document).ready(function(){
	        $(".dropdown").mouseenter(function(){
	        	$(".dropdown-content").show();
	        });
	    });
	</script>
</head>
<body background="image\bg.png">
	<hr width="auto" size="10" style="background: #808000"><br>
	<form action="" method="POST">
		<table align="center" cellspacing="20px">
			<tr>
				<td colspan="5" style="text-decoration: underline;font-size: 30px">Admin Management</td>
			</tr>
		</table>
		<table align="center" cellspacing="20px" style="border-bottom: 2px solid">
			<tr>
				<td width="300px">User:</td>
				<td><input type="submit" name="adduser" value="Add"></td>
				<td><input type="submit" name="deleteuser" value="Delete"></td>
				<td><input type="submit" name="viewuser" value="View"></td>
			</tr>
		</table>
		<table align="center" cellspacing="20px" style="border-bottom: 2px solid">
			<tr>
				<td width="300px">Event:</td>
				<td><input type="submit" name="addevent" value="Add"></td>
				<td><input type="submit" name="deleteevent" value="Delete"></td>
				<td><input type="submit" name="viewevent" value="View"></td>
			</tr>
		</table>
		<table align="center" cellspacing="20px">
			<tr>
				<td width="300px">Venue:</td>
				<td><input type="submit" name="addvenue" value="Add"></td>
				<td><input type="submit" name="deletevenue" value="Delete"></td>
				<td><input type="submit" name="viewvenue" value="View"></td>
			</tr>
		</table>
	</form>
		<br><hr width="auto" size="10" style="background: #808000">
</body>
</html>
