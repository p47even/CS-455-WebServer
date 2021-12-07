<!DOCTYPE html>
<html>
        <head>
                <title>Welcome Student!</title>
                <link rel="stylesheet" href="dashboard.css"/>

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
    <a href="dashboard.php">Home</a>
        <a href="WeeklySchedule.php">Schedule</a>
        <a href="searchClassesTemplate.php">Search for Classes</a>
        <!-- <a href="AcademicRequirements">Academic Requirements</a> -->
        <a href="Enrollment.php?msg=">Enroll</a>
        <!-- <a href="Discussion.html">Discussion Board</a> -->
        <a href="4YearPlanHelper.php">Four Year Plan</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
        </head>
        <body>
            <?php
                session_start();
                
                if(!isset($_SESSION["sID"]))
                { 
                    $loginUrl = 'project.php?msg=Please Login First';
                    header("Location: $loginUrl", true, 303);
                    exit; 
                }
            ?>
        </body>
</html>
