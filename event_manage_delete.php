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
	<title>TARUC Events - Add/Edit Event </title>
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
			width:750px;
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
		td, input[type=text], input[type=number], select{
			font-family: Times New Roman;
			font-size: 22px;
			text-align: center;
			padding-top: 2px ;
			padding-bottom: 2px ;
		}
		textarea{
			font-family: Times New Roman;
			font-size: 18px;
			text-align: center;
			padding-top: 2px ;
			padding-bottom: 2px ;
		}
		input[type=submit], input[type=reset]{
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
		input[type=submit]:hover, input[type=reset]:hover{
			background-color: #20B2AA;
		}
	</style>
</head>
<body background="image\bg.png">

	<button onclick="topFunction()" id="myBtn" title="Go to top"></button>

	
	<hr width="auto" size="10" style="background: #808000">
	<div id="delete">
		<form action="event_manage_delete.php" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Delete Event <<< </th></tr>
				<tr><td>Event: 
				<tr><td>Name: <input type="text" name="delete_event_name" size="35" required></td></tr>
					
				&nbsp;&nbsp;<input type="submit" name="refreshevent" value="Refresh"></td></tr>
				<tr><td><input type="submit" name="deleteevent" value="Delete">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
		</form>
	</div>

	<!--Each button's action-->
	<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		

		if (isset($_POST['deleteevent'])) {
			$selectname=$_POST['delete_event_name'];
			//Read event id
			$read_event_id = "SELECT EventID FROM event_details WHERE EventName='$selectname'";
			$result_read_event_id = mysqli_query($conn, $read_event_id);
			if($result_read_event_id){
				while($row = mysqli_fetch_array($result_read_event_id, MYSQLI_ASSOC)){
					$eid=$row['EventID'];
					//Check if any booking was made
					//If one or more booking found, delete fail
					$check_booking="SELECT EventID FROM booking_details WHERE EventID='$eid'";
					$result_check_booking = mysqli_query($conn, $check_booking);
					if(mysqli_num_rows($result_check_booking)>0){
						$message="Fail to delete event. One or more booking found.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else{
						$delete_event = "DELETE FROM event_details WHERE EventID='$eid'";
						$result_delete_event = mysqli_query($conn, $delete_event);
						if($result_delete_event){
							$message="Delete event success.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
						else{
							$message="Fail to delete event. Please try again.";
							echo "<script type='text/javascript'>alert('$message');</script>";
						}
					}
				}
			}
		}
	?>
</body>
</html>