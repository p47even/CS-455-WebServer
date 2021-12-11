<!DOCTYPE html>
<html>
<body>
    <?php

        //open connection to the airport database file
        // $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

        // //set errormode to use exceptions
        // $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $index = $_GET["index"];
        // $meetDay = $_GET["meetDay"];
        // $section = $_GET["section"];
        // $courseID = $_GET["courseID"];

        // $update_query = $db->prepare("SELECT * FROM COURSE NATURAL JOIN ISMEETING WHERE meetDay = :meetDay AND section = :section AND courseID = :courseID");
        //     $update_query->bindParam(':meetDay', $meetDay);
        //     $update_query->bindParam(':section', $section);
        //     $update_query->bindParam(':courseID', $courseID);
          
        // $update_query->execute();
        
        // $queryResult = $update_query->fetchAll();
        
        session_start();


        if(!isset($_SESSION["sID"]))
            { 
                $loginUrl = 'project.php?msg=Please Login First';
                header("Location: $loginUrl", true, 303);
                exit; 
            }

        if(!isset($_SESSION["cart"]))
        {
            $_SESSION["cart"] = array();
        }

        if(!in_array($_SESSION['courEnrolQuer'][(int) $index], $_SESSION['cart']))
        {
            array_push($_SESSION['cart'], $_SESSION['courEnrolQuer'][(int) $index]);
        }

        $redirect_url = $_SESSION['redirect_url']."?msg="; 
        unset($_SESSION['redirect_url']);
        header("Location: $redirect_url", true, 303);
        exit;
        
    ?>

</body>
</html>