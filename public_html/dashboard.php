<!DOCTYPE html>
<html>
        <head>
                <title>Welcome Student!</title>
                <link rel="stylesheet" href="dashboardStyling.css"/>

                <style>
        .toolbar{
            background-color: maroon;
        }
        .toolbar a:hover{
            background-color:linen;
            color: black
        }

        .toolbar a{
            padding: 15px 15px;
            color: white;
            font-size: 20px;
            text-decoration: none;
            font-family: arial;
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
        .center{
            display: block;
            margin-left: auto;
            margin-right: auto;
            margin-top: 35px;
        }
    </style>
    <div class="toolbar">
    <a href="dashboard.php">Home</a>
        <a href="WeeklySchedule.php">Schedule</a>
        <a href="searchClassesTemplate.php">Search for Classes</a>
        <!-- <a href="AcademicRequirements">Academic Requirements</a> -->
        <a href="Enrollment.php?msg=">Enroll</a>
        <!-- <a href="Discussion.html">Discussion Board</a> -->
        <a href="4YearPlan.php">Four Year Plan</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
        </head>
        <body style = "background-color: linen;">
            <?php
                session_start();

                if(!isset($_SESSION["sID"]))
                {
                    $loginUrl = 'project.php?msg=Please Login First';
                    header("Location: $loginUrl", true, 303);
                    exit;
                }
            ?>
            <img src = "./sugedpount.jpg" alt = "Welcome!" class = "center">
        </body>
</html>
