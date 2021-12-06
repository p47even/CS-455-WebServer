<!DOCTYPE html>
<html>
        <head>
                <title>Enrollment Planner!</title>
                <link rel="stylesheet" href="projectStyling.css"/>
        </head>

        <body>
            <h1>Enrollment Planner Login!</h1>
                <div class='main'>
                        <h2>Admin Login!</h2>

                        <form action='./login/adminLogin.php/' method='post'>
                        AdminID: <input type='text' name='admin_username' id='admin_username'><br>

                        <form action='./login/adminLogin.php' method='post'>
                        Password: <input type='password' name='admin_password' id='admin_password'><br>

                        <input type='submit' name='submit' value='Login'><br>
                </div>

                <h3>Not Faculty?</h3>
                    <p>
                        <a href="./project.php?msg=">Student Login Here!</a>
                    </p>

                <?php
                    $error_message = $_GET["msg"];

                    if(strlen($error_message) >= 0){
                        echo $error_message;

                    }
                ?>
        </body>
</html>
