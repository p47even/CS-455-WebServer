<!DOCTYPE html>
<html>
<body>
    <?php
    session_start();
    //path to the SQLite database file
    $db_file = './myDB/airport.db';

    try {

        //open connection to the airport database file
        $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $msg = "";
        $update_query = "";

        if(strcmp($_SESSION["oldSsn"], '') == 0)
        {
            $select_res = $db->query("SELECT ssn FROM passengers WHERE ssn = '$new_ssn';";
            if($select_res->fetchColumn() > 0)
            {
                $msg = "SSN already exists<br>";
            }
            else
            {
                $msg = "Added new passenger<br>";
                $db->query("INSERT INTO passengers VALUES (f_name = :f_name, m_name = :m_name, l_name = :l_name, ssn = :ssn);");
                    $update_query->bindParam(':f_name', $new_f_name);
                    $update_query->bindParam(':m_name', $new_m_name);
                    $update_query->bindParam(':l_name', $new_l_name);
                    $update_query->bindParam(':ssn', $new_ssn);
            }
        }
        else
        {
            $update_query = $db->prepare("UPDATE passengers SET f_name = :f_name, m_name = :m_name, l_name = :l_name, ssn = :ssn 
            WHERE ssn = :old_ssn;");
                $update_query->bindParam(':f_name', $new_f_name);
                $update_query->bindParam(':m_name', $new_m_name);
                $update_query->bindParam(':l_name', $new_l_name);
                $update_query->bindParam(':ssn', $new_ssn);
                $update_query->bindParam(':old_ssn', $old_ssn);
        }

        $new_f_name = $_POST["fName"];
        $new_m_name = $_POST["mName"];
        $new_l_name = $_POST["lName"];
        $new_ssn = $_POST["ssn"];

        $old_ssn = $_SESSION["oldSsn"];

        if(!preg_match("/^[a-zA-Z]+$/", $new_f_name))
        {
            $msg .= "First name must be non-empty and consist of letters only<br>";
        }

        if(!preg_match("/^[a-zA-Z]$/", $new_m_name) && (strcmp("", $new_m_name) != 0))
        {
            $msg .= "Middle name must be empty or a single letter<br>";
        }

        if(!preg_match("/^[a-zA-Z]+$/", $new_l_name))
        {
            $msg .= "Last name must be non-empty and consist of letters only<br>";
        }
        
        if(!preg_match("/^[0-9][0-9][0-9]-[0-9][0-9]-[0-9][0-9][0-9][0-9]$/", $new_ssn))
        {
            $msg .= "SSN must be in the form xxx-xx-xxxx where x is a whole number between 0 and 9<br>";
        }

        if(strcmp("", $msg) == 0)
        {
            $result_status = $update_query->execute();
            $msg .= "Success!";
        }
        
        $db = null;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }

    //echo "<meta http-equiv='refresh' content='0; url=./showPassengers.php?msg=$msg'/>";
    echo "<a href='./showPassengers.php?msg=$msg'>If you are not redirected, click here</a>";

    session_destroy();
    ?>
</body>
</html>
