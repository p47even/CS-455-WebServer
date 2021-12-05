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

        $attrStr = "";
        $attrAdded = 0;
        
        $courseID = $_POST["courseID"];
        
        echo $courseID;
        
        $courseIDGiven = FALSE;
        if($courseID != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= ", ";
            }
            $attrStr .= "courseID = ".$courseID;
            $attrAdded++;
        }

        $deptID = $_POST["deptID"];
        $deptIDGiven = FALSE;
        if($deptID != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= ", ";
            }
            $attrStr .= "deptID = ".$deptID;
            $attrAdded++;
        }

        $courseName = $_POST["courseName"];
        $courseNameGiven = FALSE;
        if($courseName != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= ", ";
            }
            $attrStr .= "courseName = ".$courseName;
            $attrAdded++;
        }

        $fallSemester = $_POST["fallSemester"];
        $fallSemesterGiven = FALSE;
        if($fallSemester != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= ", ";
            }
            $attrStr .= "fallSemester = ".$fallSemester;
            $attrAdded++;
        }

        $springSemester = $_POST["springSemester"];
        $springSemesterGiven = FALSE;
        if($springSemester != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= ", ";
            }
            $attrStr .= "springSemester = ".$springSemester;
            $attrAdded++;
        }

        if($attrAdded != 0)
        {
            $attrStr = " WHERE ".$attrStr;
        }
        
        $querStmnt = "SELECT * FROM COURSE:attrStr;";

        echo $attrStr;
        echo $querStmnt;

        $classes_query = $db->prepare($querStmnt);
        $classes_query->bindParam(':attrStr', $attrStr);
        // if($courseIDGiven == TRUE)
        // {    
        //     $classes_query->bindParam(':courseID', $courseID);
        // }
        // if($deptIDGiven == TRUE)
        // {
        //     $classes_query->bindParam(':deptID', $courseName);
        // }
        // if($courseNameGiven == TRUE)
        // {
        //     $classes_query->bindParam(':courseName', $courseName);
        // }
        // if($fallSemesterGiven == TRUE)
        // {
        //     $classes_query->bindParam(':fallSemester', $fallSemester);
        // }
        // if($springSemesterGiven == TRUE)
        // {
        //     $classes_query->bindParam(':springSemester', $springSemester);
        // }

        $classes_query->execute();

        $query_result = $classes_query->fetchAll();

        $_SESSION["courAttrQuer"] = $query_result;

        //$redirect_url = $_SESSION['redirect_url']; 
        //unset($_SESSION['redirect_url']);
        //header("Location: $redirect_url", true, 303);
        //exit;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    ?>
</body>
</html>