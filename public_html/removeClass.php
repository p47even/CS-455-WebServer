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
        .button {
            color: maroon;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin: 4px 2px;
            cursor: pointer;
        }
        h2{
            text-align: center;
        }
    </style>
    <div class="toolbar">
        <a href="facultyDashboard.php">Home</a>
        <a href="ProfSchedule.php">Schedule</a>
        <a href="ClassRoster.php">Class Roster</a>
        <a href="AddClassForm.php">Add Class</a>
        <a href="removeClass.php">Remove Class</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <h2>Classes</h2>
</head>
<body>
    <?php
        session_start();
        
        if(!isset($_SESSION["fID"])){ 
            $loginUrl = 'project.php?msg=Please Login First';
            header("Location: $loginUrl", true, 303);
            exit; 
        }
        $facultyID = $_SESSION["fID"];

        //open connection to the university's database file
        $db = new PDO('sqlite:' . './myDB/uni.db');

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $classes = $db->query("SELECT courseID, courseName FROM Course NATURAL JOIN Professor WHERE facultyID =$facultyID;");
        $_POST["courseID"] = "";

        echo "<form action='./removeClassHandler.php' method='post'>
                Course ID: <input type='number' name = 'courseID' id='courseID'><br>
                <input type='submit' name='Delete' value='Delete'>
                <table class='center'>
                <tr>
                    <th>Course ID</th>
                    <th>Course Name</th>
                </tr>";

        foreach($classes as $class){
            $courseID = $class["courseID"];
           echo"<tr>
                <td>".$class["courseID"]."</td>
                <td>".$class["courseName"]."</td>
                </tr>";
        }
        echo "</table>";
    ?>
</body>
</html>
