<!DOCTYPE html>
<html>
<body>
    <?php

    $db_file = './uni.db';

    try {

        //open connection to the airport database file
        $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $meetDay = $_GET["meetDay"];
        $section = $_GET["section"];
        $courseID = $_GET["courseID"];

        $update_query = $db->prepare("SELECT * FROM COURSE NATURAL JOIN ISMEETING WHERE meetDay = :meetDay AND section = :section AND courseID = :courseID");
            $update_query->bindParam(':meetDay', $meetDay);
            $update_query->bindParam(':section', $section);
            $update_query->bindParam(':courseID', $courseID);
          
        $update_query->execute();
        
        $queryResult = $update_query->fetchAll();
        
        session_start();

        if(!isset($_SESSION["cart"]))
        {
            $_SESSION["cart"] = array();
        }

        array_push($_SESSION['cart'], $queryResult[0]);

        $db = null;

        // $redirect_url = $_SESSION['redirect_url']; 
        // unset($_SESSION['redirect_url']);
        // header("Location: $redirect_url", true, 303);
        // exit;
        
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    
    
    ?>

</body>
</html>