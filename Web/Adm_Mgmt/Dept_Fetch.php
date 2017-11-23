<?php

	//$con = mysqli_connect("localhost" , "root" , "" , "se");
	header('Access-Control-Allow-Origin:*'); //To enable Cross Origin Resource Sharing (CORS)
	extract($_GET); //Makes all parameters sent as part of the GET request as PHP variables
	foreach ($_SERVER as $key => $value) //Iterating through the server variables stored in $_SERVER
	{
		if (strpos($key, "MYSQLCONNSTR_localdb") !== 0) //Searching for server variable - MYSQLCONNSTR_localdb
		{
			continue;
		}
		//Using the Server Variable MYSQLCONNSTR_localdb to extract Host Name, Database Name, Username and Password for the DB to be accessed
		$connectstr_dbhost = preg_replace("/^.*Data Source=(.+?);.*$/", "\\1", $value);
		$connectstr_dbname = preg_replace("/^.*Database=(.+?);.*$/", "\\1", $value);
		$connectstr_dbusername = preg_replace("/^.*User Id=(.+?);.*$/", "\\1", $value);
		$connectstr_dbpassword = preg_replace("/^.*Password=(.+?)$/", "\\1", $value);
	}
	//Establishing a connection or link to the database
	$con = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);
	if(!$con)
	{
		die("DB Connection Error !! " . mysqli_error($con));
	}

	mysqli_select_db($con , " project_final");

	$arr = array();

	$department = "SELECT * FROM department";

	$result_dept = mysqli_query($con , $department);

	if($result_dept)
	{
		if(mysqli_num_rows($result_dept) == 0)
		{
			die("No Colomns Present : " . mysqli_error());
		}
		else
		{
			while($row = mysqli_fetch_row($result_dept))
			{
				$arr[$row[0]] = $row[1];
			}

			echo json_encode($arr);
		}
	}
	else
	{
		die("Query Error : " . mysqli_error($con));
	}

?>
