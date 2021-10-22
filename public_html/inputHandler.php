<!DOCTYPE html>
<html>
<body>
    <?php
    session_start();
    //path to the SQLite database file
    $db_file = './myDB/airport.db';
    ##require './htmlForm.php';

    ////print_r($GLOBALS);

    try {

        //open connection to the airport database file
        $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        

        
        $update_query = $db->prepare("UPDATE passengers SET f_name = :f_name, m_name = :m_name, l_name = :l_name, ssn = :ssn 
        WHERE ssn = :old_ssn AND :ssn GLOB '[0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9][0-9][0-9]';");
            $update_query->bindParam(':f_name', $new_f_name);
            $update_query->bindParam(':m_name', $new_m_name);
            $update_query->bindParam(':l_name', $new_l_name);
            $update_query->bindParam(':ssn', $new_ssn);
            //$update_query->bindParam('f_name', $f_name);
            //$update_query->bindParam('m_name', $m_name);
            //$update_query->bindParam('l_name', $l_name);
            $update_query->bindParam(':old_ssn', $old_ssn);
        
        
        $new_f_name = $_POST["fName"];
        $new_m_name = $_POST["mName"];
        $new_l_name = $_POST["lName"];
        $new_ssn = $_POST["ssn"];

        //$f_name = $_SESSION["oldFName"];
        //$m_name = $_SESSION["oldMName"];
        //$l_name = $_SESSION["oldLName"];
        $old_ssn = $_SESSION["oldSsn"];
       
        try
        {$update_query->execute();}
        catch (PDOException $e){
            console.log('failure');
        }
        //echo "executed<br>";
        
        
        //$update_query = "UPDATE passengers SET f_name = '$new_f_name', m_name = '$new_m_name', l_name = '$new_l_name', ssn = '$new_ssn' WHERE ssn = '$old_ssn';";

        //$update_status = $db->query($update_query);

        // Check status of update
        /*
        if($update_status)
        {
            echo "success! at updating SSN = $old_ssn<br>";
        }
        else
        {
            echo "fail!";
        } 
        */

        //disconnect from db
        $db = null;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }

    session_destroy();
    ?>

    <meta http-equiv="refresh" content="0; url=./showPassengers.php"/>
    <a href="./showPassengers.php">If you are not redirected, click here</a>
</body>
</html>
