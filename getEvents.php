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
	$query = "SELECT * from event_calendar where user_id = 'COMMON' OR user_id='$userid'";
	$result = mysqli_query($link,$query);
	$data = "";
	
	if(mysqli_num_rows($result)>0)
	{
		
		while($row = mysqli_fetch_assoc($result))
		{
			//print_r($row);
			$data = $data.json_encode($row).";";
		}
		mysqli_close($link);
		//print_r($data);
		echo substr($data,0,strlen($data)-1);
		//echo json_encode($data);
	}
	else
	{
		echo "No Events";
	}
?>
