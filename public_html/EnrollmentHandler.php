<!DOCTYPE html>
<html>
<body>
    <?php
    session_start();
    //path to the SQLite database file
    $db_file = './uni.db';

    $classes_info = $_SESSION["courAttrQuer"];
     
    try {
        //open connection to the airport database file
        $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $update_query = $db->prepare("INSERT ");
        $db = null;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }

    session_destroy();
    ?>
</body>
</html>