<!DOCTYPE html>
<html>
    <!-- Admin login screen -->
        <head>
                <title>Enrollment Planner!</title>
                <link rel="stylesheet" href="projectStyling.css"/>
        </head>

        <body>
            <h1>Enrollment Planner Login!</h1>
                <div class='main'>
                    <!-- Form to check login cridentials (id and password)-->
                    <!-- Sent to super_login.php w/ _POST -->
                        <h2>Administrator Login!</h2>

                        <form action='./login/super_login.php' method='post'>
                        StudentID: <input type='text' name='username' id='username'><br>

                        <form action='./login/super_login.php' method='post'>
                        Password: <input type='password' name='password' id='password'><br>

                        <input type='submit' name='submit' value='Login'><br><br><br>


                </div>

                <?php
                    $error_message = $_GET["msg"];

                    if(strlen($error_message) >= 0){
                        echo $error_message;

                    }
                ?>

                <h3>Not an Admin?</h3>
                    <p>
                        <a href="./fProject.php?msg=">Faculty Login Here!</a><br>
                        <a href="./project.php?msg=">Student Login Here!</a>
                    </p>
                    <img src = "./sugedpount.jpg" alt = "Welcome!" class = "center" style = "width:325px; height: 325px;">


        </body>
</html>
