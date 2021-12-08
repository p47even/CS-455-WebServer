<!DOCTYPE html>
<html>
    <body>
        <?php


            $username = $_POST['username'];
            $password = $_POST['password'];

            $hashed_pass = hash('sha256', $password, false);

            $msg = "";
            $update_query = "";


            session_start();


            $users_equal = ($username == "admin");
            $passwords_equal = ($hashed_pass == "d74ff0ee8da3b9806b18c877dbf29bbde50b5bd8e4dad7a3a725000feb82e8f1");
            if($users_equal and $passwords_equal){
                echo "LOGIN SUCCESFUL";
                $_SESSION["aID"] = $username;
                $redirect_url = '../adminDashboard.php';
                header("Location: $redirect_url", true, 303);
            }
            else{
                echo "FAILED LOGIN!";
                $msg .= "Incorrect adminID or password!";
                $redirect_url = '../aProject.php?msg='.$msg;
                header("Location: $redirect_url", true, 303);
            }


        ?>
    </body>
</html>
