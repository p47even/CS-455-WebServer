<!DOCTYPE html>
<html>
    <head>
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
                <a href="facultyDashboard.php">Home</a>
                <a href="ProfSchedule.php">Schedule</a>
                <a href="searchClasses.php">Search for classes</a>
                <a href="ClassRoster.php">Class Roster</a>
                <a href="AddClassPromp.php">Add Class</a>
                <a href="removeClass.php">Remove Class</a>
                <a href="addStudentHandler.php">Add New Student</a>
                <a href="logout.php" class="logout">Logout</a>

            </div>

    </head>
    <body>
            <h1>Add a New Student</h1>

            <form action='./addStudent.php' method='post'>
            Student Name: <input type='text' name='studentName' id='studentName'><br><br>

            <form action='./addStudent.php' method='post'>
            StudentID: <input type='text' name='studentID' id='studentID'><br><br>

            <form action='./addStudent.php' method='post'>
            GPA: <input type='text' name='gpa' id='gpa'><br><br>

            <form action='./addStudent.php' method='post'>
            Username: <input type='text' name='username' id='username'><br><br>

            <form action='./addStudent.php' method='post'>
            Password: <input type='password' name='password' id='password'><br><br>

            <form action='./addStudent.php' method='post'>
            Class: <select name='class' id='class'>
                      <option value='1'>Freshman</option>
                      <option value='2'>Sophmore</option>
                      <option value='3'>Junior</option>
                      <option value='4'>Senior</option>
                      <option value='5'>Other</option>
                  </select>
            <br>

            <form action='./addStudent.php' method='post'>
            Major: <select name='major' id='major'>
                    <option value='undecided'>Undecided</option>
                    <option value='bio'>Biology</option>
                    <option value='chem'>Chemistry</option>
                    <option value='cs'>Computer Science</option>
                    <option value='eng'>English</option>
                    <option value='hist'>History</option>
                    <option value='math'>Mathematics</option>
                </select>
            <br>

            <input type='submit' name='submit' value='Create'>
        <br>
        <br>

        <p>
            <?php
                session_start();

                if(!isset($_SESSION["fID"]))
                {
                     header("Location: 'fProject.php?msg=Please Login First'", true, 303);
                     exit;
                }

            ?>
        </p>

    </body>
</html>
