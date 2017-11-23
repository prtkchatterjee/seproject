<?php
/**
 * Created by PhpStorm.
 * User: Ehtesham Mehmood
 * Date: 11/21/2014
 * Time: 1:13 AM
 */

//$dbcon=mysqli_connect("localhost","root","" , "se"); //On my machine , this was the DB Name ...

//mysqli_select_db($dbcon,"se");

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
$dbcon = mysqli_connect($connectstr_dbhost, $connectstr_dbusername, $connectstr_dbpassword,$connectstr_dbname);
mysqli_select_db($dbcon,$connectstr_dbname);
?>
