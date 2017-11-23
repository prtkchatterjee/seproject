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
	$query = "SELECT q.question, q.option1, q.option2, q.option3, q.option4, q.CorrectOption FROM Quiz q where q.quiz_number = '".$quizNum."' and q.course_id = '".$course_id."' ";
	//$query = "SELECT * from student";
	$result = mysqli_query($link,$query);

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
