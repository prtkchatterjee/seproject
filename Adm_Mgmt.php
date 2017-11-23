<!DOCTYPE html>
<head>
	<style>
			body
			{
				color:#000dc5;
				background-color:#fdfdfd;
			}
			h1
			{
				margin-left:80px;
			}
			input[type=submit]
			{
				margin-right:50px;
			}
			input[type=submit] {
			  background: #fafafa;
			  background-image: -webkit-linear-gradient(top, #fafafa, #b8b8b8);
			  background-image: -moz-linear-gradient(top, #fafafa, #b8b8b8);
			  background-image: -ms-linear-gradient(top, #fafafa, #b8b8b8);
			  background-image: -o-linear-gradient(top, #fafafa, #b8b8b8);
			  background-image: linear-gradient(to bottom, #fafafa, #b8b8b8);
			  -webkit-border-radius: 28;
			  -moz-border-radius: 28;
			  border-radius: 28px;
			  font-family: Arial;
			  color: #000dc5;
			  font-size: 20px;
			  padding: 10px 20px 10px 20px;
			  border: solid #000000 2px;
			  text-decoration: none;
			}

			input[type=submit]:hover {
			  background: #b8b8b8;
			  background-image: -webkit-linear-gradient(top, #b8b8b8, #fafafa);
			  background-image: -moz-linear-gradient(top, #b8b8b8, #fafafa);
			  background-image: -ms-linear-gradient(top, #b8b8b8, #fafafa);
			  background-image: -o-linear-gradient(top, #b8b8b8, #fafafa);
			  background-image: linear-gradient(to bottom, #b8b8b8, #fafafa);
			  text-decoration: none;
			}
		</style>
	</head>
<body>

<form method="POST">
<div>
<center>
	<h1> Registeration Form </h1>
	<table>
	<tr><td><label for="fname">First Name</label>
		<td><input type="text" name="fname" required>
	<tr><br>
	<tr><td><label for="mname">Middle Name</label>
		<td><input type="text" name="mname">
	<tr><br>
	<tr><td><label for="lname">Last Name</label>
		<td><input type="text" name="lname" required>
	<br>
	<tr><td><label for="dob">Date of Birth</label>
		<td><input type="text" name="dob" placeholder="dd-mm-yyyy" required>
	<br>
	<tr><td><label for="email">Email - ID</label>
		<td><input type="email" name="email" required>
	<br>
	<tr><td><label for="mob">Mobile Number</label>
		<td><input type="text" name="mob" required>
	<br>
	<tr><td><label for="Fname">Father's Name</label>
		<td><input type="text" name="Fname">
	<br>
	<tr><td><label for="Fno">Father's Mobile</label>
		<td><input type="text" name="Fno">
	<br>
	<tr><td><label for="Femail">Father's Mail</label>
		<td><input type="text" name="Femail">
	<br>
	<tr><td><label for="Mname">Mother's Name</label>
		<td><input type="text" name="Mname">
	<br>
	<tr><td><label for="Mno">Mother's Mobile</label>
		<td><input type="text" name="Mno">
	<br>
	<tr><td><label for="Memail">Mother's Mail</label>
		<td><input type="text" name="Memail">
	<br>
	<tr><td><label for="pu">Pre - University</label>
		<td><input type="text" name="pu" required>
	<br>
	<tr><td><label for="pumarks">Aggregate Marks in PU</label>
		<td><input type="text" name="pumarks">
	<br>
	<tr><td><label for="school">School Name</label>
		<td><input type="text" name="school" required>
	<br>
	<tr><td><label for="smarks"> Aggregate Marks in School</label>
		<td><input type="text" name="smarks">
	<br>
	<tr><td><label for="Submit"></label>
		<td><input type="submit" name="Submit" value="Register">
	</table>
</center>
</div>
</div>
</form>
</body>
</html>

<?php

$fname = " ";
$lname = " ";
$dob = " ";
$email = " ";
$mob = " ";
$pu = " ";
$pumarks = " ";
$school = " ";
$smarks = " ";

$con =  mysqli_connect("localhost" , "root" , "");
if(!$con)
{
	die("Conncection Unsuccessull : " . mysqli_connect_error());
}

mysqli_select_db($con , "SE");

if(isset($_POST['Submit']))
{
	if(isset($_POST['fname']))
	{
		$user = $_POST['fname'];
	}	
	if(isset($_POST['lname']))
	{
		$pass = $_POST['lname'];
	}
	if(isset($_POST['dob']))
	{
		$d = $_POST['dob'];
	}
	if(isset($_POST['email']))
	{
		$eid = $_POST['email'];
	}
	if(isset($_POST['mob']))
	{
		$m = $_POST['mob'];
	}
	if(isset($_POST['pu']))
	{
		$puc = $_POST['pu'];
	}
	if(isset($_POST['pumarks']))
	{
		$pum = $_POST['pumarks'];
	}
	if(isset($_POST['school']))
	{
		$sch = $_POST['school'];
	}
	if(isset($_POST['smarks']))
	{
		$sm = $_POST['smarks'];
	}
	$sql = "INSERT INTO details(firstname , lastname , dob , email , mob , pu , pumarks , school , schoolmarks) VALUES('$user','$pass','$d','$eid','$m','$puc','$pum','$sch','$sm')";

	if(mysqli_query($con , $sql) > 0)
	{
		echo"<script>window.alert('Successfully Registered!!')</script>";
	}
	else
	{
		echo"<script>window.alert('Unable to Register Now!')</script>";
	}
}
mysqli_close($con);
?>