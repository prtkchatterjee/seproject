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
	
	
	/*$dbhost = 'localhost';
   	$dbuser = 'root';
   	$dbpass = '';
   	$dbname = 'se';
   	extract($_GET);
   	$link = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);*/
   	if(! $link )
   	{
   	  die('Could not connect: ' . mysql_error());
   	}

   	$query = "SELECT COUNT(*) as count
   				from student_course_attendance 
   				where srn='".$srn."'AND Course_id='".$course_id."'" ;

   	$result = mysqli_query($link,$query);
	$data = "";
	
	if(mysqli_num_rows($result)>0)
	{
		
		while($row = mysqli_fetch_assoc($result))
		{
			//print_r($row);
			$data = $data.json_encode($row).";";
		}
		//print_r($data);
		//echo substr($data,0,strlen($data)-1);
		//echo json_encode($data);
	}
	else
	{
		die('' . $query);
	}
	$query = "SELECT COUNT(*) as count
   				from student_course_attendance 
   				where srn='".$srn."'AND Course_id='".$course_id."' AND status=1" ;

   	$result = mysqli_query($link,$query);
	
	if(mysqli_num_rows($result)>0)
	{
		
		while($row = mysqli_fetch_assoc($result))
		{
			//print_r($row);
			$data = $data.json_encode($row).";";
		}
		//print_r($data);
		//echo substr($data,0,strlen($data)-1);
		//echo json_encode($data);
	}
	else
	{
		die('' . $query);
	}
	$data = $data."?";
	$query = "SELECT quiz_number, COUNT(*) as count, SUM(score) as sum
   				from student_quiz_scores 
   				where srn='".$srn."'AND course_id='".$course_id."'
   				group by quiz_number" ;

   	$result = mysqli_query($link,$query);
	
	
	if($result)
	{
		
		while($row = mysqli_fetch_assoc($result))
		{
			//print_r($row);
			$data = $data.json_encode($row).";";
		}
		mysqli_close($link);
		//print_r($data);
		//echo substr($data,0,strlen($data)-1);
		//echo json_encode($data);
	}
	else
	{
		die('' . $query);
	}

	echo substr($data,0,strlen($data)-1);
?>
