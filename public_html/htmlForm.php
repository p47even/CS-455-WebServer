<!DOCTYPE html>
<html>
<body>
    

    <?php
        echo
        "<form action='inputHandler.php' method='post' value='$_GET[oldSsn]'>
        SSN: <input type='text' name='$_GET[oldSsn]' id='var'><br>
        <form action='inputHandler.php' method='post' value='$_GET[oldFName]'>
        First Name: <input type='text' name='$_GET[oldFName]' id='fName'><br>
        <form action='inputHandler.php' method='post' value='$_GET[oldMName]'>
        Middle Name: <input type='text' name='$_GET[oldMName]' id='mName'><br>
        <form action='inputHandler.php' method='post' value='$_GET[oldLName]'>
        Last Name: <input type='text' name='$_GET[oldLName]' id='lName'><br>
        <input type='submit' name='submit' value='Update Info'>"
        ;
    ?>
</body>
</html>