<!DOCTYPE html>
<html>
<body>
    

    <?php
        $old_ssn = $_GET["oldSsn"];
        $old_fname = $_GET["oldFName"];
        $old_mname = $_GET["oldMName"];
        $old_lname = $_GET["oldLName"];
        echo "<script>console.log($old_ssn + ' ' + $old_fname + ' ' + $old_mname + ' ' + $old_lname);</script>";

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