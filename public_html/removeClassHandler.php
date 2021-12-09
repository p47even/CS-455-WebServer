<!DOCTYPE html>
<html>
<head>
<style>
        .toolbar{
            background-color: maroon;
        }
        .toolbar a:hover{
            background-color:white;
            color: black;
        }

        .toolbar a{
            padding: 15px 15px;
            color: white;
            font-size: 20px;
            text-decoration: none;
        }

        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
        }

        table.center {
            margin-left: auto; 
            margin-right: auto;
        }

        th{
            color: maroon;
        }
        h2{
            text-align: center;
        }
    </style>
    <!-- Tool bar that helps users navigate between pages -->
    <div class="toolbar">
    <a href="facultyDashboard.php">Home</a>
        <a href="ProfSchedule.php">Schedule</a>
        <a href="ClassRoster.php">Class Roster</a>
        <a href="AddClassForm.php">Add Class</a>
        <a href="removeClass.php">Remove Class</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
</head>
<body>
<?php
        session_start();
        
        //Checks to see if a faculty member is logged in as faculty
        if(!isset($_SESSION["fID"])){ 
            //user is not logged in so redirect to log in
            $loginUrl = 'project.php?msg=Please Login First';
            header("Location: $loginUrl", true, 303);
            exit; 
        }

        $facultyID = $_SESSION["fID"]; //gets the ID of user
        try {

            //open connection to the university's database file
            $db = new PDO('sqlite:' . './myDB/uni.db');     

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $courseID = $_POST["courseID"]; //gest courseID inputed from user

            //query that makes sure the entered courseID exists in the db
            $valid_input = $db->query("SELECT * FROM Course WHERE courseID = '$courseID';");
            $valid_ID = $valid_input->fetch();//checks if there were any matches between input and db

            //prepares SQL statements to delete requested course 
            $delete_course = $db->prepare("DELETE FROM Course WHERE courseID = '$courseID';" );
            $delete_class = $db->prepare("DELETE FROM isMeeting WHERE courseID = '$courseID';" );

            //if input courseID is in the db delete it from the database
            if ($valid_ID){
                $course_deleted = $delete_course->execute();//deletes class from course table
                $class_deleted = $delete_class->execute();//deletes class from isMeeting table
                //redirects to form after class has been deleted
                echo "<meta http-equiv='refresh' content='0; url=./removeClass.php'/>"; 
            } else {
                //courseID input does not exist in the db 
                $msg .= "Please enter a valid courseID"; //set error message
                //redirect to remove class form and display error message
                $redirect_url = './removeClass.php?msg='.$msg;
                header("Location: $redirect_url", true, 303);
            }
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
        $db = null;
    ?>
</body>
</html>
