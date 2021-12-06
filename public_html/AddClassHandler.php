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
        <a href="Search4Classes">Search for classes</a>
        <a href="ClassRoster.php">Class Roster</a>
        <a href="AddClass.php">Add Class</a>
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
            $existing_class = $db->query("SELECT courseID, courseName FROM Course WHERE courseName = $courseName;");

            if (mysql_num_rows($existing_ID) == 0 && mysql_num_rows($existing_class) == 0){
                $insert_query = $db->prepare("INSERT INTO Course VALUES (:courseID, :deptID, :courseName, :fall, :spring);");
                    $insert_query->bindParam(':courseID', $courseID);
                    $insert_query->bindParam(':deptID', $deptID);
                    $insert_query->bindParam(':courseName', $courseName);
                    $insert_query->bindParam(':fall', $fall);
                    $insert_query->bindParam(':spring', $spring);
            } else {
                if (mysql_num_rows($existing_ID)!=0){
                    $msg .= "The course ID you have entered is already in use for class".$existing_ID["courseID"]." ".$existing_ID["courseName"].". Please try again";
                }

                if (mysql_num_rows($existing_class)!=0){
                    $msg .= "The class name you have entered is already in use for class".$existing_class["courseID"]." ".$existing_class["courseNmae"]." Please try again";
                }
            } 
            
            if(!preg_match("/^[a-zA-Z]+$/", $courseName))
        {
            $msg .= "Course name must be non-empty and consist of letters only<br>";
        }

        if(!preg_match("/^[0-9]+$/", $courseID))
        {
            $msg .= "Course ID must be non-empty and consist of numbers 0-9 only<br>";
        }

        if(!preg_match("/^[0-9]+$/", $deptID))
        {
            $msg .= "Department ID must be non-empty and consist of numbers 0-9 only<br>";
        }

        if(!preg_match("/^[0-1]+$/", $fall))
        {
            $msg .= "Fall must be non-empty and consist of numbers 0-1 only<br>";
        }

        if(!preg_match("/^[0-1]+$/", $spring))
        {
            $msg .= "Spring must be non-empty and consist of numbers 0-1 only<br>";
        }

        if(strcmp("", $msg) == 0)
        {
            $insert_status = $insert_query->execute();
            echo "<meta http-equiv='refresh' content='0; url=./AddClassPrompt.php?msg=Success!'/>";
        }  else
        {
            echo "<meta http-equiv='refresh' content='0; url=./AddClassForm.php?msg=$msg'/>";
        }
        
        $db = null;
        } catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }
    ?>
</body>
</html>
