<?php
$userPassPairs = array("0"=>"zSLPj4JV","1"=>"2JxCQnub","2"=>"4vmZmHA3","3"=>"5tLyKNrQ","4"=>"57T22Kic","5"=>"xpjD8H25","6"=>"pECG4u90","7"=>"aL10lSN9","8"=>"7PCfvUaL","9"=>"Xfr5YYjw","10"=>"lCMl8iqs","11"=>"WzU4RMrE","12"=>"9Ug3Aof3","13"=>"UX1hwD0y","14"=>"mlNT9KUE","15"=>"8O9ly2q0","16"=>"8yfe5WHs","17"=>"5lSjrHHm","18"=>"NM1Rragv","19"=>"z3VzxC1V","20"=>"C473YzQz","21"=>"vX2is8wx","22"=>"wT26iswF","23"=>"aiY864fk","24"=>"Cmnoc0O1");

$facPassPairs = array("0"=>"dc4I}+sDY","1"=>"7N~.}MgKfX","2"=>"m0]!lFjvpp","3"=>"GM4;mP]Zz?","4"=>"j>~`N0m4Ga","5"=>"v(`Qosw4]p​");

foreach($userPassPairs as $id => $pass){

    $hashedPass = hash('sha256', $pass, false);
    echo "UPDATE StudentLogIn SET password = '" . $hashedPass . "' WHERE StudentID = " . $id . ";<br>";
}
echo "<br>";
foreach($facPassPairs as $id => $pass){
    $hashedPass = hash('sha256', $pass, false);
    echo "UPDATE ProfessorLogin SET password = '" . $hashedPass ."' WHERE FacultyID = ". $id . ";<br>";
}
?>
