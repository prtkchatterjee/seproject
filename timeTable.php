<?php
	header("Content-Type: application/json; charset=UTF-8");
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
	 global $json,$i;
	 $json =array();
	// Check connection
	if($link === false){
	    die("ERROR: Could not connect. " . mysqli_connect_error());
	}
	$sql = "SELECT `course`.`Course_ID`,`course`.`name`, `course_schedule`.`Room_No`,`course_schedule`.`Day_Of_Week` ,`course_schedule`.`Start_Time`,`course_schedule`.`End_Time` 
		FROM `course`, `course_schedule`, student_course_registration
		WHERE `course`.`Course_ID`=`course_schedule`.`course_ID` and course.course_id = student_course_registration.course_id and student_course_registration.srn = '$userid'
		ORDER BY `Day_Of_Week` ";


	 ;
	$result = $link->query($sql);

	$outp = $result->fetch_all(MYSQLI_ASSOC);
	 // echo $outp;
	echo json_encode($outp);
	

	 
?>
