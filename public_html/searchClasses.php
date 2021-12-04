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
            if($attrAdded == 0)
            {
                $attrStr .= ",";
            }
            $attrStr .= " courseID = :courseID";
            $attrAdded++;
        }

        $deptID = $_POST["deptID"];
        $deptIDGiven = FALSE;
        if($deptID != "")
        {
            if($attrAdded == 0)
            {
                $attrStr .= ",";
            }
            $attrStr .= " deptID = :deptID";
            $attrAdded++;
        }

        $courseName = $_POST["courseName"];
        $courseNameGiven = FALSE;
        if($courseName != "")
        {
            if($attrAdded == 0)
            {
                $attrStr .= ",";
            }
            $attrStr .= " courseName = :courseName";
            $attrAdded++;
        }

        $fallSemester = $_POST["fallSemester"];
        $fallSemesterGiven = FALSE;
        if($fallSemester != "")
        {
            if($attrAdded == 0)
            {
                $attrStr .= ",";
            }
            $attrStr .= " fallSemester = :fallSemester";
            $attrAdded++;
        }

        $springSemester = $_POST["springSemester"];
        $springSemesterGiven = FALSE;
        if($springSemester != "")
        {
            if($attrAdded == 0)
            {
                $attrStr .= ",";
            }
            $attrStr .= " springSemester = :springSemester";
            $attrAdded++;
        }

        $addStr = "";

        if($attrAdded != 0)
        {
            $addStr .= " WHERE ";
        }

        $addStr .= $attrStr.";";
        
        $classes_query = $db->prepare("SELECT * FROM COURSE".$addStr);
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
        if($fallSemesterGiven == TRUE)
        {
            $classes_query->bindParam(':fallSemester', $fallSemester);
        }
        if($springSemesterGiven == TRUE)
        {
            $classes_query->bindParam(':springSemester', $springSemester);
        }
        
        $query_result = $classes_query->execute();
        

        //$query_str = "SELECT * FROM COURSE WHERE courseID = *, deptID = :deptID, courseName = *, fallSemester = *, springSemester = *";

        //$query_result = $db->query($query_str);

        $_SESSION["courAttrQuer"] = $query_result;

        echo $query_result;

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