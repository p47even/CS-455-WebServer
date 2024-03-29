<html>
    <head>
    <style>
        .toolbar{
            background-color: maroon;
        }
        .toolbar a:hover{
            background-color:white;
            color: black;
        }

        .toolbar a{
            padding: 15px 15px;
            color: white;
            font-size: 20px;
            text-decoration: none;
        }

        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
        }

        table.center {
            margin-left: auto; 
            margin-right: auto;
        }

        th{
            color: maroon;
        }
        h2{
            text-align: center;
        }
    </style>
    <div class="toolbar">
        <a href="dashboard.php">Home</a>
        <a href="WeeklySchedule.php">Schedule</a>
        <a href="searchClassesTemplate.php">Search for Classes</a>
        <a href="Enrollment.php?msg=">Enroll</a>
        <a href="4YearPlan.php">Four Year Plan</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    </head>


    <?php 
        session_start();

        if(!isset($_SESSION["sID"])) //redirect to login if studentID not set
        { 
            $loginUrl = 'project.php?msg=Please Login First';
            header("Location: $loginUrl", true, 303);
            exit; 
        }


        $studentID = $_SESSION['sID'];

        $seasonSpring = TRUE; //current semester, assuming spring since there are students currently enrolled in capston 
        $db = new SQLite3('myDB/uni.db');

        $numCoursesPerSemester = 4;
        $numSemesters = 8;
    
        $classes = ['Freshman','Sophomore','Junior','Senior'];
        $classInd = 0; //keeps track of current class (freshman, sophomore, etc)
        $numSemestersPerClass = 2;
        
        //get basic student info regardless of enrollments
        $q0 = 'select * from Students where studentID = '.$studentID.';'; 
        $q0Result = $db->query($q0);
        $q0Array = $q0Result->fetchArray();
        $studentName = $q0Array['studentName'];
        $class = $q0Array['class'];

        //get all current enrollments
        $query = 'select * from Students natural join Enroll natural join Course where studentID = '.$studentID.';';

        $result = $db->query($query);
        $currCoursesArray = array();

        //declare vars
        $startingCourses = array(); //courses currently enrolled in
        $startingCourseNames = array(); //names of all currently enrolled courses
        $allCourseNames = array(); //courseNames for whole department
        $coursesinDept = array(); //courseIDs for whole department

        //populate $startingCourses with current enrollments
        $i = 0;
        while ($currCoursesArray = $result->fetchArray()) { 
            $startingCourses[$i] = $currCoursesArray['courseID'];
            $startingCourseNames[$i] = $currCoursesArray['courseName'];
            $studentName = $currCoursesArray['studentName'];
            $class = $currCoursesArray['class'];
            $i ++;
        }

        //create table, adjust starting position, and fill with current enrollments
        $schedule = array_fill(0,$numCoursesPerSemester*$numSemesters,'');
        $schedIndex = 0; //set starting index
    
        $toMultiply = 0; 
        while (!($class == $classes[$classInd])){ //move starting index based on class
            $toMultiply+=$numSemestersPerClass;
            $classInd++;
        }
        $schedIndex = $numCoursesPerSemester*$toMultiply;

        if ($seasonSpring) { //start at spring semester if needed
            $schedIndex += $numCoursesPerSemester;
        }

        for($SC = 0; $SC < count($startingCourseNames); $SC++){ //fill with current enrollments
            $schedule[$schedIndex] = $startingCourseNames[$SC];
            $schedIndex++;
        }
        if ($schedIndex % $numCoursesPerSemester != 0){ //advance index to start of next semester if not already there
            $schedIndex = goToNextSemester($schedIndex, $numCoursesPerSemester);
        }
        if ($seasonSpring) { $classInd++; } //update $classInd if going to next semester goes to next class
        $seasonSpring = !$seasonSpring; //change current season

        //get major
        $majorQuery = 'select Major from Students natural join Major where studentID = '.$studentID.';';
        $majorArr = $db->query($majorQuery)->fetchArray();
        
    
        if (!$majorArr){
            $major = 'Undeclared';
        }
        else {
            $major = $majorArr[0];
            $courseIDs = array();
            $courseNames = array();
            $fallSems = array();
            $springSems = array();
            $filterResultArray = array();
            $j = 0;
            
            //get all courses that will be added to the table from the listed major.
            $filterQuery = 
                'with tmp as (select courseID from Enroll where studentID = '.$studentID.'),
                tmp2 as (select distinct courseID from Requirements where requirementID in tmp),
                tmp3 as (select courseID from tmp2 union select courseID from Requirements natural join Course where deptID = \''.$major.'\' and requirementID in tmp2),
                tmp4 as (select * from tmp3 natural join Requirements),		
                tmp5 as (select requirementID as courseID from tmp4),
                tmp6 as (select * from tmp5 where courseID not in tmp),
                tmp7 as (select distinct courseID from tmp3 union select distinct courseID from tmp6 group by courseID)
                select * from tmp7 natural join course group by courseID;';
            $filterResult = $db->query($filterQuery);

            while ($filterResultArray = $filterResult->fetchArray()){
                $courseIDs[$j] = $filterResultArray['courseID'];
                $courseNames[$j] = $filterResultArray['courseName'];
                $fallSems[$j] = $filterResultArray['fallSemester'];
                $springSems[$j] = $filterResultArray['springSemester'];
                $j++;
            }

            //get reqs for all future courses
            $reqQuery = 
                'with tmp as (select courseID from Enroll where studentID = '.$studentID.'),
                tmp2 as (select distinct courseID from Requirements where requirementID in tmp),
                tmp3 as (select courseID from tmp2 union select courseID from Requirements natural join Course where deptID = \''.$major.'\' and requirementID in tmp2),
                tmp4 as (select * from tmp3 natural join Requirements),		
                tmp5 as (select requirementID as courseID from tmp4),
                tmp6 as (select * from tmp5 where courseID not in tmp),
                tmp7 as (select distinct courseID from tmp3 union select distinct courseID from tmp6 group by courseID),
                tmp8 as (select * from tmp7 natural join course),
                tmp9 as (select * from tmp8 natural join Requirements),
                tmp10 as (select requirementID as courseID from tmp9),
                tmp11 as (select courseID as requirementID, courseName as requirementName from tmp10 natural join course)
                select * from tmp9 natural join tmp11;';         

            $reqResult = $db->query($reqQuery);
            $reqResultArray = array();
            $reqParents = array();
            $reqChildren = array();
            $reqParentNames = array();
            $reqChildrenNames = array();
            $k = 0;
            while ($reqResultArray = $reqResult->fetchArray()){
                $reqParents[$k] = $reqResultArray['courseID'];
                $reqParentNames[$k] = $reqResultArray['courseName'];
                $reqChildren[$k] = $reqResultArray['requirementID'];
                $reqChildrenNames[$k] = $reqResultArray['requirementName'];
                $k++;
            }          

            //get class requirements for future courses
            $classReqQuery = 
                'with tmp as (select courseID from Enroll where studentID = '.$studentID.'),
                tmp2 as (select distinct courseID from Requirements where requirementID in tmp),
                tmp3 as (select courseID from tmp2 union select courseID from Requirements natural join Course where deptID = \''.$major.'\' and requirementID in tmp2),
                tmp4 as (select * from tmp3 natural join Requirements),		
                tmp5 as (select requirementID as courseID from tmp4),
                tmp6 as (select * from tmp5 where courseID not in tmp),
                tmp7 as (select distinct courseID from tmp3 union select distinct courseID from tmp6 group by courseID),
                tmp8 as (select * from tmp7 natural join course)
                select courseID, class from tmp8 natural join ClassRequirements;';        
            $classReqResult = $db->query($classReqQuery);
            $classReqResultArray = array();
            $classReqCourseID = array();
            $classReqClass = array();
            $l = 0;
            while ($classReqResultArray = $classReqResult->fetchArray()){
                $classReqCourseID[$l] = $classReqResultArray['courseID'];
                $classReqClass[$l] = $classReqResultArray['class'];
                $l++;
            }        
            //add in future courses
            for ($courseIter = 0; $courseIter < count($courseIDs); $courseIter++ ){ //if required class is in this semester, go to next semester
                if (in_array($courseIDs[$courseIter], $reqParents) ){
                    for ($j = 0; $j < count($reqParents); $j++){
                        $offset = $schedIndex-($schedIndex%$numCoursesPerSemester);
                        $length = $numCoursesPerSemester;
                        $semester = (array_slice( $schedule, $offset,$length  ));
                        if ( ($reqParents[$j] == $courseIDs[$courseIter]) && (in_array( $reqChildrenNames[$j], $semester) ) ){ 
                            $schedIndex = goToNextSemester($schedIndex,$numCoursesPerSemester);
                            if ($seasonSpring) { $classInd++; }
                            $seasonSpring = !$seasonSpring;
                        }
                    }                    
                }
                if (in_array($courseIDs[$courseIter], $classReqCourseID) ){ //ensure class requirement is met (ie wait until senior year to take a senior only class)
                    $classReqInd = array_search($courseIDs[$courseIter], $classReqCourseID);
                    while ($classes[$classInd] != $classReqClass[$classReqInd]){
                        if ($seasonSpring){
                            $schedIndex = goToNextSemester($schedIndex,$numCoursesPerSemester);
                            $seasonSpring = FALSE;
                        }
                        else {
                            $schedIndex = goToNextSemester($schedIndex,$numCoursesPerSemester);
                            $schedIndex = goToNextSemester($schedIndex,$numCoursesPerSemester);
                        }
                        $classInd++;
                    }
                }
                //handle seasons
                $supportedSeasons = [$fallSems[$courseIter],$springSems[$courseIter]];
                if ($supportedSeasons[$seasonSpring] == 0){ //if fall and course is not taught in fall, move to spring and vice versa
                    $schedIndex = goToNextSemester($schedIndex, $numCoursesPerSemester);
                    if ($seasonSpring) { $classInd++; }
                    $seasonSpring = !$seasonSpring;
                } 
    
                //add course to schedule
                $schedule[$schedIndex] = $courseNames[$courseIter];
                $schedIndex++;
                if ($schedIndex%$numCoursesPerSemester == 0) { 
                    if ($seasonSpring) { $classInd++; }
                    $seasonSpring = !$seasonSpring;
                }             
            }
            
        }
        //advance $schedIndex to start of next semester
        function goToNextSemester($schedIndex, $numCoursesPerSemester){
            return $schedIndex += $numCoursesPerSemester-($schedIndex%$numCoursesPerSemester);
        }
        //add element to table
        function echoTableElements($start, $schedule, $numToIter){
            $str = '<tr>';
            for ($i = $start; $i < count($schedule); $i += $numToIter){
                $str = $str.'<td>'.$schedule[$i].'</td>';
            }
            $str = $str.'</tr>';
            echo $str;
        }

    ?>
    <style>
        .toolbar{
            background-color: maroon;
        }
        .toolbar a:hover{
            background-color:lightcyan;
            padding: 5px 5px;
            color: black;
            border:1.75px solid black;
        }

        .toolbar a{
            padding: 15px 15px;
            color: white;
            font-size: 20px;
            text-decoration: none;
            font-family: arial;
        }

        table{
            border:1.75px solid black;
            border-collapse:collapse;
            font-family:arial;
            background-color:lightcyan;
            padding:10px;
        }
        th{ /* Columns */
            border:1.5px solid black;
            border-collapse:collapse;
            font-family:arial;
            background-color:lightblue;
            padding:5px;
        }
        td{ /* Rows */
            border:1.5px solid black;
            width: 1%;
            border-collapse:collapse;
            font-family:arial;
            background-color:lightcyan;
            padding:10px;
        }
        td:empty::after{
            content: "\00a0";
        }
        p{
            font-size:15;
            font-family:arial;
        }
        </style>
    <head>
        <title>Four Year Plan</title>
</head>
<body style = "background-color:linen">
    <h1 style = "color:beige;font-family:arial;background-color:maroon;text-align:center"> Four Year Plan </h1>
    <p><?php echo $studentName; ?></p>
    <p>Major: <?php echo $major; ?></p>
    <p>Class: <?php echo $class; ?></p>
    <table>
        <tr>
            <?php for ($i = 0; $i < count($classes); $i++){ //table headers
                echo "<th colspan = \"2\">".$classes[$i]."</th>";
            }?>
        </tr>
        <tr>
            <?php for ($i = 0; $i < $numSemesters; $i+=2){ //table subheaders
                echo "<th>"."Fall"."</th>";
                echo "<th>"."Spring"."</th>";
            }?>
        <?php for ($i = 0; $i < $numSemesters/2; $i++){ //table contents
            echoTableElements($i, $schedule, $numCoursesPerSemester);
        }?>
    </table>
</body>
</html>
