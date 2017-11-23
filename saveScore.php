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
	/*$dbhost = 'localhost';
   	$dbuser = 'username';
   	$dbpass = 'password';
   	$dbname = 'se';*/
   	//$link = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
   	$link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);
   	if(! $link )
   	{
   	  die('Could not connect: ' . mysql_error());
   	}
   	
	//$link = mysqli_connect("localhost", "root", "","se");
	$score = json_decode($score);
	print_r($score);
	for ($i=0; $i < sizeof($score); $i++) 
	{ 
		$query = "INSERT INTO student_quiz_scores VALUES('".$course_id."','".$srn."',".$quizNum.",".($i+1).",".$score[$i].")";
		$result = mysqli_query($link,$query);
		if (!$result)
		{
			die('Could not save: ' . $query);
		}
	}
?>
