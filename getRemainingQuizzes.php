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
	/*
	$dbhost = 'localhost';
   	$dbuser = 'username';
   	$dbpass = 'password';
   	$dbname = 'se';
   	extract($_GET);*/
   	//$link = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   	$link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);
   	if(! $link )
   	{
   	  die('Could not connect: ' . mysql_error());
   	}

//	$link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpass,$dbname);
	//$link = mysqli_connect("localhost", "root", "","se");
	$data = "";
	$query = "SELECT distinct(q1.Quiz_Number) 
				from quiz as q1 
					where q1.Quiz_Number 
					NOT IN (SELECT q2.Quiz_Number 
						from student_quiz_scores as q2 
						where q2.srn='".$srn."') 
				and q1.Course_ID = '".$course_id."'";
	$result = mysqli_query($link, $query);
	$data = "";
	if(mysqli_num_rows($result))
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
		echo "No Quiz for this Subject";
	}
?>
