<?php
	header('Access-Control-Allow-Origin:*');
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <title> Event Registration Page</title>
</head>
<style>
    body
	{
		background-image:url('Images/PESU_Campus.jpg');
		background-position: center;
    		background-repeat: no-repeat;
    		background-size: cover;
    		overflow:hidden;
	}
	#logo
	{
		margin-left:900px;
		margin-top:10px;
		width:350px;
		height:100px;
	}
	.panel-title
    {
    		font-size:16pt;
    }
    .form-group>label
    {
    		font-size:12pt;
    }
</style>
<body>

<div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
	<img class = "col-md-9 col-md-offset-9" src = "Images/PESU_Logo.png" id = "logo">
    <div class="row"><!-- row class is used for grid system in Bootstrap-->
        <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
            <div class="login-panel panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Event Registration Form</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="Event_Reg.php">
                        <fieldset>

                            <div class="form-group">
                                <label for="name">Event Name</label>
                                <input class="form-control" placeholder="Name" name="name" type="text" autofocus>
                            </div>

                            <br>
                            
                            <div class="form-group">
                                <label for="gender">Event Start Date</label>
                                <input class="form-control" placeholder="Event_Start_Date" name="esd" type="date" autofocus>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="email">Event End Date</label>
                                <input class="form-control" placeholder="Event_End_Date" name="eed" type="date" autofocus>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="dob">Event Start Time</label>
                                <input class="form-control" placeholder="Event_Start_Time" name="est" type="time" autofocus>
                            </div>

                            <br>

                            <div class="form-group PhNo">
                                <label for="dob">Event_End_Time</label>
                                <input class="form-control" placeholder="Event_End_Time" name="eet" type="time" autofocus>
                            </div>

                            <br>

                            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Add Event" name="register">

                        </fieldset>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>

</html>

<?php

include("database/db_conection.php");//make connection here
if(isset($_POST['register']))
{
    $name = $_POST['name'];
    $esd = $_POST['esd'];
    $eed = $_POST['eed'];
    $e1 = explode("-",$esd);
    $esd = $e1[2]."-".$e1[1]."-".$e1[0];
    $e1 = explode("-",$eed);
    $eed = $e1[2]."-".$e1[1]."-".$e1[0];
    $est = $_POST['est'];
    $eet = $_POST['eet'];

    $default_query = "INSERT INTO event_calendar (User_ID,Event_Name,Event_Start_Date,Event_End_Date,Event_Start_Time,Event_End_Time) VALUES ('COMMON','$name','$esd','$eed','$est','$eet')";

    $default_result = mysqli_query($dbcon , $default_query);

    if($default_result)
    {
        echo"<script>window.alert('Succesfully Inserted Event!!')</script>";
        echo "<script>window.open('Centralized_Page.php' , '_self')</script>";
    }
    else
    {
        die("Error: " . mysqli_error($dbcon));
    }
}

?>
