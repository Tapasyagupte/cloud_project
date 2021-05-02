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

	<div id="add">
		<form action="event_manage_add.php" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Add New Event <<< </th></tr>
				<tr><td>Name: <input type="text" name="a_eventname" size="35" required></td></tr>
				<tr><td>Date: <input type="text" name="edate" size="35" required></td></tr>
				<tr><td>Time: <input type="text" name="etime" size="35" required></td></tr>

				<tr><td>Event Category: <br><textarea name="a_eventcategory" rows="2" cols="50" placeholder="eg: Concert, Sports, Talk, Festival etc..." required></textarea></td></tr>
				<tr><td>Event Description: <br><textarea name="a_eventdescription" rows="5" cols="50" required style="text-align: justify"></textarea></td></tr>
				<tr><td>Venue: <input type="text" name="a_eventvenue" size="30" required></td></tr>
				</td></tr>
				<tr><td>Ticket Price: RM <input type="number" name="a_eventticketprice" min="00" placeholder="0" required>.00 </td></tr>
				<tr><td>Number of Ticket: <input type="number" name="a_eventtickettotal" min="10" placeholder="10" required></td></tr>
				<tr><td colspan="2"><input type="submit" name="addevent" value="Add">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	
	<!--Each button's action-->
	<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		if (isset($_POST['addevent'])) {
			$ename=$_POST['a_eventname'];
			$edate=$_POST['edate'];
			$etime=$_POST['etime'];
			$edescription=$_POST['a_eventdescription'];
			$ecategory=$_POST['a_eventcategory'];
			$evenue=$_POST['a_eventvenue'];
			$eprice=$_POST['a_eventticketprice'];
			$etotal=$_POST['a_eventtickettotal'];

			//Add '0' to month
			if(($emonth>0) && ($emonth<10)){
				$emonth='0'.$emonth;
			}
			//Add '0' to day
			if(($eday>0) && ($eday<10)){
				$eday='0'.$eday;
			}
			//Add '0' to hour
			if(($ehour>-1) && ($ehour<10)){
				$ehour='0'.$ehour;
			}
			//Add '0' to minute
			if(($eminute>-1) && ($eminute<10)){
				$eminute='0'.$eminute;
			}

			$edate=$eyear.'-'.$emonth.'-'.$eday;
			$etime=$ehour.':'.$eminute.':00';

			//Read venue id
			$read_venue_id="SELECT VenueID FROM venue_details WHERE VenueName='$evenue'";
			$result_read_venue_id = mysqli_query($conn, $read_venue_id);
			if($result_read_venue_id){
				while($row = mysqli_fetch_array($result_read_venue_id, MYSQLI_ASSOC)){
					$vid=$row['VenueID'];
					//Insert event
					$insert_event = "INSERT INTO event_details (EventName, EventDate, EventTime, EventCategory, EventDescription, EventTicketPrice, EventTicketTotal, VenueID, UserID) VALUES ('$ename', '$edate', '$etime', '$ecategory', '$edescription', $eprice, $etotal, '$vid', '$uid')";
					$result_insert_event = mysqli_query($conn, $insert_event);
					if($result_insert_event){
    					$message="Add new event success.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else{
						$message="Fail to add new event. Please try again.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
			}
		}

		
	?>
</body>
</html>
