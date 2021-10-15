<!DOCTYPE html>
<html>
<body>
    

    <?php
        $oldName = $_GET[oldName];
        $oldSsn = $_GET[oldSsn];

        echo "<form action='ipnutHandler.php' name='form' method='post' value='$oldName'>
        Attr: <input type='text' name='attr' id='attr'><br>
        <form action='inputHandler.php' name='form' method='post' value='$oldSsn'>
        Var: <input type='text' name='var' id='var'><br>
        <input type='submit' name='submit' value='Update Info'>";
    ?>
</body>
</html>