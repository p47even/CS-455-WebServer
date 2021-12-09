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
            margin-top: 50 px;
        }

        th{
            color: maroon;
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
</head>
<body>
<?php
        session_start();
        //Checks to see if a faculty member is logged in as faculty
        if(!isset($_SESSION["fID"])){ 
            //user is not logged in so redirect to log in
            $loginUrl = 'project.php?msg=Please Login First';
            header("Location: $loginUrl", true, 303);
            exit; 
        }

        $facultyID = $_SESSION["fID"]; //keeps track of current user's ID
        try {

            //open connection to the university's database file
            $db = new PDO('sqlite:' . './myDB/uni.db');  

            $msg = ""; //error message for invalid inputs
            $existing_ID = ""; //variable that will store if classID entered already exists
            $existing_class = ""; //variable that will store if class name entered already exists
            //gets input from user
            $courseID = $_POST["courseID"]; 
            $courseName = $_POST["courseName"];
            $fall = $_POST["Fall"];
            $spring = $_POST["Spring"];
            $deptID = $_POST["deptID"];

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            //checks to see if courseID entered already exists in the db
            $existing_ID = $db->query("SELECT courseName, courseID FROM Course WHERE courseID = $courseID;");
             //checks to see if course name entered already exists in the db
            $existing_class = $db->query("SELECT courseID, courseName FROM Course WHERE courseName = '$courseName';");
            //query that checks if departmentID provided from input is in the database
            $query_deptID = $db->query("SELECT * FROM Department WHERE deptID = '$deptID';");

            //checks if queries returned matches between the DB and user input
            $ID_count = $existing_ID->fetch(); 
            $class_count = $existing_class->fetch();
            $valid_deptID = $query_deptID->fetch();

            //if the courseID and course name are not in the data base prepare insert statement
            if (!$ID_count && !$class_count && $valid_deptID){
                $insert_query = $db->prepare("INSERT INTO Course VALUES (:courseID, :deptID, :courseName, :fall, :spring);");
                    //protects agains SQL injections
                    $insert_query->bindParam(':courseID', $courseID);
                    $insert_query->bindParam(':deptID', $deptID);
                    $insert_query->bindParam(':courseName', $courseName);
                    $insert_query->bindParam(':fall', $fall);
                    $insert_query->bindParam(':spring', $spring);
            } else {

                //the courseID and/or course name were in the data base 

                //loads error message if courseID entered is already in db
                if ($existing_ID){
                    $msg .= "The course ID you have entered is already in use. Please try again<br>";
                }

                //loads error message if course name entered is already in db
                if ($existing_class){
                    $msg .= "The class name you have entered is already in use. Please try again<br>";
                }

                //loads error message if departmentID entered is not in the db
                if(!$valid_deptID){
                    $msg .= "The Department ID you have entered does not exist<br>";
                }
            } 
            
            //makes sure that all inputs entered are of the correct type

            //checks if course name entered is a string -- loads error message if not
            if(!preg_match("/^[a-zA-Z]+$/", $courseName))
        {
            $msg .= "Course name must be non-empty and consist of letters only<br>";
        }

        
        //checks to see if deptID is a string -- loads error message if not
        if(!preg_match("/^[A-Z]+$/", $deptID))
        {
            $msg .= "Department ID must be non-empty and consist of numbers 0-9 only<br>";
        }

        //checks to see if Fall attribute is either 1 or 0 -- loads error message if not
        if(!preg_match("/^[0-1]+$/", $fall))
        {
            $msg .= "Fall must be non-empty and consist of numbers 0-1 only<br>";
        }

        //checks to see if Spring attribute is either 1 or 0 -- loads error message if not
        if(!preg_match("/^[0-1]+$/", $spring))
        {
            $msg .= "Spring must be non-empty and consist of numbers 0-1 only<br>";
        }

        //checks if input is of valid type by checking if the error message is empty
        if(strcmp("", $msg) == 0)
        {
            //all input is valid so insert class into the db
            $insert_status = $insert_query->execute();
        } else{
            //some or all of the input is not valid so redirect to add class form and display what went wrong
            $redirect_url = './AddClassForm.php?msg='.$msg;
            header("Location: $redirect_url", true, 303);
        }

        //after adding class to the db displays a table with all classes in the department class was added into

        //query: selects courseID and name of all classes in the department class was added into 
        $classes = $db->query("SELECT courseName, courseID FROM Course WHERE deptID = '$deptID';");

        //prints table into page
        echo "<h2>Success!</h2>";
        echo
                        "<table class='center'>
                            <tr>
                                <th>Course ID</th>
                                <th>Course Name</th>
                            </tr>"; 

                    foreach($classes as $class) {
                        echo " <tr>
                                <td>".$class["courseID"]. " </td>
                                <td>".$class["courseName"]. "</td>
                                </tr>"; 
                    }
        $db = null;
        } catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>
</body>
</html>
