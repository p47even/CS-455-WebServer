<!DOCTYPE html>
<html>
<body>
    <?php
        session_start();

        //$_SESSION["test"] = "testo";
        try
        {
            $_SESSION["oldSsn"] = $_GET["oldSsn"];
            $_SESSION["oldFName"] = $_GET["oldFName"];
            $_SESSION["oldMName"] = $_GET["oldMName"];
            $_SESSION["oldLName"] = $_GET["oldLName"];
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }

        echo
        "<form action='./inputHandler.php' method='post'>
        SSN: <input type='text' name='ssn' id='ssn' value='".$_SESSION["oldSsn"]."'><br>

        <form action='./inputHandler.php' method='post'>
        First Name: <input type='text' name='fName' id='fName' value='".$_SESSION["oldFName"]."'><br>

        <form action='./inputHandler.php' method='post'>
        Middle Name: <input type='text' name='mName' id='mName' value='".$_SESSION["oldMName"]."'><br>

        <form action='./inputHandler.php' method='post'>
        Last Name: <input type='text' name='lName' id='lName' value='".$_SESSION["oldLName"]."'><br>
        
        <input type='submit' name='submit' value='Update Info'>"
        ;
    ?>
</body>
</html>
