<!DOCTYPE html>
<html>
<body>
    

    <?php
        echo "<form action='ipnutHandler.php' name='form' method='post' value='$_GET[oldName]'>
        Attr: <input type='text' name='attr' id='attr'><br>
        <form action='inputHandler.php' name='form' method='post' value='$_GET[oldSsn]'>
        Var: <input type='text' name='var' id='var'><br>
        <input type='submit' name='submit' value='Update Info'>";
    ?>
</body>
</html>