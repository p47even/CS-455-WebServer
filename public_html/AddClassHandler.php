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
    </style>
    <div class="toolbar">
        <a href="Dashboard.html">Home</a>
        <a href="ProfSchedule.php">Schedule</a>
        <a href="searchClasses.php">Search for classes</a>
        <a href="ClassRoster.php">Class Roster</a>
        <a href="AddClassPromp.php">Edit Class</a>
        <a href="4YearPlanHelper.php">Four Year Plan</a>
    </div>
</head>
<body>
<?php
        session_start();
        $facultyID = 3;
        try {

            //open connection to the university's database file
            $db = new PDO('sqlite:' . './myDB/uni.db');  

            $msg = "";
            $existing_ID = "";
            $existing_class = "";
            $courseID = $_POST["courseID"];
            $courseName = $_POST["courseName"];
            $deptID = $_POST["deptID"];
            $fall = $_POST["Fall"];
            $spring = $_POST["Spring"];


            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $existing_ID = $db->query("SELECT courseName, courseID FROM Course WHERE courseID = $courseID;");
            $existing_class = $db->query("SELECT courseID, courseName FROM Course WHERE courseName = '$courseName';");
            $query_deptID = $db->query("SELECT * FROM Department WHERE deptID = '$deptID';");
            $ID_count = $existing_ID->fetch();
            $class_count = $existing_class->fetch();
            $valid_deptID = $query_deptID->fetch();
            if (!$ID_count && !$class_count && $valid_deptID){
                $insert_query = $db->prepare("INSERT INTO Course VALUES (:courseID, :deptID, :courseName, :fall, :spring);");
                    $insert_query->bindParam(':courseID', $courseID);
                    $insert_query->bindParam(':deptID', $deptID);
                    $insert_query->bindParam(':courseName', $courseName);
                    $insert_query->bindParam(':fall', $fall);
                    $insert_query->bindParam(':spring', $spring);
            } else {
                if ($existing_ID){
                    echo "The course ID you have entered is already in use for class. Please try again";
                    $msg .= "error";
                }

                if ($existing_class){
                    echo "The class name you have entered is already in use for class. Please try again";
                    $msg .= "error";
                }

                if(!$valid_deptID){
                    echo "The Department ID you have entered does not exist";
                    $msg .= "error";
                }
            } 
            
            if(!preg_match("/^[a-zA-Z]+$/", $courseName))
        {
            echo "Course name must be non-empty and consist of letters only<br>";
            $msg .= "error";
        }

        if(!preg_match("/^[0-9]+$/", $courseID))
        {
            echo "Course ID must be non-empty and consist of numbers 0-9 only<br>";
            $msg .= "error";
        }

        if(!preg_match("/^[A-Z]+$/", $deptID))
        {
            echo "Department ID must be non-empty and consist of numbers 0-9 only<br>";
            $msg .= "error";
        }

        if(!preg_match("/^[0-1]+$/", $fall))
        {
            echo "Fall must be non-empty and consist of numbers 0-1 only<br>";
            $msg .= "error";
        }

        if(!preg_match("/^[0-1]+$/", $spring))
        {
            echo "Spring must be non-empty and consist of numbers 0-1 only<br>";
            $msg .= "error";
        }

        if(strcmp("", $msg) == 0)
        {
            $insert_status = $insert_query->execute();
            echo "<meta http-equiv='refresh' content='0; url=./AddResult.php'/>";
        } 
        session_destroy();
        $db = null;
        } catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>
</body>
</html>
