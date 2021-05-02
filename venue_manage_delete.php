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

	
	<hr width="auto" size="10" style="background: #808000">
	<div id="delete">
		<form action="venue_manage_delete.php" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Delete Venue <<< </th></tr>
				 
				<tr><td>Venu: <input type="text" name="delete_venue_name" size="35" required></td></tr>

				&nbsp;&nbsp;<input type="submit" name="refreshvenue" value="Refresh"></td></tr>
				<tr><td><input type="submit" name="deletevenue" value="Delete">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="submit" name="cancel" value="Cancel"></td></tr>
		</form>
	</div>

	<!--Each buttons' action-->
	<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		
		//Delete venue
		if (isset($_POST['deletevenue'])) {
			$selectname=$_POST['delete_venue_name'];
			$read_venue_id="SELECT VenueID FROM venue_details WHERE VenueName='$selectname'";
			$result_read_venue_id = mysqli_query($conn, $read_venue_id);
			if($result_read_venue_id){
				while($row = mysqli_fetch_array($result_read_venue_id, MYSQLI_ASSOC)){
					$vid=$row['VenueID'];
				}
			}

			//Check if any event is using the venue
			//If one or more event is using the venue, delete fail
			$check_venue="SELECT VenueID FROM event_details WHERE VenueID='$vid'";
			$result_check_venue = mysqli_query($conn, $check_venue);
			if(mysqli_num_rows($result_check_venue)>0){
				$message="Fail to delete venue. The venue is in use. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				$delete_venue = "DELETE FROM venue_details WHERE VenueID='$vid'";
				$result_delete_venue = mysqli_query($conn, $delete_venue);
				if($result_delete_venue){
					$message="Delete venue success.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
				else{
					$message="Fail to delete venue. Please try again.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}
		}
	?>
</body>
</html>