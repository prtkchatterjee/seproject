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
	#print_r($obj);
	$course_id = $course;
	$query = "SELECT MAX(quiz_number) as res FROM quiz WHERE course_id = '".$course_id."'";
	$result = mysqli_query($link, $query);
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
	$qno = $acount;
	$i = 1;
	foreach ($obj as $key => $value) {
		$tmpobj = $value;
		$query = "INSERT INTO quiz VALUES('".$course_id."',".$qno.",'".$tmpobj["question"]."',".$i.",'".$tmpobj["option1"]."','".$tmpobj["option2"]."','".$tmpobj["option3"]."','".$tmpobj["option4"]."','".$tmpobj["correctOption"]."')";	
		$i += 1;
		$result = mysqli_query($link,$query);
	}
	echo "Success";
?>
