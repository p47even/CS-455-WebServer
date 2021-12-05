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
        <a href="Dashboard.html">Home</a>
        <a href="WeeklySchedule.php">Schedule</a>
        <a href="searchClasses.php">Search for classes</a>
        <a href="AcademicRequirements">Academic Rqueirements</a>
        <a href="Enrollment.php">Enroll</a>
        <a href="4YearPlan.php">Four Year Plan</a>
    </div>
</head>
<body>
    <?php
        echo
        "<form action='./AddClassHandler.php' method='post'>
        Course ID: <input type='text' name='courseID' id='courseID' value ='".$_SESSION["courseID"]."'><br>
        Course Name: <input type='text' name='courseID' id='courseID' value ='".$_SESSION["courseName"]."'><br>
        Department ID: <input type='text' name='courseID' id='courseID' value ='".$_SESSION["deptID"]."'><br>
        Meet in Fall? (0 = no, 1 = yes) <input type='text' name='courseID' id='courseID' value ='".$_SESSION["Fall"]."'><br>
        Meet in Spring? (0 = no, 1 = yes)<input type='text' name='courseID' id='courseID' value ='".$_SESSION["Spring"]."'><br>
        <input type='submit' name='Create' value='Create'>";
    ?>
</body>
</html>
