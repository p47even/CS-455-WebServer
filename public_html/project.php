<!DOCTYPE html>
<html>
        <head>
                <title>Enrollment Planner!</title>
                <link rel="stylesheet" href="projectStyling.css"/>
        </head>

        <body>
            <h1>Enrollment Planner Login!</h1>
                <div class='main'>
                    <div class='studentLogin'>
                        <h2>Student Login!</h2>

                        <form action='./login/login.php' method='post'>
                        StudentID: <input type='text' name='username' id='username'><br>

                        <form action='./login/login.php' method='post'>
                        Password: <input type='password' name='password' id='password'><br>

                        <input type='submit' name='stu_submit' value='stu_Login'>

                    </div>

                    <div class='adminLogin'>
                        <h2>Admin Login!</h2>

                        <form action='./login/adminLogin.php/' method='post'>
                        AdminID: <input type='text' name='admin_username' id='admin_username'><br>

                        <form action='./login/adminLogin.php' method='post'>
                        Password: <input type='password' name='admin_password' id='admin_password'><br>
                        <input type='submit' name='admin_submit' value='admin_Login'>
                    </div>
                </div>

                <?php
                    $error_message = $_GET["msg"];

                    if(strlen($error_message) >= 0){
                        echo $error_message;

                    }
                ?>
        </body>
</html>
