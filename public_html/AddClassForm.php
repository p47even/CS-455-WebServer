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
        echo
        "<form action='./AddClassHandler.php' method='post'>
        Course ID: <input type='text' name='courseID' id='courseID' value ='".$_POST["courseID"]."'><br>
        Course Name: <input type='text' name='courseID' id='courseID' value ='".$_POST["courseName"]."'><br>
        Department ID: <input type='text' name='courseID' id='courseID' value ='".$_POST["deptID"]."'><br>
        Meet in Fall? (0 = no, 1 = yes) <input type='text' name='courseID' id='courseID' value ='".$_POST["Fall"]."'><br>
        Meet in Spring? (0 = no, 1 = yes)<input type='text' name='courseID' id='courseID' value ='".$_POST["Spring"]."'><br>
        <input type='submit' name='Create' value='Create'>";
    ?>
</body>
</html>
