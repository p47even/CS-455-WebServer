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
        
        $query_str = $db->query("SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = 1;");
        $monClass = $db->query("SELECT meetTime, endTime, courseName, location FROM $query_str WHERE meetDay = 'Monday' ORDER BY meetTime;");
        $tuClass = $db->query("SELECT meetTime, endTime, courseName, location FROM $query_str WHERE meetDay = 'Tuesday' ORDER BY meetTime;");
        $wedClass = $db->query("SELECT meetTime, endTime, courseName, location FROM $query_str WHERE meetDay = 'Wedmesday' ORDER BY meetTime;");
        $thClass = $db->query("SELECT  meetTime, endTime, courseName, location FROM $query_str WHERE meetDay = 'Thursday' ORDER BY meetTime;"); 
        $frClass = $db->query("SELECT meetTime, endTime, courseName, location FROM $query_str WHERE meetDay = 'Friday' ORDER BY meetTime;");
        
        $monClassesArray = array();
        $tuClassesArray = array();
        $wedClassesArray = array();
        $thClassesArray = array();
        $frClassesArray = array();

        foreach($monClasss as $class){
            $monClassesArray = array("$class[meetTime] $class[endTime] $class[courseName] $class[location]\t");
        }

        foreach($tuClasss as $class){
            $tuClassesArray = array("$class[meetTime] $class[endTime] $class[courseName] $class[location]\t");
        }

        foreach($wedClasss as $class){
            $wedClassesArray = array("$class[meetTime] $class[endTime] $class[courseName] $class[location]\t");
        }

        foreach($thClasss as $class){
            $thClassesArray = array("$class[meetTime] $class[endTime] $class[courseName] $class[location]\t");
        }

        foreach($frClasss as $class){
            $frClassesArray = array("$class[meetTime] $class[endTime] $class[courseName] $class[location]\t");
        }
      
        $db = null;

    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    ?>
</head>
<body>
    <table>
        <tr>
            <th>Sunday</th>
            <th>Monday</th>
            <th>Tuesday</th>
            <th>Wednesday</th>
            <th>Thursday</th>
            <th>Friday</th>
            <th>Saturday</th>
        </tr>
        
        <tr>
            <th><th>
            <th><?php foreach ($monClassesArray as $class){
                echo $class;
            } ?></th>
            <th><?php foreach ($tuClassesArray as $class){
                echo $class;
            } ?></th>

            <th><?php foreach ($wedClassesArray as $class){
                echo $class;
            } ?></th>

            <th><?php foreach ($thClassesArray as $class){
                echo $class;
            } ?></th>

            <th><?php foreach ($frClassesArray as $class){
                echo $class;
            } ?></th>

            <th></th>
        </tr>

    </table>
</body>
</html>
