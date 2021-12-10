<!DOCTYPE html>
<html>
<body>
    <?php
    session_start();

    if(!isset($_SESSION["sID"]))
            { 
                $loginUrl = 'project.php?msg=Please Login First';
                header("Location: $loginUrl", true, 303);
                exit; 
            }
            
            $_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];

    //path to the SQLite database file
    $db_file = './myDB/uni.db';

    try {
        if(isset($_SESSION["cart"]) and count($_SESSION["cart"]) != 0)
        {
        $msg = "";
        //open connection to the airport database file
        $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        foreach($_SESSION['cart'] as $tuple)
        {
            $search_query = $db->prepare("SELECT * FROM ENROLL WHERE studentID = :id and courseID = :courseID");
                $search_query->bindParam(':id', $_SESSION['sID']);
                $search_query->bindParam(':courseID', $tuple['courseID']);
                $search_query->execute();

            if($search_query->fetchColumn() == 0)
            {
                $update_query = $db->prepare("INSERT INTO ENROLL VALUES (:id, :courseID);");
                    $update_query->bindParam(':id', $_SESSION['sID']);
                    $update_query->bindParam(':courseID', $tuple['courseID']);
          
                $update_query->execute();

                $msg = "Enrollment Success!";
            }
            else
            {
                $msg = "FAILED TO ADD....... DUPLICATE CLASSES CANNOT BE ADDED";
            }
        }   
        
        }

        $db = null;

        $_SESSION['cart'] = array(); 

        $redirect_url = $_SESSION['redirect_url']."?msg=".$msg; 
        unset($_SESSION['redirect_url']);
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
