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
        <a href="WeeklySchedule.php">Schedule</a>
        <a href="searchClassesTemplate.php">Search for Classes</a>
        <!-- <a href="AcademicRequirements">Academic Requirements</a> -->
        <a href="Enrollment.php">Enroll</a>
        <!-- <a href="Discussion.html">Discussion Board</a> -->
        <a href="4YearPlanHelper.php">Four Year Plan</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <h2>Weekly Scedule</h2>
    <?php

    try {
        session_start();

       if(!isset($_SESSION["sID"]))
        { 
            $loginUrl = 'project.php?msg=Please Login First';
            header("Location: $loginUrl", true, 303);
            exit; 
        }
        $sID = $_SESSION["sID"];
        //$sID = 3;
        //open connection to the university's database file
        $db = new PDO('sqlite:' . './myDB/uni.db');      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $monClass = "";
        $tuClass = "";
        $wedClass = "";
        $thClass = "";
        $frClass = "";
        
        //$query_str = $db->query("SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = 1;");
        $monClass = $db->query("SELECT meetTime, endTime, courseName, location FROM (SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = $sID) WHERE meetDay = 'Monday' ORDER BY meetTime;");
        $tuClass = $db->query("SELECT meetTime, endTime, courseName, location FROM (SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = $sID) WHERE meetDay = 'Tuesday' ORDER BY meetTime;");
        $wedClass = $db->query("SELECT meetTime, endTime, courseName, location FROM (SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = $sID) WHERE meetDay = 'Wedmesday' ORDER BY meetTime;");
        $thClass = $db->query("SELECT  meetTime, endTime, courseName, location FROM (SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = $sID) WHERE meetDay = 'Thursday' ORDER BY meetTime;"); 
        $frClass = $db->query("SELECT meetTime, endTime, courseName, location FROM (SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = $sID) WHERE meetDay = 'Friday' ORDER BY meetTime;");

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
                                <th>Meeting Day</th>
                                <th>Meeting Time</th>
                                <th>Class</th>
                                <th>Location</th>
                            </tr>"; 

                echo "<tr><th>Monday</th><td></td><td></td><td></td></tr>";
                    foreach($monClass as $class) {
                        echo " <tr>
                                <td></td>
                                <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                                <td>".$class["courseName"]. "</td>
                                <td>".$class["location"]." </td>
                                </tr>"; 
                    }

                echo "<tr><th>Tuesday</th><td></td><td></td><td></td></tr>";
                    foreach($tuClass as $class) {
                        echo " <tr>
                                <td></td>
                                <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                            <td>".$class["courseName"]. "</td>
                                <td>".$class["location"]." </td>
                                </tr>"; 
                    }

                echo "<tr><th>Wednesday</th><td></td><td></td><td></td></tr>";
                    foreach($wedClass as $class) {
                        echo " <tr>
                                <td></td>
                                <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                                <td>".$class["courseName"]. "</td>
                                <td>".$class["location"]." </td>
                                </tr>"; 
                    }

                echo "<tr><th>Tursday</th><td></td><td></td><td></td></tr>";
                    foreach($thClass as $class) {
                        echo " <tr>
                                <td></td>
                                <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                                <td>".$class["courseName"]. "</td>
                                <td>".$class["location"]." </td>
                                </tr>"; 
                    }

                echo "<tr><th>Friday</th><td></td><td></td><td>";
                    foreach($frClass as $class) {
                        echo "<tr>
                                <td></td>
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
