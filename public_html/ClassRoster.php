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
    <div class="toolbar">
        <a href="Dashboard.html">Home</a>
        <a href="WeeklySchedule.php">Schedule</a>
        <a href="Search4Classes">Search for classes</a>
        <a href="AcademicRequirements">Academic Rqueirements</a>
        <a href="Enrollment.php">Enroll</a>
        <a href="4YearPlan.php">Four Year Plan</a>
    </div>
    </head>
    <body>
        <?php
        echo
        "<form action='./GetRoster.php' method='post'>
        Course ID: <input type='text' name='courseID' id='courseID' value='".$_SESSION["courseID"]."'><br>
        <form action='./GetRoster.php' method='post'>
        Section: <input type='text' name='section' id='section' value='".$_SESSION["section"]."'><br>
        
        <input type='submit' name='search' value='Search'>"
        ;

        echo "<br><br>";
        ?>
    </body>
    </html>