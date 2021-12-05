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
        
        session_start();
        
        $meetDay = $_POST['meetDay'];
        $section = $_POST['section'];
        $courseID = $_POST['courseID'];

        echo $meetDay." ";
        echo $section." ";
        echo $courseID." ";

        $update_query = $db->prepare("SELECT * FROM COURSE NATURAL JOIN ISMEETING WHERE meetDay = :meetDay AND section = :section AND courseID = :courseID");
            $update_query->bindParam(':meetDay', $meetDay);
            $update_query->bindParam(':section', $section);
            $update_query->bindParam(':courseID', $courseID);
          
        $update_query->execute();
        
        $queryResult = $update_query->fetchAll();

        echo $queryResult[0];

        if(!isset($_SESSION["cart"]))
        {
            $_SESSION["cart"] = [];
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