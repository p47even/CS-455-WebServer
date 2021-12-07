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
        <a href="Dashboard.html">Home</a>
        <a href="ProfSchedule.php">Schedule</a>
        <a href="searchClasses.php">Search for classes</a>
        <a href="ClassRoster.php">Class Roster</a>
        <a href="AddClassPromp.php">Edit Class</a>
    </div>
    <h2>Classes</h2>
</head>
<body>
    <?php
        session_start();
        $facultyID = 3;

        //open connection to the university's database file
        $db = new PDO('sqlite:' . './myDB/uni.db');

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $classes = $db->query("SELECT courseID, courseName FROM Course NATURAL JOIN Professor WHERE facultyID =$facultyID;");
        $_POST["courseID"] = "";

        echo "<form action='./removeClassHandler.php' method='post'>
                <table class='center'>
                <tr>
                    <th>Select</th>
                    <th>Course ID</th>
                    <th>Course Name</th>
                </tr>";

        foreach($classes as $class){
            $courseID = $class["courseID"];
           echo"<tr>
                <td><input type='radio' name = 'delete' value='$courseID'></td>
                <td>".$class["courseID"]."</td>
                <td>".$class["courseName"]."</td>
                </tr>";
        }
        echo "</table> 
        <input type='submit' name='Delete' value='Delete'></form>";
        session_destroy();
    ?>
</body>
</html>
