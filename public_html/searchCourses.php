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
        
        $courseIDGiven = FALSE;
        if($courseID != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= ",";
            }
            $attrStr .= " courseID = :courseID";
            $attrAdded++;
            $courseIDGiven = TRUE;
        }

        $deptID = $_POST["deptID"];
        $deptIDGiven = FALSE;
        if($deptID != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= ",";
            }
            $attrStr .= " deptID = :deptID";
            $attrAdded++;
            $deptIDGiven = TRUE;
        }

        $courseName = $_POST["courseName"];
        $courseNameGiven = FALSE;
        if($courseName != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= ",";
            }
            $attrStr .= " courseName = :courseName";
            $attrAdded++;
            $courseNameGiven = TRUE;
        }

        $meetTime = $_POST["meetTime"];
        $meetTimeGiven = FALSE;
        if($meetTimeName != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= ",";
            }
            $attrStr .= " meetTime = :meetTime";
            $attrAdded++;
            $meetTimeGiven = TRUE;
        }

        $endTime = $_POST["endTime"];
        $endTimeGiven = FALSE;
        if($endTimeName != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= ",";
            }
            $attrStr .= " endTime = :endTime";
            $attrAdded++;
            $endTimeGiven = TRUE;
        }

        $location = $_POST["location"];
        $locationGiven = FALSE;
        if($locationName != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= ",";
            }
            $attrStr .= " endTime = :endTime";
            $attrAdded++;
            $locationGiven = TRUE;
        }

        $semester = $_POST["semester"];
        if($semester != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= ",";
            }

            if($semester == "fall")
            {
                $attrStr .= " fallSemester = 1";
                $attrStr .= ", springSemester = 0";
            }
            else
            {
                $attrStr .= " springSemester = 1";
                $attrStr .= ", fallSemester = 0";
            }
            $attrAdded++;
        }

        $addStr = "";

        if($attrAdded != 0)
        {
            $addStr .= " WHERE ";
        }

        $addStr .= $attrStr.";";
        
        $querStmnt = "SELECT * FROM COURSE NATURAL JOIN ISMEETING".$addStr;

        $classes_query = $db->prepare($querStmnt);
        if($courseIDGiven == TRUE)
        {    
            $classes_query->bindParam(':courseID', $courseID);
        }
        if($deptIDGiven == TRUE)
        { 
            $classes_query->bindParam(':deptID', $courseName);
        }
        if($courseNameGiven == TRUE)
        {
            $classes_query->bindParam(':courseName', $courseName);
        }
        if($meetTime == TRUE)
        {
            $classes_query->bindParam(':meetTime', $meetTime);
        }
        if($endTime == TRUE)
        {
            $classes_query->bindParam(':endTime', $endTime);
        }
        if($location == TRUE)
        {
            $classes_query->bindParam(':location', $location);
        }

        $classes_query->execute();

        $query_result = $classes_query->fetchAll();

        $_SESSION["courAttrQuer"] = $query_result;

        $redirect_url = $_SESSION['redirect_url']; 
        unset($_SESSION['redirect_url']);
        header("Location: $redirect_url", true, 303);
        exit;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    ?>
</body>
</html>