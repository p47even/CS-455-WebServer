<!DOCTYPE html>
<html>
    <body>
        <?php
            session_start();
            //path to the SQLite database file
            $db_file = '../myDB/uni.db';

            try {

                //open connection to the university database file
                $db = new PDO('sqlite:' . $db_file);

                //set errormode to use exceptions
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $username = $_POST["username"];
                $password = $_POST["password"];





                #echo $username;
                #echo $password;

                $msg = "";
                $update_query = "";


                $update_query = $db->prepare("SELECT StudentID, Username FROM StudentLogIn WHERE Username = :user AND StuPassword = :pass;");
                    $update_query->bindParam(':user', $username);
                    $update_query->bindParam(':pass', $password);


                /*
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
                } */

                $all_digits = ctype_digit($username);
                echo $all_digits;
                if(!$all_digits){
                    $msg .= "Error 'studentID' must be numbers only";
                }

                if(strcmp("", $msg) == 0)
                {
                    $update_query->execute();
                    $query_result = $update_query->fetchAll();
                    echo $query_result;
                    #//echo "<meta http-equiv='refresh' content='0; url=./showPassengers.php?msg=Success!'/>";
                }
                else
                {
                    //echo $msg;
                    $redirect_url = '../../project.php?msg='.$msg;
                    #header("Location: $redirect_url", true, 303); #uncomment out for the redirect

                }

                $db = null;
            }
            catch(PDOException $e) {
                die('Exception : '.$e->getMessage());
            }

            session_destroy();
        ?>
    </body>
</html>
