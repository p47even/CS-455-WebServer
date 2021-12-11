<!DOCTYPE html>
<html>
<body>
    <?php
    session_start();
    
    if(!isset($_SESSION["sID"])) //check if user is logged in
            { 
                //$loginUrl = 'project.php?msg=Please Login First';
                //header("Location: $loginUrl", true, 303);
                exit; 
            }
            
            //$_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];
    

    //path to the SQLite database file
    $db_file = './myDB/uni.db';

    try {

        //open connection to the airport database file
        $db = new PDO('sqlite:' . $db_file);      

        //set errormode to use exceptions
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $addStr = ""; //non-semester attribute names sent from searchClassesTemplate.php
        $attrList = ['courseID','deptID','courseName']; //non-semester attrs in Students

        $addStr = getAttrs($attrList);
        
        $semester = $_POST["semester"];
        if($semester != ""){ //handle semester
            if($addStr != ""){ $addStr .= ' and '; } //add ' and ' if not first attribute to be filtered on
            if($semester == "fall") { $addStr .= " fallSemester = 1";}
            else if($semester == "spring"){ $addStr .= " springSemester = 1";}
            else if($semester == "fallOnly"){ $addStr .= " fallSemester = 1 and springSemester = 0";}
            else if($semester == "springOnly"){ $addStr .= " fallSemester = 0 and springSemester = 1";}
        }
        $addStr.=';';


        $querStmnt = "SELECT * FROM COURSE";
        if (strcmp($addStr,';') == 0){ //if $addStr is empty, statment is 'SELECT * FROM COURSE;'
            $querStmnt.=$addStr;
        }
        else { 
            $querStmnt .= " WHERE ".$addStr;
        }
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
    }

    function getAttrs($attrList){ //add attribute value to select query
        $attrStr = "";
        for ($i = 0; $i < count($attrList); $i++){
            $value = $_POST[ $attrList[$i] ];
            if ($value != ""){
                if ($attrStr != ""){
                    $attrStr .= ' and '; //add ' and ' if not first attribute to be filtered on
                }
                if (gettype($value) == "string"){ //add quotes if string
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
