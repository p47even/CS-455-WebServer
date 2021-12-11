<?php

session_start();

if(!isset($_SESSION["sID"]))
            { 
                //$loginUrl = 'project.php?msg=Please Login First';
                //header("Location: $loginUrl", true, 303);
                header("Location: enroll.php", true, 303);
                exit; 
            }
            
            //$_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];


//path to the SQLite database file
$db_file = './myDB/uni.db';


try 
{
    //open connection to the airport database file
    $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

    //set errormode to use exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $attrStr = "";

    $courseID = $_POST["courseID"];
    $courseIDGiven = FALSE;
    if($courseID != "")
    {
        $attrStr .= " and courseID = :courseID";
        $courseIDGiven = TRUE;
    }

    $deptID = $_POST["deptID"];
    $deptIDGiven = FALSE;
    if($deptID != "")
    {
        $attrStr .= " and deptID = :deptID";
        $deptIDGiven = TRUE;
    }

    $courseName = $_POST["courseName"];
    $courseNameGiven = FALSE;
    if($courseName != "")
    {
        $attrStr .= " and courseName = :courseName";
        $courseNameGiven = TRUE;
    }

    $meetTime = $_POST["meetTime"];
    $meetTimeGiven = FALSE;
    if($meetTime != "")
    {
        $attrStr .= " and meetTime = :meetTime";
        $meetTimeGiven = TRUE;
    }

    $endTime = $_POST["endTime"];
    $endTimeGiven = FALSE;
    if($endTime != "")
    {
        $attrStr .= " and endTime = :endTime";
        $endTimeGiven = TRUE;
    }

    $location = $_POST["location"];
    $locationGiven = FALSE;
    if($location != "")
    {
        $attrStr .= " and location = :location";
        $locationGiven = TRUE;
    }

    $semester = $_POST["semester"];
    if($semester != "")
    {
        if($semester == "fall")
        {
            $attrStr .= " and fallSemester = 1";
            $attrStr .= " and springSemester = 0";
        }
        else
        {
            $attrStr .= " and springSemester = 1";
            $attrStr .= " and fallSemester = 0";
        }
    }

    $attrStr .= ";";


    $mega_query = ("with tmp as (select courseID from Enroll where studentID = :sID),
    tmp2 as (select distinct courseID from Requirements where requirementID in tmp),
    tmp3 as (select courseID from tmp2 union select courseID from Requirements natural join Course where requirementID in tmp2), --all parents of currently enrolled courses
    tmp4 as (select courseID from Course where courseID not in tmp3 and courseID not in tmp), --all other courses
    tmp5 as (select requirementID as courseID from tmp natural join Requirements), --all children of currently enrolled classes
    tmp6 as (select distinct requirementID as courseID from tmp5 natural join Requirements), --all children of tmp5
    tmp7 as (select * from Course natural join ClassRequirements),
    tmp8 as (select courseID from tmp7 where class not in (select class from Students where studentID = :sID)), --all classes that do not fulfull class requirement 
    tmp9 as (select * from tmp8 union select * from tmp6 union select * from tmp5 union select * from tmp3 union select * from tmp group by courseID)
    select * from Course NATURAL JOIN ISMEETING where courseID not in tmp9".$attrStr);

    $classes_query = $db->prepare($mega_query);
    $classes_query->bindParam(':sID', $_SESSION["sID"]);
    if($courseIDGiven == TRUE)
    {    
        $classes_query->bindParam(':courseID', $courseID);
    }
    if($deptIDGiven == TRUE)
    { 
        $classes_query->bindParam(':deptID', $deptID);
    }
    if($courseNameGiven == TRUE)
    {
        $classes_query->bindParam(':courseName', $courseName);
    }
    if($meetTimeGiven == TRUE)
    {
        echo $meetTime;
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

    $classes_query->execute();

    $query_result = $classes_query->fetchAll();

    $_SESSION["courEnrolQuer"] = $query_result;

    $redirect_url = $_SESSION['redirect_url']."?msg="; 
    unset($_SESSION['redirect_url']);
    header("Location: $redirect_url", true, 303);
    exit;
}
catch(PDOException $e) {
    die('Exception : '.$e->getMessage());
}
?>
