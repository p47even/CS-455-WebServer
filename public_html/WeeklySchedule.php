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
    <!-- Tool bar that helps navigate between pages -->
    <div class="toolbar">
        <a href="dashboard.php">Home</a>
        <a href="WeeklySchedule.php">Schedule</a>
        <a href="searchClassesTemplate.php">Search for Classes</a>
        <a href="Enrollment.php?msg=">Enroll</a>
        <a href="4YearPlan.php">Four Year Plan</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <h2>Weekly Scedule</h2> 
    <?php

    try {
        session_start();

        //Checks to see if a faculty member is logged in as a student
       if(!isset($_SESSION["sID"]))
        { 
            //user is not logged in so redirect to log in
            $loginUrl = 'project.php?msg=Please Login First';
            header("Location: $loginUrl", true, 303);
            exit; 
        }


        $sID = $_SESSION["sID"]; //gets user's ID

        //open connection to the university's database file
        $db = new PDO('sqlite:' . './myDB/uni.db');      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //variables that will keep track of classes taken by current user on a specific day of the week
        $monClass = "";
        $tuClass = "";
        $wedClass = "";
        $thClass = "";
        $frClass = "";
        
        //gets classes taken by current user ordered chronologically
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

        //Prints the schedule of the current user

            //print headings of table that will hold user's schedule
            echo
                        "<table class='center'>
                            <tr>
                                <th>Meeting Day</th>
                                <th>Meeting Time</th>
                                <th>Class</th>
                                <th>Location</th>
                            </tr>"; 

                //prints classes taken on Mondays
                echo "<tr><th>Monday</th><td></td><td></td><td></td></tr>";
                    foreach($monClass as $class) {
                        echo " <tr>
                                <td></td>
                                <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                                <td>".$class["courseName"]. "</td>
                                <td>".$class["location"]." </td>
                                </tr>"; 
                    }

                //prints classes taken on Tuesdays
                echo "<tr><th>Tuesday</th><td></td><td></td><td></td></tr>";
                    foreach($tuClass as $class) {
                        echo " <tr>
                                <td></td>
                                <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                            <td>".$class["courseName"]. "</td>
                                <td>".$class["location"]." </td>
                                </tr>"; 
                    }

                //prints classes taken on Wednesdays
                echo "<tr><th>Wednesday</th><td></td><td></td><td></td></tr>";
                    foreach($wedClass as $class) {
                        echo " <tr>
                                <td></td>
                                <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                                <td>".$class["courseName"]. "</td>
                                <td>".$class["location"]." </td>
                                </tr>"; 
                    }

                //prints classes taken on Thursdays
                echo "<tr><th>Tursday</th><td></td><td></td><td></td></tr>";
                    foreach($thClass as $class) {
                        echo " <tr>
                                <td></td>
                                <td>".$class["meetTime"]. "-" .$class["endTime"]. " </td>
                                <td>".$class["courseName"]. "</td>
                                <td>".$class["location"]." </td>
                                </tr>"; 
                    }

                //prints classes taken on Firdays
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
