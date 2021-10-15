<!DOCTYPE html>
<html>
<body>
    <form action="ipnutHandler.php" name='form' method='post'>
    Attr: <input type="text" name="attr" id="attr"><br>
    <form action="inputHandler.php" name='form' method='post'>
    Var: <input type="text" name="var" id="var"><br>
    <input type="submit" name="submit" value="Update Info">
    
    <?php
        $query_str = "$_GET[oldSsn] $_GET[oldName]";
        echo "<script>log.console('$query_str');</script>";
    ?>
</body>
</html>