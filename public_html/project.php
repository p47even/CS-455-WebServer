<!DOCTYPE html>
<html>
        <head>
                <title>Enrollment Planner!</title>
                <link rel="stylesheet" href="projectStyling.css"/>
        </head>

        <body>
                <div class='page'>
                        <div class='menu'>Menu</div>
                        <div class='sidebar'>Sidebar</div>
                        <div class='content'>Content</div>
                        <div class='footer'>Footer</div>
                </div>
                
                <h1>Enrollment Planner Login!</h1>
                
                <?php
                echo
                "<form action='./login/login.php' method='post'>
                Username: <input type='text' name='username' id='username'><br>
                <form action='./login/login.php' method='post'>
                Password: <input type='text' name='password' id='password'><br>
              
                <input type='submit' name='submit' value='Student Login'>"
                ;
                
                ?>
        </body>
</html>
