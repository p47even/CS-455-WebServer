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
        <a href="searchClasses.php">Search for classes</a>
        <a href="ClassRoster.php">Class Roster</a>
        <a href="AddClass.php">Add Class</a>
    </div>

    <h2>Weekly Scedule</h2>
    <?php

    try {

        $faculty_ID =3;
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
        $monClass = $db->query("SELECT meetTime, endTime, courseName, location FROM (SELECT * FROM Teaching NATURAL JOIN isMeeting NATURAL JOIN Course WHERE facultyID = $faculty_ID) WHERE meetDay = 'Monday' ORDER BY meetTime;");
        $tuClass = $db->query("SELECT meetTime, endTime, courseName, location FROM (SELECT * FROM Teaching NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE facultyID = $faculty_ID) WHERE meetDay = 'Tuesday' ORDER BY meetTime;");
        $wedClass = $db->query("SELECT meetTime, endTime, courseName, location FROM (SELECT * FROM Teaching NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE facultyID = $faculty_ID) WHERE meetDay = 'Wedmesday' ORDER BY meetTime;");
        $thClass = $db->query("SELECT  meetTime, endTime, courseName, location FROM (SELECT * FROM Teaching NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE facultyID = $faculty_ID) WHERE meetDay = 'Thursday' ORDER BY meetTime;"); 
        $frClass = $db->query("SELECT meetTime, endTime, courseName, location FROM (SELECT * FROM Teaching NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE facultyID = $faculty_ID) WHERE meetDay = 'Friday' ORDER BY meetTime;");

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
