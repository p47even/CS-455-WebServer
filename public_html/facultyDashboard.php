<!DOCTYPE html>
<html>
        <head>
                <title>Welcome Faculty!</title>
                <link rel="stylesheet" href="dashboardStyling.css"/>

                <style>
        .toolbar{
            background-color: maroon;
        }
        .toolbar a:hover{
            background-color:white;
            color: black
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
    <div class="toolbar">
    <a href="facultyDashboard.php">Home</a>
<<<<<<< HEAD
        <!--<a href="ProfSchedule.php">Schedule</a> -->
        <!--<a href="searchClasses.php">Search for classes</a> -->
        <!--<a href="ClassRoster.php">Class Roster</a> -->
        <!--<a href="AddClassPromp.php">Add Class</a> -->
       <!-- <a href="removeClass.php">Remove Class</a> -->
        <!-- <a href="logout.php" class="logout">Logout</a> -->
=======
        <!-- <a href="WeeklySchedule.php">Schedule</a> -->
        <!-- <a href="searchClassesTemplate.php">Search for Classes</a> -->
        <!-- <a href="AcademicRequirements">Academic Requirements</a> -->
        <!-- <a href="Enrollment.php?msg=">Enroll</a> -->
        <!-- <a href="Discussion.html">Discussion Board</a> -->
        <!-- <a href="4YearPlan.php">Four Year Plan</a> -->
        <a href="addStudent.php">Add New Student</a>
        <a href="logout.php" class="logout">Logout</a>
>>>>>>> 1c98b7057d00881b4d93e596dbd7aa180df73d09
    </div>
        </head>
        <body>
            <?php
                session_start();

                if(!isset($_SESSION["fID"]))
                {
                    $loginUrl = 'fProject.php?msg=Please Login First';
                    header("Location: $loginUrl", true, 303);
                    exit;
                }
            ?>
        </body>
</html>
