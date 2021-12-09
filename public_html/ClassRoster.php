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
    <!-- Tool bar that helps users navigate between pages -->
    <div class ="toolbar">
        <a href="facultyDashboard.php">Home</a>
        <a href="ProfSchedule.php">Schedule</a>
        <a href="ClassRoster.php">Class Roster</a>
        <a href="AddClassForm.php">Add Class</a>
        <a href="removeClass.php">Remove Class</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <?php
        session_start();
        
        //Checks to see if a faculty member is logged in as faculty
        if(!isset($_SESSION["fID"])){ 
            //user is not logged in so redirect to log in
            $loginUrl = 'project.php?msg=Please Login First';
            header("Location: $loginUrl", true, 303);
            exit; 
        }

        $facultyID = $_SESSION["fID"]; //gets the ID of user
        try {

            //open connection to the university's database file
            $db = new PDO('sqlite:' . './myDB/uni.db');      

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //Gets the courseID and name of all the courses the current user is teaching 
            $teaching = $db->query("SELECT courseID, courseName FROM Teaching NATURAL JOIN Course WHERE facultyID = $facultyID;");
            
        } catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>
    </head>
    <body>
        <?php

        $_POST["courseID"] = ""; //keep track of courseID of course user wants to see roster of

        //form that collects the courseID of course user wants to see roster of and sends it to GetRoster.php
        echo
        "<form action='./GetRoster.php' method='post'>
        Course ID: <input type='number' name='courseID' id='courseID' value ='".$_POST["courseID"]."'><br>
        <input type='submit' name='search' value='Search'>";

        //prints table populated with all the courseID and course Names the user is teaching 
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
