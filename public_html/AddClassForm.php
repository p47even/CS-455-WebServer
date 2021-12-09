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
        h2{
            text-align: center;
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
    <h2> Add New Class to Catalogue</h2>
</head>
<body>
    <?php

    session_start();
    
    //checks to see if there has been a failed attempt to add a class
    if(isset($_GET["msg"])){
        //Failed attempt to add class
        $error_message = $_GET["msg"];
        //prints what inputs were invalid
        if(strlen($error_message) >= 0){
            echo $error_message;

        }
    }
    //Checks to see if a faculty member is logged in as faculty
    if(!isset($_SESSION["fID"])){ 
        //user is not logged in so redirect to log in
        $loginUrl = 'project.php?msg=Please Login First';
        header("Location: $loginUrl", true, 303);
        exit; 
    }
        //keeps track of user input to be passed to AddClassHandler.php to add the class
        $_POST["courseID"] = "";
        $_POST["courseName"] = "";
        $_POST["deptID"] = "";
        $_POST["Fall"] = "";
        $_POST["Spring"] = "";
    ?>

    <!-- Form that collects info of class to be added from the user -->
    <form action='./AddClassHandler.php' method='post'>
        Department ID: <input type='text' name='deptID' id='deptID'><br>
        Course ID: <input type='number' name='courseID' id='courseID'><br>
        Course Name: <input type='text' name='courseName' id='courseName' ><br>
        Meet in Fall? (Yes = 1, No = 0) <input type='number' name='Fall' id='Fall' ><br>
        Meet in Spring? (Yes = 1, No = 0)<input type='number' name='Spring' id='Spring'><br>
        <input type='submit' name='Add' value='Add'>
    </form>  
</body>
</html>
