<?php

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
	$query = "SELECT * from Student";
	$result = mysqli_query($link,$query);
	$data = array();
	
	if(mysqli_num_rows($result)>0)
	{
		
		while($row = mysqli_fetch_assoc($result))
		{
			//print_r($row);
			$data[] = $row;	
		}
		mysqli_close($link);
		//print_r($data);
		print_r($data);
	}
	else
	{
		echo "Failed!!!";
	}
?>
	
