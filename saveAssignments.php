<?php
	header('Access-Control-Allow-Origin:*');
	extract($_GET);
	foreach ($_SERVER as $key => $value) 
	{
		if (strpos($key, "MYSQLCONNSTR_localdb") !== 0)
		{
			continue;
		}
		$connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
		$connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
		$connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
		$connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
	}
	$link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);
	//$link = mysqli_connect("localhost", "root", "","se");
	$query = "SELECT max(Assignment_No) as res from Assignments where course_id='".$courseid."'";
	//$query = "SELECT * from student";
	$result = mysqli_query($link,$query);
	$acount = 1;
	if(mysqli_num_rows($result)>0)
	{
		
		while($row = mysqli_fetch_assoc($result))
		{
			if($row["res"]=="")
				$acount = 1;
			else
				$acount = $acount + $row["res"];
		}
	}
	$duedate = explode("_",$duedate);
	$duedate = $duedate[0]."/".$duedate[1]."/".$duedate[2];
	$query = "INSERT INTO assignments VALUES('".$courseid."',".$acount.",'".$question."','".$duedate."');";
	//$query = "SELECT * from student";
	$result = mysqli_query($link,$query);
	echo "Assignment Successfully Uploaded";
?>
