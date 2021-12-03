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
        <a href="Enrollment.html">Enroll</a>
        <a href="Discussion.html">Discussion Board</a>
    </div>
    <?php

    try {

        //open connection to the university's database file
        $db = new PDO('sqlite:' . './uni.db');      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $newClass = $db->prepare("INSERT INTO Enroll VALUES (:studentID, :courseID);");         
      
        $db = null;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    ?>
</head>
<body>
    
    <form action="/EnrollmentHandler.php">
        <table>
            <tr>
                <th>Select</th>
                <th>Course Number</th>
                <th>Course Name</th>
                <th>Meeting Time</th>
                <th>Location</th>
            </tr>
            <tr>
                <td><input type="checkbox"></td>
                <td>CS161</td>
                <td>Intro to CS</td>
                <td>10:00 - 11:00</td>
                <td>TH</td>
        </table>
    </form>
</body>
</html>
