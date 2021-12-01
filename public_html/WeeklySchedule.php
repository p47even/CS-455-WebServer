<!DOCTYPE html>
<html>
<body>
    <?php

    try {

        //open connection to the airport database file
        $db = new PDO('sqlite:' . './uni.db');      // <------ Line 13

        //set errormode to use exceptions
        //$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
        $classes = $db->query("SELECT * FROM Enroll NATURAL JOIN IsMeeting WHERE studentID = 1;");
         echo $classes;
      
        $db = null;
    }
    catch(PDOException $e) {
        die('Exception : '.$e->getMessage());
    }
    ?>
</body>
</html>
