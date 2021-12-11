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
        <a href="searchClassesTemplate.php">Search for classes</a>
        <a href="ClassRoster.php">Class Roster</a>
        <a href="AddClassForm.php">Add Class</a>
        <a href="removeClass.php">Remove Class</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>

    <?php
        session_start();
        //checks to see if there has been a failed attempt to get a roster
        if(isset($_GET["msg"])){
            //Failed attempt to add class
            $error_message = $_GET["msg"];
            //prints what inputs were invalid
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

        try {

            //open connection to the university's database file
            $db = new PDO('sqlite:' . './myDB/uni.db');      

            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $courseID = $_POST["courseID"]; //courseID entered by user 
            $students = ""; //keep track of students in course requested
            $class = ""; //name of course requested
            $msg = "";//error message if input is invalid

            echo $courseID;
            //checks that input is valid before getting information from the db
            if (strcmp("", $courseID) != 0){
                //get students' names, ID, class and major that are  enrolled in class
                $students = $db->query("SELECT studentID, studentName, class, major FROM Students NATURAL JOIN Enroll NATURAL JOIN Major NATURAL JOIN Teaching WHERE courseID = $courseID AND facultyID = $facultyID;");
                //gets the name of the class rquested
                $class = $db->query("SELECT courseName FROM Course WHERE courseID = $courseID;");
            } else {
                //input was invalid 
                $msg .= "Invalid input please provide a valid course ID";
            }
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>
</head>
<body>
    <?php 

        $student_count = $students->fetch();
        //checks if input is of valid type by checking if the error message is empty
        if(strcmp("", $msg) == 0 && $student_count){
            //input is valid so print a table with the information of all the students enrolled in the class
            echo
                        "<table class='center'>";
            foreach($class as $tuple) {
                    echo " <tr>
                            <th></th>
                            <th>".$tuple["courseName"]." </th>
                            <th></th>
                            <th></th>
                            </tr>";  
                        }            

            echo               " <tr>
                                <th>StudentID</th>
                                <th>Student Name</th>
                                <th>Class</th>
                                <th>Major</th>
                            </tr>"; 

                    foreach($students as $student) {
                        echo " <tr>
                                <td>".$student["studentID"]." </td>
                                <td>".$student["studentName"]. "</td>
                                <td>".$student["class"]." </td>
                                <td>".$student["major"]."</td>
                                </tr>";  
                    }

                echo "</table>";
        } else{
            //input was invalid 
            $msg .= "Invalid input please provide a valid course ID";
            // the input is not valid so redirect to roster form and display what went wrong
            $redirect_url = './ClassRoster.php?msg='.$msg;
            header("Location: $redirect_url", true, 303);
        }
        $db = null;
    ?>

</body>
</html>
