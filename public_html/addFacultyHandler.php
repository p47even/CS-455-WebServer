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
                <a href="adminDashboard.php">Home</a>
                <a href="addFacultyHandler.php">Add New Faculty</a>
                <a href="logout.php" class="logout">Logout</a>
            </div>

    </head>
    <body>
            <h1>Add New Faculty</h1>

            <form action='./addFaculty.php' method='post'>
            Faculty Name: <input type='text' name='facultyName' id='facultyName'><br><br>

            <form action='./addFaculty.php' method='post'>
            facultyID: <input type='text' name='facultyID' id='facultyID'><br><br>

            <form action='./addFaculty.php' method='post'>
            Password: <input type='password' name='facultyPassword' id='facultyPassword'><br><br>

            <form action='./addFaculty.php' method='post'>
            Department: <select name='department' id='department'>
                    <option value='BIO'>Biology</option>
                    <option value='CHEM'>Chemistry</option>
                    <option value='CSCI'>Computer Science</option>
                    <option value='ENG'>English</option>
                    <option value='HIST'>History</option>
                    <option value='MATH'>Mathematics</option>
                  </select>
            <br>

            <input type='submit' name='submit' value='Create'>
        <br>
        <br>

        <p>
            <?php
                session_start();

                if(isset($_GET["msg"])){
                    $error_message = $_GET["msg"];

                    if(strlen($error_message) >= 0){
                        echo $error_message;

                    }
                }



                if(!isset($_SESSION["aID"]))
                {
                     header("Location: 'aProject.php?msg=Please Login First'", true, 303);
                     exit;
                }

            ?>
        </p>

    </body>
</html>
