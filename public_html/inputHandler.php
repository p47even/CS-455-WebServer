<?php
//path to the SQLite database file
$db_file = './myDB/airport.db';

try {
    //open connection to the airport database file
    $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

    //set errormode to use exceptions
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    //return the html query                                              previous     previous
    $query_str = "UPDATE passengers SET $_GET[attr] = '$_GET[var]' where $_GET[attr]='$_GET[var]';"; // Update db
    query($query_str);

    //disconnect from db
    $db = null;
}
catch(PDOException $e) {
    die('Exception : '.$e->getMessage());
}
?>