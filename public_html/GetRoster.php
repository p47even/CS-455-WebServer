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

    <h2>Weekly Scedule</h2>
    <?php

    try {

        //open connection to the university's database file
        $db = new PDO('sqlite:' . './uni.db');      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $courseID = $_POST["courseID"];
        $section = $_POST["section"];
        
        $students = $db->query("SELECT studentID, studentName, class, major FROM Students NATURAL JOIN Enroll NATURAL JOIN Major WHERE courseID = $courseID;");
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    ?>
</head>
<body>
    <?php 
            echo
                        "<table class='center'>
                            <tr>
                                <th>StudentID</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Major</th>
                            </tr>"; 

                    foreach($students as $student) {
                        echo " <tr>
                                <td>".$class["stduentID"]." </td>
                                <td>".$class["studentName"]. "</td>
                                <td>".$class["class"]." </td>
                                <td>".$class["major"]."</td>
                                </tr>"; 
                    }

                echo "</table>";
        $db = null;
    ?>

</body>
</html>
