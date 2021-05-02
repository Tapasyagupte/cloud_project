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
	<title>Events - Add/Edit/Delete User </title>
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
	<div id="edit">
		<form action="user_manage_edite.php" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Edit User <<< </th></tr>
				<tr><td>User ID: 
					<select name="edit_user_id" style="width: 140px;">
						<option value="">Select</option>
						<?php
							$conn = mysqli_connect($servername, $username, $password, $dbname);
							$read_user = "SELECT * FROM user_details";
							$result_read_user = mysqli_query($conn, $read_user);
							if(mysqli_num_rows($result_read_user)>0){
								while($row = mysqli_fetch_array($result_read_user, MYSQLI_ASSOC)){
									echo "<option value='".$row[UserID]."'>".$row[UserID]."</option>";
								}
							}
						?>
					</select>
				&nbsp;&nbsp;<input type="submit" name="refreshuser" value="Refresh"></td></tr>
				<tr><td><img src="image/divide.jpg" height="40%" width="100%" style="opacity: 0.6"></td></tr>
				<tr><td>New User Name: <input type="text" name="e_username" size="30"></td></tr>
				<tr><td>New User Email: <input type="text" name="e_useremail" size="30"></td></tr>
				<tr><td><input type="submit" name="edituser" value="Save">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	
	<!--Each button's action-->
	<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		//Add user
		
		//Edit user
		if (isset($_POST['edituser'])) {
			$selectid=$_POST['edit_user_id'];
			$uname=$_POST['e_username'];
			$uemail=$_POST['e_useremail'];
			
			if($selectid==''){
				$message="User ID not selected. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				//Update both name and email
				if(($uname!='') && ($uemail!='')){
					$update_user = "UPDATE user_details SET UserFullName='$uname', UserEmail='$uemail' WHERE UserID='$selectid'";
					$result_update_user = mysqli_query($conn, $update_user);
					if($result_update_user){
						$message="Update user(ID: ".$selectid.") name and email success.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else{
						$message="Fail to update user name and email. Please try again.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
				//Update name only
				elseif(($uname!='') && ($uemail=='')){
					$update_name = "UPDATE user_details SET UserFullName='$uname' WHERE UserID='$selectid'";
					$result_update_name = mysqli_query($conn, $update_name);
					if($result_update_name){
						$message="Update user(ID: ".$selectid.") name success.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else{
						$message="Fail to update user name. Please try again.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
				//Update email only
				elseif (($uname=='') && ($uemail!='')) {
					$update_email = "UPDATE user_details SET UserEmail='$uemail' WHERE UserID='$selectid'";
					$result_update_email = mysqli_query($conn, $update_email);
					if($result_update_email){
						$message="Update user(ID: ".$selectid.") email success.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
					else{
						$message="Fail to update email. Please try again.";
						echo "<script type='text/javascript'>alert('$message');</script>";
					}
				}
			}
		}
		
	?>
</body>
</html>