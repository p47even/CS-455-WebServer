<!DOCTYPE html>
<html>
<body>
    <?php
        global $old_ssn = $_GET["oldSsn"];
        global $old_f_name = $_GET["oldFName"];
        global $old_m_name = $_GET["oldMName"];
        global $old_l_name = $_GET["oldLName"];

        echo "<script>console.log('$old_ssn $old_f_name $old_m_name $old_l_name');</script>";

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