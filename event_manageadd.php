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
	<title>Events - Add/Delete  </title>
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
		td, input[type=text], input[type=email], select{
			font-family: Times New Roman;
			font-size: 22px;
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

	<div id="add">
		<form action="event_manageadd.php" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Add New Event <<< </th></tr>
				<tr><td>Event Name: <input type="text" name="event_name" size="30" required></td></tr>
				<tr><td>Event Date: <input type="text" name="event_date" size="30" required></td></tr>
				<tr><td>Event Time: <input type="text" name="event_time" size="30" required></td></tr>
				<tr><td>Event Category: <input type="text" name="event_category" size="30" required></td></tr>
				<tr><td>Event Description: <input type="text" name="event_description" size="30" required></td></tr>
				<tr><td>Event Ticket Price: <input type="text" name="event_ticket_price" size="30" required></td></tr>
				<tr><td>Event Ticket Total: <input type="text" name="event_ticket_total" size="30" required></td></tr>

				<tr><td><input type="submit" name="adduser" value="Add">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	
	<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		//Add user
		if (isset($_POST['adduser'])) {
			$ename = $_POST['event_name'];
			$edate = $_POST['event_date'];
			$etime = $_POST['event_time'];
			$ecat = $_POST['event_category'];
			$edes = $_POST['event_description'];
			$etic = $_POST['event_ticket_price'];
			$ettot = $_POST['event_ticket_total'];
			$insert_user = "INSERT INTO event_details (EventName, EventDate, EventTime, EventCategory, EventDescription, EventTicketPrice, EventTicketTotal) VALUES ('$ename', '$edate', '$etime', '$ecat', '$edes', '$etic', '$ettot')";
			//Ensure no empty field
			if($ename==''){
				$message="Event name not selected. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				$result_insert_user = mysqli_query($conn, $insert_user);
				if($result_insert_user){
    				$message="Add event success.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
				else{
					$message="Fail to add new event. Please try again.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}

		}
	?>
</body>
</html>
		
