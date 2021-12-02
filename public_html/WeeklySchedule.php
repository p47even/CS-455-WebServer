<!DOCTYPE html>
<html>
<head>
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

        table, th, td {
            border: 1px solid black;
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

        $monClass = "";
        $tuClass = "";
        $wedClass = "";
        $thClass = "";
        $frClass = "";
        
        //$query_str = $db->query("SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = 1;");
        $monClass = $db->query("SELECT meetTime, endTime, courseName, location FROM (SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = 1) WHERE meetDay = 'Monday' ORDER BY meetTime;");
        $tuClass = $db->query("SELECT meetTime, endTime, courseName, location FROM (SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = 1) WHERE meetDay = 'Tuesday' ORDER BY meetTime;");
        $wedClass = $db->query("SELECT meetTime, endTime, courseName, location FROM (SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = 1) WHERE meetDay = 'Wedmesday' ORDER BY meetTime;");
        $thClass = $db->query("SELECT  meetTime, endTime, courseName, location FROM (SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = 1) WHERE meetDay = 'Thursday' ORDER BY meetTime;"); 
        $frClass = $db->query("SELECT meetTime, endTime, courseName, location FROM (SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = 1) WHERE meetDay = 'Friday' ORDER BY meetTime;");

    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    ?>
</head>
<body>
    <?php 
            echo
                        "<table>
                            <tr>
                                <th>Monday</th>
                                <th>Tuesday</th>
                                <th>Wednesday</th>
                                <th>Thursday</th>
                                <th>Friday</th>
                            </tr>"; 

                foreach($monClass as $class) {
                    echo "<tr>
                            <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                            <td>".$class["courseName"]. "</td>
                            <td>".$class["location"]." </td>
                            </tr>"; 
                }

                foreach($tuClass as $class) {
                    echo "<tr>
                            <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                            <td>".$class["courseName"]. "</td>
                            <td>".$class["location"]." </td>
                            </tr>"; 
                }

                foreach($wedClass as $class) {
                    echo "<tr>
                            <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                            <td>".$class["courseName"]. "</td>
                            <td>".$class["location"]." </td>
                            </tr>"; 
                }

                foreach($thClass as $class) {
                    echo "<tr>
                            <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                            <td>".$class["courseName"]. "</td>
                            <td>".$class["location"]." </td>
                            </tr>"; 
                }

                foreach($thClass as $class) {
                    echo "<tr>
                            <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                            <td>".$class["courseName"]. "</td>
                            <td>".$class["location"]." </td>
                            </tr>"; 
                }

                foreach($frClass as $class) {
                    echo "<tr>
                            <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                            <td>".$class["courseName"]. "</td>
                            <td>".$class["location"]." </td>
                            </tr>"; 
                }
                echo "</table>";
        $db = null;
    ?>

</body>
</html>
