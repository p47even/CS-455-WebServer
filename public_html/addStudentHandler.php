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
            <!-- Toolbar that helps users navigate between pages -->
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
        <!-- Form containing all the information we need to create a new student -->
        <!-- Sent to addStudent.php w/ _POST -->
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
                      <option value='Freshman'>Freshman</option>
                      <option value='Sophomore'>Sophomore</option>
                      <option value='Junior'>Junior</option>
                      <option value='Senior'>Senior</option>
                      <option value='Other'>Other</option>
                  </select>
            <br>

            <form action='./addStudent.php' method='post'>
            Major: <select name='major' id='major'>
                    <option value='Undecided'>Undecided</option>
                    <option value='Biology'>Biology</option>
                    <option value='Chemistry'>Chemistry</option>
                    <option value='Computer Science'>Computer Science</option>
                    <option value='English'>English</option>
                    <option value='History'>History</option>
                    <option value='Mathematics'>Mathematics</option>
                </select>
            <br>

            <input type='submit' name='submit' value='Create'>
        <br>
        <br>

        <p>
            <?php
                session_start();

                //If theres a message get it and print it out
                //Ususally related to bad input into the form
                if(isset($_GET["msg"])){
                    $error_message = $_GET["msg"];

                    if(strlen($error_message) >= 0){
                        echo $error_message;

                    }
                }

                //Check if the admin is logged in and redirect them to the login page if not
                if(!isset($_SESSION["fID"]))
                {
                     header("Location: 'fProject.php?msg=Please Login First'", true, 303);
                     exit;
                }
            ?>
        </p>
    </body>
</html>
