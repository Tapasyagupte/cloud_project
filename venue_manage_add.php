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

	//Read button script
	include "top_button.html";
?>

<!DOCTYPE html>
<html>
<head>
	<title>Events - Venue Manage</title>
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
			max-width:750px;
			margin-top:50px;
			margin-bottom:50px;
			margin-left:auto;
			margin-right:auto;
			background-color: white;
		}
		th{
			font-size: 28px;
			text-align: center;
			padding-top: 20px ;
			padding-bottom: 20px ;
			width: 50%;
		}
		td, input[type=text], select{
			font-family: Times New Roman;
			font-size: 22px;
			text-align: center;
			padding-top: 2px ;
			padding-bottom: 2px ;
		}
		input[type=submit]{
			padding: 10px;
			color: black;
			border: none;
			background-color: #66CDAA;
			font-weight: 900;
			font-family: Times New Roman;
			font-size: 20px;
			text-align: center;
			width: 120px;
		}
		input[type=submit]:hover{
			background-color: #20B2AA;
		}
	</style>
</head>
<body background="image\bg.png">

	<button onclick="topFunction()" id="myBtn" title="Go to top"></button>
	<hr width="auto" size="10" style="background: #808000">

	<div id="add">
		<form action="venue_manage_add.php" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Add New Venue <<< </th></tr>
				<tr><td>Name: <input type="text" name="a_venuename" size="30" required></td></tr>
				<tr><td>Information: <input type="text" name="a_venueinfo" size="30" placeholder="eg: Canteen/ For sports..." required></td></tr>
				<tr><td><input type="submit" name="addvenue" value="Add">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	

	<!--Each buttons' action-->
	<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		//Add venue
		if (isset($_POST['addvenue'])) {
			$vname=$_POST['a_venuename'];
			$vinfo=$_POST['a_venueinfo'];
			$insert_venue = "INSERT INTO venue_details (VenueName, VenueInfo) VALUES ('$vname', '$vinfo')";
			$result_insert_venue = mysqli_query($conn, $insert_venue);
			if($result_insert_venue){
    			$message="Add new venue success.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				$message="Fail to add new venue. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
		}
		
	?>
</body>
</html>