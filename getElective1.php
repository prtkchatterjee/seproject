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
	//$link = mysqli_connect('localhost', 'root', '','se');
	$query = "SELECT c.course_id as course_id, c.course_code as course_code,c.name as course_name,c.course_type as course_type,f.name as faculty_name from student s, course c, faculty f where s.srn='$srn' and s.semester = c.semester and s.department_id = c.department_id and c.faculty_id = f.faculty_id and c.course_type='E1' order by c.course_code ASC";
	$result = mysqli_query($link,$query);
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
		echo "No courses available for specified SRN!";
	}
?>
