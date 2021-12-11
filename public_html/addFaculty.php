<!DOCTYPE html>
<html>
    <body>
        <?php
            #session_start();
            //path to the SQLite database file
            $db_file = './myDB/uni.db';

            try {
                //open connection to the university database file
                $db = new PDO('sqlite:' . $db_file);

                //set errormode to use exceptions
                $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                //Set variables the info from the handler form
                $name = $_POST['facultyName'];
                $id = $_POST['facultyID'];
                $password = $_POST['facultyPassword'];
                $dept = $_POST['department'];

                //Securely hash the password
                $hashed_pass = hash('sha256', $password, false);

                $msg = "";
                $insert_query = "";


                session_start();

                //Use SQL prepare statements to avoid injection

                //SQL query to check if the facultyID already exists in the database
                $check_id_dup = $db->prepare("SELECT facultyID FROM Professor WHERE facultyID = :id;");
                    $check_id_dup->bindParam(':id', $id);

                //Add the faculty info to the DB
                $insert_prof = $db->prepare("INSERT INTO Professor VALUES (:id, :name, :dept);");
                    $insert_prof->bindParam(':id', $id);
                    $insert_prof->bindParam(':name', $name);
                    $insert_prof->bindParam(':dept', $dept);

                $insert_prof_login = $db->prepare("INSERT INTO professorLogin VALUES (:id, :username, :password);");
                    $insert_prof_login->bindParam(':id', $id);
                    $insert_prof_login->bindParam(':username', $username);
                    $insert_prof_login->bindParam(':password', $hashed_pass);


                //make sure the ID is just numbers
                $all_digits = preg_match("/[0-9]/", $id);
                if(!$all_digits){
                    $msg .= "Error 'studentID' must be numbers only";
                }

                //If the ID is just numbers
                if(strcmp("", $msg) == 0)
                {
                    //Execute SQL query to check if the facultyID already exists
                    $check_id_dup->execute();
                    $check_id_result = $check_id_dup->fetchAll();

                    //If it exists make them restart
                    if(count($check_id_result) > 0){
                        echo "FAILED LOGIN";
                        $msg .= "Error new faculty NOT created - not a unique facultyID";
                        $redirect_url = './addFacultyHandler.php?msg='.$msg;
                        header("Location: $redirect_url", true, 303);
                    }

                    //If it doesn't add them to the database
                    else{
                        $insert_prof->execute();
                        $insert_prof_login->execute();

                        echo "Sucess!";
                        $msg .= "Faculty account created!";
                        $redirect_url = './adminDashboard.php?msg='.$msg;
                        header("Location: $redirect_url", true, 303);
                    }
                }
                else
                {
                    //Non-number in the studentId section
                    $redirect_url = './addFacultyHandler.php?msg='.$msg;
                    header("Location: $redirect_url", true, 303);
                }
                $db = null;
            }
            catch(PDOException $e) {
                die('Exception : '.$e->getMessage());
            }
        ?>
    </body>
</html>
