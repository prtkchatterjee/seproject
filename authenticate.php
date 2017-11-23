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
	$query = "SELECT User_Type from Login where User_ID='".trim($userid)."' and Password='".trim($password)."'";
	//$query = "SELECT * from student";
	$result = mysqli_query($link,$query);
	if(mysqli_num_rows($result)>0)
	{
		
		while($row = mysqli_fetch_assoc($result))
		{
			echo $row["User_Type"];
		}
		mysqli_close($link);
		//print_r($data);
		//echo json_encode($data);
	}
	else
		echo "I";
?>
