<!DOCTYPE html>
<html>
<body>
    <?php
        session_start();

        //$_SESSION["test"] = "testo";
        try
        {
            $_SESSION["oldSsn"] = $_GET["ssn"];
            $_SESSION["oldFName"] = $_GET["oldFName"];
            $_SESSION["oldMName"] = $_GET["oldMName"];
            $_SESSION["oldLName"] = $_GET["oldLName"];
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }

        echo
        "<form action='inputHandler.php' method='post'>
        SSN: <input type='text' name='ssn' id='ssn'><br>
        <form action='inputHandler.php' method='post'>
        First Name: <input type='text' name='fName' id='fName'><br>
        <form action='inputHandler.php' method='post'>
        Middle Name: <input type='text' name='mName' id='mName'><br>
        <form action='inputHandler.php' method='post'>
        Last Name: <input type='text' name='lName' id='lName'><br>
        <input type='submit' name='submit' value='Update Info'>"
        ;
    ?>
</body>
</html>
