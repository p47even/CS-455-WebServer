<!DOCTYPE html>
<html>
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
        <a href="WeeklySchedule.html">Schedule</a>
        <a href="Search4Classes">Search for classes</a>
        <a href="AcademicRequirements">Academic Rqueirements</a>
        <a href="Enrollment.php">Enroll</a>
        <a href="4YearPlanSample.php">Four Year Plan</a>
    </div>

    <table>
        <tr>
            <th>Select</th>
            <th>Class #</th>
            <th>Class Tittle</th>
            <th>Instructor</th>
            <th>Meeting Time</th>
            <th>Meeting Days</th>
        </tr>

<h2>Weekly Scedule</h2>
<body>
    <?php

    try {

        //open connection to the university's database file
        $db = new PDO('sqlite:' . './uni.db');      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $query_str = $db->query("SELECT * FROM Enroll NATURAL JOIN IsMeeting NATURAL JOIN Course WHERE studentID = 1 GROUP BY courseID;");
         
        $classes = "";
        foreach($query_str as $class){
            $classes = array(array("$class[meetDay] $class[meetTime] $class[endTime] $class[courseName] $class[location]\t"));
        }
      
        $db = null;

        foreach($classes as $class){
            echo "<tr>$class</tr>";
        }
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    ?>
</body>
</html>
