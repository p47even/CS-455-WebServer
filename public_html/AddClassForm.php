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
    <div class="toolbar">
        <a href="facultyDashboard.php">Home</a>
        <a href="ProfSchedule.php">Schedule</a>
        <a href="searchClasses.php">Search for classes</a>
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

    if(!isset($_SESSION["fID"])){ 
        $loginUrl = 'project.php?msg=Please Login First';
        header("Location: $loginUrl", true, 303);
        exit; 
    }
        $_POST["courseID"] = "";
        $_POST["courseName"] = "";
        $_POST["deptID"] = "";
        $_POST["Fall"] = "";
        $_POST["Spring"] = "";
    ?>
    <form action='./AddClassHandler.php' method='post'>
        Course ID: <input type='number' name='courseID' id='courseID'><br>
        Course Name: <input type='text' name='courseName' id='courseName' ><br>
        Department ID: <input type='text' name='deptID' id='deptID'><br>
        Meet in Fall? (0 = no, 1 = yes) <input type='text' name='Fall' id='Fall' min="0" max="1"><br>
        Meet in Spring? (0 = no, 1 = yes)<input type='text' name='Spring' id='Spring' min="0" max="1"><br>
        <input type='submit' name='Create' value='Create'>

</body>
</html>
