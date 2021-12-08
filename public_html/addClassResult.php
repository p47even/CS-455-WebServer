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
    </style>
    <div class="toolbar">
    <a href="facultyDashboard.php">Home</a>
        <a href="ProfSchedule.php">Schedule</a>
        <a href="searchClasses.php">Search for classes</a>
        <a href="ClassRoster.php">Class Roster</a>
        <a href="AddClassForm.php">Add Class</a>
        <a href="removeClass.php">Remove Class</a>
        <a href="logout.php" class="logout">Logout
    </div>
</head>
<body>
<?php
             session_start();

            if(!isset($_SESSION["fID"]))
            { 
                $loginUrl = 'project.php?msg=Please Login First';
                header("Location: $loginUrl", true, 303);
                exit; 
            }
             $facultyID = $_SESSION["fID"];
             try {
     
                 //open connection to the university's database file
                 $db = new PDO('sqlite:' . './myDB/uni.db');      // <------ Line 13
     
                 //set errormode to use exceptions
                 $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
     
                 $deptID = $_POST["deptID"];
                 $classes_available = $db->query("SELECT courseID, courseName FROM Course WHERE deptID =$deptID;");

                 echo
                        "<table class='center'>
                            <tr>
                                <th>CourseID</th>
                                <th>Course Name</th>
                            </tr>"; 

                    foreach($classes_available as $class) {
                        echo " <tr>
                                <td></td>
                                <td>".$class["courseID"]. " </td>
                                <td>".$class["courseName"]. "</td>
                                </tr>"; 
                    }
        
             }
             catch(PDOException $e) {
                 die('Exception : '.$e->getMessage());
             }
             $db = null;
         ?>
</body>
</html>