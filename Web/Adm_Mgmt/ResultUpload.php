<?php
	header('Access-Control-Allow-Origin:*');
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
	$target_file = "ResultUpload.csv";
	move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file);
	$file = fopen("ResultUpload.csv", "r") or die("Unable to open file!");
	$contents = trim(fread($file,filesize("ResultUpload.csv")));
	unlink("ResultUpload.csv");
	$sp = explode("\n",$contents);
	for($i=0;$i<sizeof($sp);$i++)
	{
		$sp1 = explode(",",$sp[$i]);
		$query = "INSERT INTO Results VALUES('".$sp1[0]."','".$sp1[1]."','".$sp1[2]."')";
		$result = mysqli_query($link,$query);
	}
	echo "<script>alert('File Uploaded Successfully')</script>";
	echo "<script>window.open('Centralized_Page.php' , '_self')</script>";
?>
