<?php
session_start();
//path to the SQLite database file
$db_file = './myDB/airport.db';
##require './htmlForm.php';
try{
echo $_SESSION["oldSsn"];
}
catch{
    echo "daisy";
}
session_destroy();
////print_r($GLOBALS);
/*
try {

    //open connection to the airport database file
    $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

    //set errormode to use exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $updateSSN = $db->prepare("UPDATE passengers SET (old_f_name = new_f_name, old_m_name = new_m_name, old_l_name = new_l_name, old_ssn = new_ssn) WHERE (ssn == old_ssn)");
        $updateSSN->bindParam('new_f_name', $new_f_name);
        $updateSSN->bindParam('new_m_name', $new_m_name);
        $updateSSN->bindParam('new_l_name', $new_l_name);
        $updateSSN->bindParam('new_ssn', $new_ssn);
        $updateSSN->bindParam('old_f_name', $old_f_name);
        $updateSSN->bindParam('old_m_name', $old_m_name);
        $updateSSN->bindParam('old_l_name', $old_l_name);
        $updateSSN->bindParam('old_ssn', $old_ssn);
  
  
    $new_f_name = $_GET[f_name];
    $new_m_name = $_GET[m_name];
    $new_l_name = $_GET[l_name];
    $new_ssn = $_GET[ssn];
    //$f_name = $old_f_name;
    //$m_name = $old_m_name;
    //$l_name = $old_l_name;
    //$old_ssn = $old_ssn;
    $updateSSN->execute();
    //query($query_str);

    //disconnect from db
    $db = null;
}
catch(PDOException $e) {
    die('Exception : '.$e->getMessage());
}*/
?>
