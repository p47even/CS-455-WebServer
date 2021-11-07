<!DOCTYPE html>
<html>
        <head>
                <title>Enrollment Planner!</title>
                <link rel="stylesheet" href="projectStyling.css"/>
        </head>

        <body>
                <h1>Enrollment Planner Login!</h1>
                
                <?php
                echo
                "<form action='./login/login.php' method='post'>
                Username: <input type='text' name='username' id='username'><br>
              
                <input type='submit' name='submit' value='Update Info'>"
                ;
                
                ?>
        </body>
</html>
