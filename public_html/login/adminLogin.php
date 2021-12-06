<?php
    session_start();
?>
<!DOCTYPE html>
<html>
    <body>
        <?php
            #session_start();
            //path to the SQLite database file
            $db_file = '../myDB/uni.db';

            try {
                //open connection to the university database file
                $db = new PDO('sqlite:' . $db_file);

                //set errormode to use exceptions
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $username = $_POST['admin_username'];
                $password = $_POST['admin_password'];

                $hashed_pass = hash('sha256', $password, false);

                $msg = "";
                $update_query = "";


                $update_query = $db->prepare("SELECT facultyID, facPassword FROM professorLogin WHERE facultyID = :user AND facPassword = :pass;");
                    $update_query->bindParam(':user', $username);
                    $update_query->bindParam(':pass', $password);
                    #$update_query->bindParam(':pass', $hashed_pass);

                $all_digits = preg_match("/[0-9]/", $username);
                if(!$all_digits){
                    $msg .= "Error 'facultyID' must be numbers only";
                }

                if(strcmp("", $msg) == 0)
                {
                    $update_query->execute();
                    $query_result = $update_query->fetchAll();
                    print_r($query_result);
                    if(count($query_result) == 1){
                        echo "LOGIN SUCCESFUL";
                        $_SESSION["fID"] = $username;
                        $redirect_url = '../facultyDashboard.php';
                        header("Location: $redirect_url", true, 303);
                    }
                    else{
                        echo "FAILED LOGIN!";
                        $msg .= "Incorrect facultyID or password!";
                        $redirect_url = '../fProject.php?msg='.$msg;
                        header("Location: $redirect_url", true, 303);
                    }
                }
                else
                {
                    //Non-number in the facultyID section
                    $redirect_url = '../fProject.php?msg='.$msg;
                    header("Location: $redirect_url", true, 303);

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
