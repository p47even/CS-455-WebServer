<!DOCTYPE html>
<html>
        <head>
                <title>Welcome Student!</title>
                <link rel="stylesheet" href="dashboard.css"/>

                <style>
        .toolbar{
            background-color: maroon;
        }
        .toolbar a:hover{
            background-color:white;
            color: black
        }

        .toolbar a{
            padding: 15px 15px;
            color: white;
            font-size: 20px;
            text-decoration: none;
        }
        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
        }

        table.center {
            margin-left: auto; 
            margin-right: auto;
        }

        th{
            color: maroon;
        }
        h2{
            text-align: center;
        }
    </style>
    <div class="toolbar">
        <a href="dashboard.php">Home</a>
        <a href="WeeklySchedule.php">Schedule</a>
        <a href="searchClassesTemplate.php">Search for Classes</a>
        <a href="AcademicRequirements">Academic Requirements</a>
        <a href="Enrollment.php">Enroll</a>
        <a href="Discussion.html">Discussion Board</a>
    </div>
        </head>

        <!--
        <body>
            <h1>Enrollment Planner Login!</h1>
                <div class='main'>
                    <div class='studentLogin'>
                        <h2>Student Login!</h2>
                        <form action='./login/login.php' method='post'>
                        Username: <input type='text' name='username' id='username'><br>
                        <form action='./login/login.php' method='post'>
                        Password: <input type='password' name='password' id='password'><br>
                        <input type='submit' name='submit' value='Login'>
                    </div>

                    <div class='adminLogin'>
                        <h2>Admin Login!</h2>
                        <form action='./login/adminLogin.php' method='post'>
                        Username: <input type='text' name='username' id='username'><br>
                        <form action='./login/adminLogin.php' method='post'>
                        Password: <input type='text' name='password' id='password'><br>
                        <input type='submit' name='submit' value='Login'>
                    </div>
                </div>
        </body>
        -->
</html>
