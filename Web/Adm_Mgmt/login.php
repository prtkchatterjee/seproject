<?php
	header('Access-Control-Allow-Origin:*');
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <title>Login</title>
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
    .login-panel {
        margin-top: 35%;
    }
    .panel-title
    {
    		font-size:16pt;
    }
    input[type=submit]
    {
    		font-size:14pt;
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
	<img src = "Images/PESU_Logo.png" id = "logo">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center">Sign In</h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="login.php">
                        <fieldset>
                            <div class="form-group">
                                <label for="name">Registration Number</label>
                                <input class="form-control" placeholder="Registration Number" name="regno" type="text" autofocus>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="name">Password</label>
                                <input class="form-control" placeholder="Password" name="pass" type="password" value="">
                            </div>


                                <input class="btn btn-lg btn-primary btn-block" type="submit" value="Login" name="login" >

                            <!-- Change this to a button or input when using this as a form -->
                          <!--  <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->
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

include("database/db_conection.php");

if(isset($_POST['login']))
{
    $reg_number=$_POST['regno'];
    $user_pass=$_POST['pass'];

    $check_user="SELECT * FROM admin WHERE User_ID = '$reg_number' AND Password = '$user_pass'";

    $run=mysqli_query($dbcon,$check_user);

    if($run)
    {
        if(mysqli_num_rows($run) <= 0)
        {
            echo "<script>alert('Invalid Credentials!')</script>";
        }
        else
        {
            echo "<script>window.open('Centralized_Page.php' , '_self')</script>";
        }
    }
    else
    {
        die("Error : " . mysqli_error($dbcon));
        //$_SESSION['email']=$user_email;//here session is used and value of $user_email store in $_SESSION.
    }
}
?>
