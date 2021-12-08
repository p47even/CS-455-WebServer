<!DOCTYPE html>
<html>
<body>
    <?php
    session_start();
    //path to the SQLite database file
    $db_file = './myDB/uni.db';

    try {

        //open connection to the airport database file
        $db = new PDO('sqlite:' . $db_file);      // <------ Line 13

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $addStr = "";
        $attrAdded = 0;
        $attrList = ['courseID','deptID','courseName'];

        $addStr = getAttrs($attrList);
        
        $semester = $_POST["semester"];
        if($semester != ""){
            if($addStr != ""){ $addStr .= ' and '; } 
            if($semester == "fall") { $addStr .= " fallSemester = 1";}
            else if($semester == "spring"){ $addStr .= " springSemester = 1";}
            else if($semester == "fallOnly"){ $addStr .= " fallSemester = 1 and springSemester = 0";}
            else if($semester == "springOnly"){ $addStr .= " fallSemester = 0 and springSemester = 1";}
        }
        $addStr.=';';


        $querStmnt = "SELECT * FROM COURSE";
        if (strcmp($addStr,';') == 0){
            $querStmnt.=$addStr;
        }
        else { 
            $querStmnt .= " WHERE ".$addStr;
        }
        //$querStmt $addStr;
        $classes_query = $db->prepare($querStmnt);


        $classes_query->execute();

        $query_result = $classes_query->fetchAll();

        $_SESSION["courAttrQuer"] = $query_result;

        $redirect_url = $_SESSION['redirect_url']; 
        unset($_SESSION['redirect_url']);
        header("Location: $redirect_url", true, 303);
        exit;
    }
    catch(PDOException $e) {
        $redirect_url = $_SESSION['redirect_url']; 
        unset($_SESSION['redirect_url']);
        header("Location: $redirect_url", true, 303);
        exit;
        //die('Exception : '.$e->getMessage());
    }

    function getAttrs($attrList){
        $attrStr = "";
        for ($i = 0; $i < count($attrList); $i++){
            $value = $_POST[ $attrList[$i] ];
            if ($value != ""){
                if ($attrStr != ""){
                    $attrStr .= ' and ';
                }
                if (gettype($value) == "string"){
                    $value = '\''.$value.'\'';
                }
                $attrStr .= $attrList[$i]." = ".$value;

            }
        }
        return $attrStr;
    }
    
    ?>
</body>
</html>