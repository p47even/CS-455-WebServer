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
        <a href="WeeklySchedule.html">Schedule</a>
        <a href="searchClasses.php">Search for classes</a>
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

        $classes = $_SESSION["courAttrQuer"];
        
        $newClass = $db->prepare("INSERT INTO Enroll VALUES (:studentID, :courseID);");         
      
        $db = null;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    ?>
    <h2>Shopping Cart</h2>
</head>
<body>
    <?php
        echo 
            "<form action="/EnrollmentHandler.php">
                <table class="center">
                    <tr>
                        <th>Select</th>
                        <th>Course Number</th>
                        <th>Course Name</th>
                        <th>Meeting Time</th>
                        <th>Location</th>
                    </tr>";
                    foreach($classes as $class){
                        echo 
                            "<tr>
                                <td><input type="checkbox"></td>
                                <td value='".$class["courseID"]."'></td>
                                <td value='".$class["courseName"]."'></td>
                                <td  value='".$class["deptID"]."'></td>
                                <td value='".$class["location"]."'></td>";
                    }
                
                echo  "</table>
                <input type='submit' value='Enroll'>
            </form>"
    ?>
</body>
</html>
