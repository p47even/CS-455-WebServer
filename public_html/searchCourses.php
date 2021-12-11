<!DOCTYPE html>
<html>
<body>
    <?php
    session_start();

    // If the user is not logged in as a student, redirect to login page
    if(!isset($_SESSION["sID"]))
            { 
                $loginUrl = 'project.php?msg=Please Login First';
                header("Location: $loginUrl", true, 303);
                exit; 
            }


    //path to the SQLite database file
    $db_file = './myDB/uni.db';

    try {

        //open connection to the database file
        $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Keep track of the attributes specified by the user and also if any have been added so we know if we can prepend a " and " to our attribute specification
        $attrStr = "";
        $attrAdded = 0;
        
        
        /////See if we are given specifics for any attributes, if not we do not need to include it in our query string//////

        $courseID = $_POST["courseID"];
        $courseIDGiven = FALSE;
        if($courseID != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= " and";
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
                $attrStr .= " and";
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
                $attrStr .= " and";
            }
            $attrStr .= " courseName = :courseName";
            $attrAdded++;
            $courseNameGiven = TRUE;
        }

        $meetTime = $_POST["meetTime"];
        $meetTimeGiven = FALSE;
        if($meetTime != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= " and";
            }
            $attrStr .= " meetTime = :meetTime";
            $attrAdded++;
            $meetTimeGiven = TRUE;
        }

        $endTime = $_POST["endTime"];
        $endTimeGiven = FALSE;
        if($endTime != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= " and";
            }
            $attrStr .= " endTime = :endTime";
            $attrAdded++;
            $endTimeGiven = TRUE;
        }

        $location = $_POST["location"];
        $locationGiven = FALSE;
        if($location != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= " and";
            }
            $attrStr .= " location = :location";
            $attrAdded++;
            $locationGiven = TRUE;
        }

        $semester = $_POST["semester"];
        if($semester != "")
        {
            if($attrAdded != 0)
            {
                $attrStr .= " and";
            }

            if($semester == "fall")
            {
                $attrStr .= " fallSemester = 1";
                $attrStr .= " and springSemester = 0";
            }
            else
            {
                $attrStr .= " springSemester = 1";
                $attrStr .= " and fallSemester = 0";
            }
            $attrAdded++;
        }

        $addStr = "";


        // If we are specifying attributes we need the where statement
        if($attrAdded != 0)
        {
            $addStr .= " WHERE ";
        }

        $addStr .= $attrStr.";";

        // Construct the query statement
        $querStmnt = "SELECT * FROM COURSE NATURAL JOIN ISMEETING".$addStr;

        // Prepare the query statement and insert attribute values if necissary
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
        if($meetTimeGiven == TRUE)
        {
            $classes_query->bindParam(':meetTime', $meetTime);
        }
        if($endTimeGiven == TRUE)
        {
            $classes_query->bindParam(':endTime', $endTime);
        }
        if($locationGiven == TRUE)
        {
            $classes_query->bindParam(':location', $location);
        }

        // Execute the query
        $classes_query->execute();

        // Fetch results and store in session for use elswhere
        $query_result = $classes_query->fetchAll();

        $_SESSION["courEnrolQuer"] = $query_result;

        // Redirect to where we came from
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
