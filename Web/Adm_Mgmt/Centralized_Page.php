<?php
	header('Access-Control-Allow-Origin:*');
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <title> Main Page </title>
</head>
<style>
    .login-panel {
        margin-top: 100px;
        border:none;
        background-color:transparent;
    }
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
		width:350px;
		height:100px;
	}
	.btn
	{
		margin-bottom:20px;
	}
	#logo
	{
		margin-left:900px;
		margin-top:10px;
		width:350px;
		height:100px;
	}
</style>

<body>


<div class="container">
	<img class = "col-md-9 col-md-offset-9" src = "Images/PESU_Logo.png" id = "logo">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-primary">
                <div class="panel-body">

                            <div class="form-group">
                                <a href="Event_Reg.php" class="btn btn-lg btn-primary btn-block"> Add New Event </a>
                             </div>

                             <div class="form-group">
                                <a href="Course_Reg.php" class="btn btn-lg btn-primary btn-block"> Add New Course </a>
                            </div>

                            <div class="form-group">
                                <a href="UploadTimeTable.html" class="btn btn-lg btn-primary btn-block"> Upload Time Table </a>
                            </div>

                            <div class="form-group">
                                <a href="Student_Reg.php" class="btn btn-lg btn-primary btn-block"> Student Registration </a>
                             </div>

                            <div class="form-group">
                                <a href="Faculty_Reg.php" class="btn btn-lg btn-primary btn-block"> Faculty Registration </a>
                            </div>

                            <div class="form-group">
                                <a href="UploadResults.html" class="btn btn-lg btn-primary btn-block"> Upload Resuts </a>
                            </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


</body>

</html>
