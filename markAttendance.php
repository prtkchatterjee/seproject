<?php
	header("Access-Control-Allow-Origin:*");
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
	
	$obj = json_decode($obj,true);
	$course_id = $obj["course_id"];
	$arr = explode(";",$obj["attendance"]);
	$d = date("d/m/Y");
	for($i = 0; $i < sizeof($arr); $i++)
	{
		$tmp = explode(",",$arr[$i]);
		$srn = $tmp[0];
		$status = $tmp[1];
		$query = "INSERT INTO student_course_attendance VALUES('".$srn."','".$course_id."','".$d."',".$status.")";
		$result = mysqli_query($link,$query);
	}
?>
