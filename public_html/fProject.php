<!DOCTYPE html>
<html>
        <head>
                <title>Enrollment Planner!</title>
                <link rel="stylesheet" href="projectStyling.css"/>
        </head>

        <body>
            <h1>Enrollment Planner Login!</h1>
                <div class='main'>
                        <h2>Faculty Login!</h2>

                        <form action='./login/adminLogin.php/' method='post'>
                        facultyID: <input type='text' name='admin_username' id='admin_username'><br>

                        <form action='./login/adminLogin.php' method='post'>
                        Password: <input type='password' name='admin_password' id='admin_password'><br>

                        <input type='submit' name='submit' value='Login'><br><br><br>
                </div>

                <?php
                    $error_message = $_GET["msg"];

                    if(strlen($error_message) >= 0){
                        echo $error_message;

                    }
                ?>

                <h3>Not Faculty?</h3>
                    <p>
                        <a href="./project.php?msg=">Student Login Here!</a><br>
                        <a href="./aProject.php?msg=">Admin Login Here!</a>
                    </p>


        </body>
</html>
