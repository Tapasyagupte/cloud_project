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

	<div id="add">
		<form action="user_manage.phpadd" method="POST">
			<table align="center" cellspacing="20px">
				<tr><th style="text-decoration: underline;"> >>> Add New User <<< </th></tr>
				<tr><td>User ID: <input type="text" name="a_userid" size="30" required></td></tr>
				<tr><td>Name: <input type="text" name="a_username" size="30" required></td></tr>
				<tr><td>Password: <input type="text" name="a_userpass" size="30" required></td></tr>
				<tr><td>Email: <input type="email" name="a_useremail" size="30" required></td></tr>
				<tr><td>User Type: 
					<select name="a_usertype" style="width: 120px;">
						<option value="">Select</option>
						<option value="Student">Student</option>
						<option value="Admin">Admin</option>
					</select>
				</td></tr>
				<tr><td><input type="submit" name="adduser" value="Add">&nbsp;&nbsp;&nbsp;&nbsp;
						<input type="reset" name="cancel" value="Cancel"></td></tr>
			</table>
		</form>
	</div>
	
	<?php
		$conn = mysqli_connect($servername, $username, $password, $dbname);
		
		//Add user
		if (isset($_POST['adduser'])) {
			$uid = $_POST['a_userid'];
			$upass = $_POST['a_userpass'];
			$uname = $_POST['a_username'];
			$utype = $_POST['a_usertype'];
			$uemail = $_POST['a_useremail'];
			$insert_user = "INSERT INTO user_details (UserID, UserFullName, UserPassword, UserType, UserEmail) VALUES ('$uid', '$uname', '$upass', '$utype', '$uemail')";
			//Ensure no empty field
			if($utype==''){
				$message="User type not selected. Please try again.";
				echo "<script type='text/javascript'>alert('$message');</script>";
			}
			else{
				$result_insert_user = mysqli_query($conn, $insert_user);
				if($result_insert_user){
    				$message="Add user success.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
				else{
					$message="Fail to add new user. Please try again.";
					echo "<script type='text/javascript'>alert('$message');</script>";
				}
			}

		}
	?>
</body>
</html>
		