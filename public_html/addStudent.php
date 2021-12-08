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

                $stu_name = $_POST['studentName'];
                $id = $_POST['studentID'];
                $gpa = $_POST['gpa'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $class = $_POST['class'];
                $major = $_POST['major'];

                $hashed_pass = hash('sha256', $password, false);

                $msg = "";
                $insert_query = "";


                session_start();

                $check_id_dup = $db->prepare("SELECT StudentID FROM Students WHERE studentID = :id;");
                    $check_id_dup->bindParam(':id', $id);

                $check_user_dup = $db->prepare("SELECT Username FROM StudentLogin WHERE username = :username;");
                    $check_user_dup->bindParam(':usernmae', $username);

                $insert_students = $db->prepare("INSERT INTO Students VALUES (:id, :name, :class, :gpa);");
                    $insert_students->bindParam(':id', $id);
                    $insert_students->bindParam(':name', $stu_name);
                    $insert_students->bindParam(':class', $gpa);
                    $insert_students->bindParam(':gpa', $gpa);

                $insert_student_login = $db->prepare("INSERT INTO StudentLogin VALUES (:id, :username, :password);");
                    $insert_students->bindParam(':id', $id);
                    $insert_students->bindParam(':username', $username);
                    $insert_students->bindParam(':password', $hashed_pass);

                /*
                $insert_query = $db->prepare("SELECT StudentID, Username FROM StudentLogin WHERE studentID = :user AND stuPassword = :pass;");
                    $insert_query->bindParam(':user', $id);
                    $insert_query->bindParam(':pass', $hashed_pass); */



                $all_digits = preg_match("/[0-9]/", $id);
                if(!$all_digits){
                    $msg .= "Error 'studentID' must be numbers only";
                }

                if(strcmp("", $msg) == 0)
                {
                    $check_id_dup->execute();
                    $check_id_result = $check_id_dup->fetchAll();

                    $check_user_dup->execute();
                    $check_user_result = $check_user_dup->fetchAll();


                    if(count($check_id_result) > 0){
                        echo "FAILED LOGIN";
                        $msg .= "Error - not a new studentID";
                        $redirect_url = './addStudentHandler.php?msg='.$msg;
                        header("Location: $redirect_url", true, 303);
                    }
                    if(count($check_user_result) > 0){
                        echo "FAILED LOGIN";
                        $msg .= "Error - not a new username";
                        $redirect_url = './addStudentHandler.php?msg='.$msg;
                        header("Location: $redirect_url", true, 303);
                    }

                    else{
                        $insert_students->execute();
                        $insert_student_login->execute();

                        echo "Sucess!";
                        $msg .= "Student account created!";
                        $redirect_url = './facultyDashboard.php';
                        header("Location: $redirect_url", true, 303);
                    }
                }
                else
                {
                    //Non-number in the studentId section
                    $redirect_url = './addStudentHandler.php?msg='.$msg;
                    #echo $which_button;
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
