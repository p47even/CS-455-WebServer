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

        $update_query = $db->prepare("SELECT * FROM COURSE NATURAL JOIN ISMEETING WHERE meetDay = :meetDay AND section = :section AND courseID = :courseID);
            $update_query->bindParam(':meetDay', $_POST['meetDay']);
            $update_query->bindParam(':section', $_POST['section']);
            $update_query->bindParam(':courseID', $_POST['courseID']);
          
        $update_query->execute();
        

        array_push($_SESSION['cart'], $update_query->fetchAll()[0]);

        $redirect_url = $_SESSION['redirect_url']; 
        unset($_SESSION['redirect_url']);
        header("Location: $redirect_url", true, 303);
        exit;
        
        $db = null;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    
    
    ?>
</body>
</html>