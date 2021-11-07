<!DOCTYPE html>
<html>
        <head>
                <title>Enrollment Planner!</title>
                <link rel="stylesheet" href="projectStyling.css"/>
        </head>

        <body>
                <div class='page'>
                        <div class='menu'>
                                <h1>Enrollment Planner Login!</h1>
                        </div>
                        <div class='sidebar'>
                                <?php
                                        echo
                                        "<form action='./login/login.php' method='post'>
                                        Username: <input type='text' name='username' id='username'><br>
                                        <form action='./login/login.php' method='post'>
                                        Password: <input type='text' name='password' id='password'><br>
              
                                        <input type='submit' name='submit' value='Student Login'>"
                                        ;
                                ?>
                        </div>
                        
                        <div class='content'>
                                <?php
                                        echo
                                        "<form action='./login/login.php' method='post'>
                                        Username: <input type='text' name='username' id='username'><br>
                                        <form action='./login/login.php' method='post'>
                                        Password: <input type='text' name='password' id='password'><br>
              
                                        <input type='submit' name='submit' value='Admin Login'>"
                                        ;
                                ?>
                        </div>
                        
                        <div class='footer'>Footer</div>
                </div>
                
                
                
        </body>
</html>
