<?php
	header('Access-Control-Allow-Origin:*');
?>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <link type="text/css" rel="stylesheet" href="bootstrap-3.2.0-dist\css\bootstrap.css">
    <title> Course Registration Page</title>

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

<script>

    function loadBox(){

        xhr = new XMLHttpRequest();

        xhr.onreadystatechange = faculty;

        xhr.open("GET" , "Faculty_Fetch.php" , true);

        xhr.send(null);

    }

    function faculty()
    {
        dropDownF = document.getElementById("faculty_drop");
        
        if(xhr.readyState == 4 && xhr.status == 200)
        {
            sendAnother();
            result1 = xhr.responseText;

            var first_split = result1.split(",");

            for(var i=0; i<=result1.length;i++)
            {
                var second_split = first_split[i].split(":");
                var options = document.createElement("option");

                if(i==0)
                {
                    second_split[0] = second_split[0].substring(2 , second_split[0].length-1);
                    second_split[1] = second_split[1].substring(1 , second_split[1].length-1);
                }

                else if(i == result1.length)
                {
                    second_split[0] = second_split[0].substring(1 , second_split[0].length-1);
                    second_split[1] = second_split[1].substring(1 , second_split[1].length-3);
                }

                else
                {
                    second_split[0] = second_split[0].substring(1 , second_split[0].length-1);
                    second_split[1] = second_split[1].substring(1 , second_split[1].length-1);
                }

                options.value = second_split[0] + "  " + "-" + "  " + second_split[1];
                options.innerHTML = second_split[0] + "  " + "-" +"  " + second_split[1];

                //window.alert(options.value);

                dropDownF.appendChild(options);
            }
        }
    }

    function sendAnother(){

        //window.alert("Inside Send Another!!");

        xhr2 = new XMLHttpRequest();
        xhr2.open("GET" , "Dept_Fetch.php" , true);
        xhr2.send(null);

        xhr2.onreadystatechange = dept;

    }

    function dept()
    {
        dropDownD = document.getElementById("dept_drop");
        
        if(xhr2.readyState == 4 && xhr2.status == 200)
        {
            result2 = xhr2.responseText;

            var first_split = result2.split(",");

            for(var j=0; j<=result2.length;j++)
            {
                var second_split = first_split[j].split(":");
                var options = document.createElement("option");

                if(j == 0)
                {
                    second_split[0] = second_split[0].substring(2 , second_split[0].length-1);
                    second_split[1] = second_split[1].substring(1 , second_split[1].length-1);
                }

                else if(j == result2.length)
                {
                    second_split[0] = second_split[0].substring(1 , second_split[0].length-1);
                    second_split[1] = second_split[1].substring(1 , second_split[1].length-3);
                }

                else
                {
                    second_split[0] = second_split[0].substring(1 , second_split[0].length-1);
                    second_split[1] = second_split[1].substring(1 , second_split[1].length-1);
                }

                options.value = second_split[0] + "  " + "-" +"  " + second_split[1];;

                options.innerHTML = second_split[0] + "  " + "-" +"  " + second_split[1];

                //window.alert(options.value);

                dropDownD.appendChild(options);
            }
        }
    }

</script>

<body onload = "loadBox()">

<div class="container"><!-- container class is used to centered  the body of the browser with some decent width-->
	<img class = "col-md-9 col-md-offset-9" src = "Images/PESU_Logo.png" id = "logo">
    <div class="row"><!-- row class is used for grid system in Bootstrap-->
        <div class="col-md-4 col-md-offset-4"><!--col-md-4 is used to create the no of colums in the grid also use for medimum and large devices-->
            <div class="login-panel panel panel-primary">
                <div class="panel-heading">
                    <h3 class="panel-title text-center"> Course Registration Form </h3>
                </div>
                <div class="panel-body">
                    <form role="form" method="post" action="Course_Reg.php">
                        <fieldset>

                            <div class="form-group">
                                <label for="Course Code">Course Code</label>
                                <input class="form-control" placeholder="Course Code" name="code" type="text" autofocus>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="Faculty ID">Faculty ID</label>
                                <select class="form-control" id="faculty_drop" name="faculty">
                                    <!---> ADD Objects - "Options Tag" from DOM Here ... -->
                                </select>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="Course Name">Course Name</label>
                                <input class="form-control" placeholder="Course Name" name="cname" type="text" autofocus>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="Dept ID">Department</label>
                                <select class="form-control" id="dept_drop" name="dept">
                                    <!---> ADD Objects - "Options Tag" from DOM Here ... -->
                                </select>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="Semester">Semester</label>
                                <input class="form-control" placeholder="Semester" name="sem" type="text" autofocus>
                            </div>

                            <br>

                            <div class="form-group">
                                <label for="Credits"> Credits </label>
                                <input class="form-control" placeholder="Credits" name="credits" type="text" autofocus>
                            </div>

                            <br> 
                            
                            <input class="btn btn-lg btn-primary btn-block" type="submit" value="Add Course" name="register">

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
    $code = $_POST['code'];
    $name = $_POST['cname'];
    $semester = $_POST['sem'];
    $credits = $_POST['credits'];

    if(isset($_POST['register']))
    {
        if(isset($_POST['faculty']))
        {
            $faculty = $_POST['faculty'];
        }

        if(isset($_POST['dept']))
        {
            $dept = $_POST['dept'];
        }    
    }


    $faculty_value = preg_split("/\s*(?<!\w(?=.\w))[\-[\]()]\s*/", $faculty);
    $dept_value = preg_split("/\s*(?<!\w(?=.\w))[\-[\]()]\s*/", $dept);

    $dept_id = $dept_value[0];
    $faculty_id = $faculty_value[0];

    $first_query = "SELECT * FROM course";
    $first_result = mysqli_query($dbcon , $first_query);

    if($first_query)
    {
        if(mysqli_num_rows($first_result) == 0)
        {
            $first_insert = "INSERT INTO course (Course_ID,Course_Code,Faculty_ID,Name,Department_ID,Semester,Credits) VALUES ('CID001','$code','$faculty_id','$name','$dept_id','$semester','$credits')"; 
            $insert_result = mysqli_query($dbcon , $first_insert);

            if($first_insert)
            {
                echo"<script>window.alert('Course Registered Succcessfully!! Course ID: CID001')</script>";
               	echo "<script>window.open('Centralized_Page.php' , '_self')</script>";
            }
            else
            {
                die("Error in Insertion: " . mysqli_error($dbcon));
            }
        }
        else
        {
            $update = "SELECT * FROM course ORDER BY Course_ID asc";
            $update_result = mysqli_query($dbcon , $update);

            if($update_result)
            {
                while($row = mysqli_fetch_row($update_result))
                {
                    $result = $row['0'];
                }

                $type = substr($result , 0 , 3);

                $value = (int)substr($result , 3 , 3);

                $new_value = $value + 1;
                $new_cid = $type . "0" . (string)$new_value;

                $final_update = "INSERT INTO course (Course_ID,Course_Code,Faculty_ID,Name,Department_ID,Semester,Credits) VALUES ('$new_cid','$code','$faculty_id','$name','$dept_id','$semester','$credits')";
                
                $final_run = mysqli_query($dbcon , $final_update);

                if($final_run)
                {
                    echo"<script>window.alert('Course Registered!! Course ID: $new_cid')</script>";
                    echo "<script>window.open('Centralized_Page.php' , '_self')</script>";
                }
                else
                {
                    die("Error while Registering!! " . mysqli_error($dbcon));
                }           
            }
        }
    }
    else
    {
        die("Error while Querying: " . mysqli_error($dbcon));
    }
}

?>
