<!DOCTYPE html>
<html>
<body>
    <?php
    session_start();

    // If not signed in to student account, redirect to login page
    if(!isset($_SESSION["sID"]))
            { 
                $loginUrl = 'project.php?msg=Please Login First';
                header("Location: $loginUrl", true, 303);
                exit; 
            }

    //path to the SQLite database file
    $db_file = './myDB/uni.db';

    try {
        // If there are things to enroll in, enroll in them
        if(isset($_SESSION["cart"]) and count($_SESSION["cart"]) != 0)
        {
        $msg = "";
        //open connection to the database file
        $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Create insert queries for each cart item
        foreach($_SESSION['cart'] as $tuple)
        {
            // Make sure there are no already existing classes being added
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

        // Return to whence it came
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
