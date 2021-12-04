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
    <?php
        session_start();
        $facultyID = 3;
        try {

            //open connection to the university's database file
            $db = new PDO('sqlite:' . './uni.db');      // <------ Line 13

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $teaching = $db->query("SELECT courseID, courseName FROM Teaching NATURAL JOIN Course WHERE facultyID = $facultyID;");
            
        } catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>
    </head>
    <body>
        <?php

        $_SESSION["courseID"] = "";
        echo
        "<form action='./GetRoster.php' method='post'>
        Course ID: <input type='text' name='courseID' id='courseID' value ='".$_SESSION["courseID"]."'><br>
        <input type='submit' name='search' value='Search'>"
        ;

        echo "<br><br>";
        echo "<h2>Currently Teaching</h2>";
        echo
                        "<table class='center'>
                            <tr>
                                <th>Course ID</th>
                                <th>Course Name</th>
                            </tr>"; 

                    foreach($teaching as $class) {
                        echo " <tr>
                                <td></td>
                                <td>".$class["courseID"]. " </td>
                                <td>".$class["courseName"]. "</td>
                                </tr>"; 
                    }

        
        ?>
    </body>
    </html>