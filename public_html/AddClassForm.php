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
    </style>
    <div class="toolbar">
        <a href="Dashboard.html">Home</a>
        <a href="WeeklySchedule.php">Schedule</a>
        <a href="searchClasses.php">Search for classes</a>
        <a href="AcademicRequirements">Academic Rqueirements</a>
        <a href="Enrollment.php">Enroll</a>
        <a href="4YearPlan.php">Four Year Plan</a>
    </div>
    <h2> Add New Class to Catalogue</h2>
</head>
<body>
    <?php
        $_POST["courseID"] = "";
        $_POST["courseName"] = "";
        $_POST["deptID"] = "";
        $_POST["Fall"] = "";
        $_POST["Spring"] = "";
    ?>
    <form action='./AddClassHandler.php' method='post'>
        Course ID: <input type='text' name='courseID' id='courseID'><br>
        Course Name: <input type='text' name='courseName' id='courseName' ><br>
        Department ID: <input type='text' name='deptID' id='deptID'><br>
        Meet in Fall? (0 = no, 1 = yes) <input type='text' name='Fall' id='Fall'><br>
        Meet in Spring? (0 = no, 1 = yes)<input type='text' name='Spring' id='Spring'><br>
        <input type='submit' name='Create' value='Create'>
</body>
</html>
