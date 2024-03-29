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
                $name = $_POST['studentName'];
                $id = $_POST['studentID'];
                $gpa = $_POST['gpa'];
                $username = $_POST['username'];
                $password = $_POST['password'];
                $class = $_POST['class'];
                $major = $_POST['major'];

                //Securely hash the password
                $hashed_pass = hash('sha256', $password, false);

                $msg = "";
                $insert_query = "";


                session_start();

                //Use SQL prepare statements to avoid injection

                //SQL query to check if the facultyID or username already exists in the database
                $check_id_dup = $db->prepare("SELECT StudentID FROM Students WHERE studentID = :id;");
                    $check_id_dup->bindParam(':id', $id);

                $check_user_dup = $db->prepare("SELECT Username FROM StudentLogin WHERE username = :username;");
                    $check_user_dup->bindParam(':username', $username);


                //Add the student info to the DB
                $insert_students = $db->prepare("INSERT INTO Students VALUES (:id, :name, :class, :gpa);");
                    $insert_students->bindParam(':id', $id);
                    $insert_students->bindParam(':name', $name);
                    $insert_students->bindParam(':class', $class);
                    $insert_students->bindParam(':gpa', $gpa);

                $insert_student_login = $db->prepare("INSERT INTO StudentLogin VALUES (:id, :username, :password);");
                    $insert_student_login->bindParam(':id', $id);
                    $insert_student_login->bindParam(':username', $username);
                    $insert_student_login->bindParam(':password', $hashed_pass);

                $insert_student_major = $db->prepare("INSERT INTO Major VALUES (:id, :major);");
                    $insert_student_major->bindParam(':id', $id);
                    $insert_student_major->bindParam(':major', $major);


                //make sure the ID is just numbers
                $all_digits = preg_match("/[0-9]/", $id);
                if(!$all_digits){
                    $msg .= "Error 'studentID' must be numbers only";
                }

                //If the ID is just numbers
                if(strcmp("", $msg) == 0)
                {
                    //Execute SQL query to check if the studentID or username already exists
                    $check_id_dup->execute();
                    $check_id_result = $check_id_dup->fetchAll();

                    $check_user_dup->execute();
                    $check_user_result = $check_user_dup->fetchAll();


                    //If either id or username already exist make them restart
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
                    //If both are unique add them to the database
                    else{
                        $insert_students->execute();
                        $insert_student_login->execute();
                        $insert_student_major->execute();

                        echo "Sucess!";
                        $msg .= "Student account created!";
                        $redirect_url = './facultyDashboard.php?msg='.$msg;
                        header("Location: $redirect_url", true, 303);
                    }
                }
                else
                {
                    //Non-number in the studentId section
                    $redirect_url = './addStudentHandler.php?msg='.$msg;
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
