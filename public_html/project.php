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
                        <input type='submit' name='submit' value='Login'>
                    </div>

                    <div class='adminLogin'>
                        <h2>Admin Login!</h2>
                        <form action='./login/adminLogin.php' method='post'>
                        AdminID: <input type='text' name='username' id='username'><br>
                        <form action='./login/adminLogin.php' method='post'>
                        Password: <input type='text' name='password' id='password'><br>
                        <input type='submit' name='submit' value='Login'>
                    </div>
                </div>
        </body>
</html>
