<?php
	header('Access-Control-Allow-Origin:*');
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <title> Student Registration Page</title>
</head>
<style>
    body
	{
		background-image:url('Images/PESU_Campus.jpg');
		background-position: center;
    		background-repeat: no-repeat;
    		background-size: cover;
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
            <div class="login-panel panel panel-primary" style="background-color:taupe">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"> Student Registration Form </h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="Student_Reg.php">
                        <fieldset>

                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" placeholder="Name" name="name" type="text" autofocus>
                            </div>

                            <br>
                            
                            <div class="form-group">
                                <label for="gender">Gender</label>
                                <input class="form-control" placeholder="Gender" name="gender" type="text" autofocus>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input class="form-control" placeholder="Email" name="email" type="text" autofocus>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="dob">Date of Birth</label>
                                <input class="form-control" placeholder="mm/dd/yyyy" name="dob" type="date" autofocus>
                            </div>

                            <br>

                            <div class="form-group PhNo">
                                <label for="dob">Phone Number</label>
                                <input class="form-control" placeholder="Phone Number " name="phno" type="text" autofocus>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="address">Address</label>
                                <input class="form-control" placeholder="Address" name="address" type="text" autofocus>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <input class="form-control" placeholder="Semester" name="sem" type="text" autofocus>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="sec">Section</label>
                                <input class="form-control" placeholder="Section" name="sec" type="text" autofocus>
                            </div>

                            <br>
                            
                            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Register Student" name="register">

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
    $name = $_POST['name'];//here getting result from the post array after submitting the form.
    $gender = $_POST['gender'];//same
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $phno = $_POST['phno'];
    $address = $_POST['address'];
    $semester = $_POST['sem'];
    $sec = $_POST['sec'];


    $check_email_query = "SELECT * FROM student order by SRN asc";
    $first_query=mysqli_query($dbcon,$check_email_query);

    if($first_query)
    {
        if(mysqli_num_rows($first_query) == 0)
        {
        		$d = explode("-",$dob);
        		$d1 = $d[2]."/".$d[1]."/".$d[0];
            $first_insert = "INSERT INTO student (SRN,Name,Gender,DOB,Email,PhoneNo,Address,Semester,Section) VALUES ('PES001','$name','$gender','$d1','$email','$phno','$address','$semester','$sec')";
            $result1 = mysqli_query($dbcon , $first_insert);
			$first_insert = "INSERT INTO login VALUES ('PES001','PES001','S')";
            $result1 = mysqli_query($dbcon , $first_insert);
            if($result1)
            {
                echo"<script>window.alert('Registered Successfully!! Username: PES001, Password: PES001')</script>";
                echo "<script>window.open('Centralized_Page.php' , '_self')</script>";
                exit();
            }
            else
            {
                die("Error! " . mysqli_error($dbcon));
            }
        }
        else
        {
            $next_email_query = "SELECT * FROM student order by SRN ASC";
            $run_query = mysqli_query($dbcon,$next_email_query);

            if($run_query)
            {
                while($row = mysqli_fetch_row($run_query))
                {
                    $result = $row['0'];
                    //echo"<script>window.alert($result)</script>";
                }

                $type = substr($result , 0 , 3);
                $value = (int)substr($result , 3 , 3);
                $new_value = $value + 1;
                $final_value = (string)$new_value;

                $new_StudentID = $type.$final_value;
				$d = explode("-",$dob);
        			$d1 = $d[2]."/".$d[1]."/".$d[0];
                $insert_user="INSERT INTO student (SRN,Name,Gender,DOB,Email,PhoneNo,Address,Semester,Section) VALUES ('$new_StudentID','$name','$gender','$d1','$email','$phno','$address','$semester','$sec')";
                
                $result2 = mysqli_query($dbcon , $insert_user);
                 $insert_user="INSERT INTO login VALUES('$new_StudentID','$new_StudentID','S')";
                
                $result2 = mysqli_query($dbcon , $insert_user);

                if($result2)
                {
                    echo"<script>window.alert('Congratulations! Registration Complete!! Username: $new_StudentID, Password: $new_StudentID')</script>";
                    echo "<script>window.open('Centralized_Page.php' , '_self')</script>";
                    exit();
                }
                else
                {
                    die("Error in Inserting: " . mysqli_error($dbcon));
                }     
            }
        }
    }
    else
    {

        die("Error in Querying: " . mysqli_error($dbcon));          
    }
}

?>
