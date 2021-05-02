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
	<title>Events - Add/Delete User </title>
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

	
		
	<hr width="auto" size="10" style="background: #808000">
	<div id="delete">
		<form action="user_manage_delete.php" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Delete User <<< </th></tr>
				<tr><td>User ID: 
					<select name="delete_user_id" style="width: 140px;">
					<tr><td>User ID: <input type="text" name="a_userid" size="30" required></td></tr>
				</td></tr>
				<tr><td><input type="submit" name="deleteuser" value="Delete">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
	
		</form>
	</div>

	<!--Each button's action-->
	<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		
		//Delete user
		if (isset($_POST['deleteuser'])) {
			$selectid=$_POST['delete_user_id'];
			if($selectid==''){
				$message="User ID not selected. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				//Check 'event_details' table. If user organized event, cannot delete
				$check_event="SELECT UserID FROM event_details WHERE UserID='$selectid'";
				$result_check_event = mysqli_query($conn, $check_event);
				if(mysqli_num_rows($result_check_event)>0){
					$message="Cannot delete user. The user is the organizer of certain event.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
				//If user made booking for one or more event, cannot delete user
				else{
					$check_booking="SELECT UserID FROM booking_details WHERE UserID='$selectid'";
					$result_check_booking = mysqli_query($conn, $check_booking);
					if(mysqli_num_rows($result_check_booking)>0){
						$message="Selected user has made booking for some event. Cannot delete user.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else{
						$delete_user_booking = "DELETE FROM booking_details WHERE UserID='$selectid'";
						$result_delete_user_booking = mysqli_query($conn, $delete_user_booking);
						if($result_delete_user_booking){
							$delete_user = "DELETE FROM user_details WHERE UserID='$selectid'";
							$result_delete_user = mysqli_query($conn, $delete_user);
							if($result_delete_user){
								$message="Delete user success.";
								echo "<script type='text/javascript'>alert('$message');</script>";
							}
							else{
								$message="Fail to delete user. Please try again.";
								echo "<script type='text/javascript'>alert('$message');</script>";
							}
						}
					}
				}
			}
		}
	?>
</body>
</html>
