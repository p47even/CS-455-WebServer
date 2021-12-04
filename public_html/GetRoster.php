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

            $courseID = $_POST["courseID"];
            $students = "";
            $class = "";
            echo "".$courseID."";
            if (strcmp("", $courseID) != 0 && !preg_match("/^[0-9]$/", $courseID)){
                $students = $db->query("SELECT studentID, studentName, class, major FROM Students NATURAL JOIN Enroll NATURAL JOIN Major NATURAL JOIN Teaching WHERE courseID = $courseID AND facultyID = $facultyID;");
                $class = $db->query("SELECT courseName FROM Course WHERE courseID = $courseID;");
            } else {
                echo "Invalid input please provide a valid course ID";
            }
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>
</head>
<body>
    <?php 
        echo "<h2>Roster for ".$class["courseName"]."</h2>";
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
                                <td value = '".$_SESSION["courseID"]."'>".$student["stduentID"]." </td>
                                <td>".$student["studentName"]. "</td>
                                <td>".$student["class"]." </td>
                                <td>".$student["major"]."</td>
                                </tr>"; 
                    }

                echo "</table>";
        $db = null;
    ?>

</body>
</html>
