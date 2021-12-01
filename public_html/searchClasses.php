<!DOCTYPE html>
<html>
<body>
    <?php
    session_start();
    //path to the SQLite database file
    $db_file = './uni.db';

    try {

        //open connection to the airport database file
        $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $courseID = $_POST["courseID"];
        if($courseID == "")
        {
            $courseID = "*";
        }
        $dept = $_POST["deptID"];
        if($deptID == "")
        {
            $deptID = "*";
        }
        $courseName = $_POST["courseName"];
        if($courseName == "")
        {
            $courseName = "*";
        }
        $fallSemester = $_POST["fallSemester"];
        if($fallSemester == "")
        {
            $fallSemester = "*";
        }
        $springSemester = $_POST["springSemester"];
        if($springSemester == "")
        {
            $springSemester = "*";
        }

        $classes_query = $db->prepare("SELECT FROM COURSE WHERE courseID = :courseID, deptID = :deptID, courseName = :courseName, fallSemester = :fallSemester, springSemester = :springSemester;");
            $classes_query->bindParam(':courseID', $courseID);
            $classes_query->bindParam(':deptID', $courseName);
            $classes_query->bindParam(':courseName', $courseName);
            $classes_query->bindParam(':fallSemester', $fallSemester);
            $classes_query->bindParam(':springSemester', $springSemester);
        
        $query_result = $classes_query->execute();
      
        $_SESSION["courAttrQuer"] = $query_result;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    ?>
</body>
</html>