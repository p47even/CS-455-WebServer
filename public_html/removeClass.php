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
    <!-- Tool bar that helps users navigate between pages -->
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

        //checks to see if there has been a failed attempt to remove a class
        if(isset($_GET["msg"])){
            //Failed attempt to remove class
            $error_message = $_GET["msg"];
            //prints error message
            if(strlen($error_message) >= 0){
                echo $error_message;

            }
        }
        
        //Checks to see if a faculty member is logged in as faculty
        if(!isset($_SESSION["fID"])){ 
            //user is not logged in so redirect to log in
            $loginUrl = 'project.php?msg=Please Login First';
            header("Location: $loginUrl", true, 303);
            exit; 
        }

        $facultyID = $_SESSION["fID"]; //gets the ID of user

        //open connection to the university's database file
        $db = new PDO('sqlite:' . './myDB/uni.db');

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        //gets all the classes from the user's department-- joins on departmentID
        $classes = $db->query("SELECT courseID, courseName FROM Course NATURAL JOIN Professor WHERE facultyID =$facultyID;");

        $_POST["courseID"] = "";//keeps track of courseID user wants to delete

        //form that asks for courseID to be delted and prints table of all the classes the in the user's department 
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
