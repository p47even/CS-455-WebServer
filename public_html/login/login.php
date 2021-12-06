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

                $username = $_POST['username'];
                $password = $_POST['password'];





                #echo $username;
                #echo $password;

                $msg = "";
                $update_query = "";


                $update_query = $db->prepare("SELECT StudentID, Username FROM StudentLogIn WHERE Username = :user AND StuPassword = :pass;");
                    $update_query->bindParam(':user', $username);
                    $update_query->bindParam(':pass', $password);




                $all_digits = preg_match("/[0-9]/", $username);
                if(!$all_digits){
                    $msg .= "Error 'studentID' must be numbers only";
                }

                if(strcmp("", $msg) == 0)
                {
                    $update_query->execute();
                    $query_result = $update_query->fetchAll();
                    print_r($query_result);
                    $update_query->debugDumpParams();
                    #echo $update_query;
                }
                else
                {
                    #print_r($_POST);
                    #echo $username;
                    #echo $all_digits;
                    $redirect_url = '../project.php?msg='.$msg;
                    header("Location: $redirect_url", true, 303); #uncomment out for the redirect

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
