<?php
session_start();
//path to the SQLite database file
$db_file = './myDB/airport.db';
##require './htmlForm.php';

////print_r($GLOBALS);

try {

    //open connection to the airport database file
    $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

    //set errormode to use exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    /*
    $updateSSN = $db->prepare("UPDATE passengers SET (old_f_name = new_f_name, old_m_name = new_m_name, old_l_name = new_l_name, old_ssn = new_ssn) WHERE (ssn == old_ssn)");
        $updateSSN->bindParam('new_f_name', $new_f_name);
        $updateSSN->bindParam('new_m_name', $new_m_name);
        $updateSSN->bindParam('new_l_name', $new_l_name);
        $updateSSN->bindParam('new_ssn', $new_ssn);
        $updateSSN->bindParam('old_f_name', $old_f_name);
        $updateSSN->bindParam('old_m_name', $old_m_name);
        $updateSSN->bindParam('old_l_name', $old_l_name);
        $updateSSN->bindParam('old_ssn', $old_ssn);
    */
  
    $new_f_name = $_POST["fName"];
    $new_m_name = $_POST["mName"];
    $new_l_name = $_POST["lName"];
    $new_ssn = $_POST["ssn"];

    $f_name = $_SESSION["oldFName"];
    $m_name = $_SESSION["oldMName"];
    $l_name = $_SESSION["oldLName"];
    $old_ssn = $_SESSION["oldSsn"];
    
    /////$updateSSN->execute();
    //query($query_str);

    //disconnect from db
    $db = null;
}
catch(PDOException $e) {
    die('Exception : '.$e->getMessage());
}
session_destroy();
?>
