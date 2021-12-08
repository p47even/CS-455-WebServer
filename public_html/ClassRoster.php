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
    <div class ="toolbar">
        <a href="facultyDashboard.php">Home</a>
        <a href="ProfSchedule.php">Schedule</a>
        <a href="searchClasses.php">Search for classes</a>
        <a href="ClassRoster.php">Class Roster</a>
        <a href="AddClassPromp.php">Add Class</a>
        <a href="removeClass.php">Remove Class</a>
        <a href="logout.php" class="logout">Logout
    </div>
    <?php
        session_start();
        
        if(!isset($_SESSION["fID"]))
        { 
            $loginUrl = 'project.php?msg=Please Login First';
            header("Location: $loginUrl", true, 303);
            exit; 
        }
        $facultyID = $_SESSION["fID"];
        try {

            //open connection to the university's database file
            $db = new PDO('sqlite:' . './myDB/uni.db');      // <------ Line 13

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $teaching = $db->query("SELECT courseID, courseName FROM Teaching NATURAL JOIN Course WHERE facultyID = $facultyID;");
            
        } catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>
    </head>
    <body>
        <?php

        $_SESSION["courseID"] = "";
        echo
        "<form action='./GetRoster.php' method='post'>
        Course ID: <input type='text' name='courseID' id='courseID' value ='".$_SESSION["courseID"]."'><br>
        <input type='submit' name='search' value='Search'>"
        ;

        echo "<br><br>";
        echo "<h2>Currently Teaching</h2>";
        echo
                        "<table class='center'>
                            <tr>
                                <th>Course ID</th>
                                <th>Course Name</th>
                            </tr>"; 

                    foreach($teaching as $class) {
                        echo " <tr>
                                <td>".$class["courseID"]. " </td>
                                <td>".$class["courseName"]. "</td>
                                </tr>"; 
                    }

        
        ?>
    </body>
    </html>
