<!DOCTYPE html>
<html>
<body>
    <?php
    session_start();
    //path to the SQLite database file
    $db_file = './myDB/uni.db';

    try {
        if(isset($_SESSION["cart"]) and count($_SESSION["cart"]) != 0)
        {

        //open connection to the airport database file
        $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach($_SESSION['cart'] as $tuple)
        {
            $update_query = $db->prepare("INSERT INTO ENROLL VALUES (:id, :courseID);");
                $update_query->bindParam(':id', $_SESSION['sID']);
                $update_query->bindParam(':courseID', $tuple['courseID']);
          
            $update_query->execute();
        }   
        
        }

        $db = null;

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
