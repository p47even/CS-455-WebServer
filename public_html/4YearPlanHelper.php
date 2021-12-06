<!DOCTYPE html>
<html>
<head>
    <style>
        h2{
            text-align: center;
        }
    </style>
    </div>
    <h2> Input Student ID</h2>
</head>
<body>
    <?php
        $_POST["studentID"] = "";
    ?>
    <form action='./4YearPlan.php' method='post'>
        Student ID: <input type='text' name='studentID' id='studentID'><br>
        <input type='submit' name='Submut' value='Submit'>
</body>
</html>
