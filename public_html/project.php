<!DOCTYPE html>
<html>
        <head>
                <title>Enrollment Planner!</title>
                <link rel="stylesheet" href="projectStyling.css"/>
        </head>

        <body>
            <h1>Enrollment Planner Login!</h1>
                <div class='main'>

                        <h2>Student Login!</h2>

                        <form action='./login/login.php' method='post'>
                        StudentID: <input type='text' name='username' id='username'><br>

                        <form action='./login/login.php' method='post'>
                        Password: <input type='password' name='password' id='password'><br>

                        <input type='submit' name='submit' value='Student Login' id='submit'>


                </div>

                <h3>Not a Student?</h3>
                    <p>
                        <a href="./fProject.php">Faculty Login Here!</a>
                    </p>


                <?php
                    $error_message = $_GET["msg"];

                    if(strlen($error_message) >= 0){
                        echo $error_message;

                    }
                ?>
        </body>
</html>
