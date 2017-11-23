<?php
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
	$link = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);
	$query = "SELECT r.srn,r.course_code,r.grade,upper(c.name) as course_name,upper(f.name) as faculty_name from Results r, course c, faculty f,student_course_registration s where r.course_code = c.course_code and c.faculty_id = f.faculty_id and s.srn = r.srn and c.course_id = s.course_id and r.srn='".$srn."'"; //Query to fetch results for the given user (by SRN)
	$result = mysqli_query($link,$query); //Running query on the DB server
	$data = ""; //Variable to hold data fetched from the database
	if(mysqli_num_rows($result)>0) //Iterating through all rows fetched from the DB
	{
		while($row = mysqli_fetch_assoc($result)) //Converting each row of the query results into an associative array
		{
			$data = $data.json_encode($row).";"; //Encoding each row of the associative array as a JSON object and appending it to $data separated by a ;
		}
		mysqli_close($link); //Closing the connection to the DB
		echo substr($data,0,strlen($data)-1); //Response to the calling Javascript Method
	}
	else //In case of a failed query - Graceful Degradation
	{
		echo "No records available for specified SRN!";
	}
?>
