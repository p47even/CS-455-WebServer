<html>
    <?php 
        $season = 1; //current semester
        $db = new SQLite3('uni.db');
        $numCoursesPerSemester = 4;
        $numSemesters = 8;
        $studentID = 9; //TODO: GET STUDENTID FROM SOMEWHERE, REDO HOW COURSES ARE SPACED
        $query = 'select * from Students natural join Enroll natural join Course where studentID = '.$studentID.';';

        $result = $db->query($query);
        $currCoursesArray = array();
        $currCoursesArray = $result->fetchArray();

        //declare arrays
        $startingCourses = array(); //courses currently enrolled in
        $startingCourseNames = array(); //names of all currently enrolled courses
        $allCourseNames = array(); //courseNames for whole department
        $coursesinDept = array(); //courseIDs for whole department

        $startingCourses[0] = $currCoursesArray['courseID'];
        $startingCourseNames[0] = $currCoursesArray['courseName'];

        $studentName = $currCoursesArray['studentName'];
        $class = $currCoursesArray['class'];

        //populate $startingCourses
        $i = 1;
        while ($currCoursesArray = $result->fetchArray()) { 
            $startingCourses[$i] = $currCoursesArray['courseID'];
            $startingCourseNames[$i] = $currCoursesArray['courseName'];
            $i ++;
        }

        //fill table for current semester
        $schedule = array_fill(0,$numCoursesPerSemester*$numSemesters,'');

        $schedIndex = 0; //set starting index
        if ($class == "Sophomore"){ $schedIndex = $numCoursesPerSemester*2; }
        else if ($class == "Junior"){ $schedIndex = $numCoursesPerSemester*4; }
        else if ($class == "Senior"){ $schedIndex = $numCoursesPerSemester*6; }
        if ($season == 1) {
            $schedIndex += $numCoursesPerSemester;
        }

        for($SC = 0; $SC < count($startingCourseNames); $SC++){
            $schedule[$schedIndex] = $startingCourseNames[$SC];
            $schedIndex++;
        }

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

            $filterQuery = 'with tmp as (select courseID from Enroll where studentID = '.$studentID.'),tmp2 as (select distinct courseID from Requirements where requirementID in tmp), tmp3 as (select courseID from tmp2 union select courseID from Requirements natural join Course where deptID = \''.$major.'\' and requirementID in tmp2) select * from tmp3 natural join course;';
            $filterResult = $db->query($filterQuery);

            while ($filterResultArray = $filterResult->fetchArray()){
                $courseIDs[$j] = $filterResultArray['courseID'];
                $courseNames[$j] = $filterResultArray['courseName'];
                $fallSems[$j] = $filterResultArray['fallSemester'];
                $springSems[$j] = $filterResultArray['springSemester'];
                $j++;
            }
            for($FC = 0; $FC < count($courseNames); $FC++){
                $schedule[$schedIndex] = $courseNames[$FC];
                $schedIndex++;
            } 
            
            /*
            //get all courses in department
            $query2 = 'select * from course natural join department where deptID = \''.$major.'\';';
            $result2 = $db->query($query2);
            $resultArray2 = array();
            $j = 0;
            while ($resultArray2 = $result2->fetchArray()) {
                $coursesinDept[$j] = $resultArray2['courseID'];
                $allCourseNames[$j] = $resultArray2['courseName'];
                $fallSems[$j] = $resultArray2['fallSemester'];
                $springSems[$j] = $resultArray2['springSemester'];
                $j ++;
            }
            //filter course list 
            $toTake = array();
            $query3 = 'select * from requirements natural join course where deptID = \''.$major.'\';';
            $result3 = $db->query($query3);
            $resultArray3 = array();
            $reqParents = array();
            $reqChildren = array();
            while ($resultArray3 = $result3->fetchArray()) { //store query results
                array_push($reqParents, $resultArray3['courseID']);
                array_push($reqChildren, $resultArray3['requirementID']);
            }
            for ($iter = 0; $iter < count($coursesinDept); $iter++){
                if ( !in_array($coursesinDept[$iter], $courseIDs)){ //if course is not listed as being taken
                    $allgood = 0;
                    for ($reqIter = 0; $reqIter < count($reqParents); $reqIter++ ){ //if course hasn't been retroactively fulfilled, add it
                        if (in_array($reqParents[$reqIter], $courseIDs) && $reqChildren[$reqIter] == $coursesinDept[$iter] ){
                            $allgood = 1;
                        }
                    }
                    if ($allgood == 0) { array_push($courseIDs,$coursesinDept[$iter]); }   
                }
                if ( in_array($coursesinDept[$iter], $courseIDs) ){ //if course is listed as being taken
                    for ($reqIter = 0; $reqIter < count($reqParents); $reqIter++ ){
                        if ( $coursesinDept[$iter] == $reqChildren[$reqIter] ) { //if course is required for another, add parent course
                            if (!in_array($reqChildren[$reqIter], $courseIDs)){
                                array_push( $courseIDs,$reqParents[$reqIter] );
                            }
                        }
                    }
                }
            }
            */
            //fill rest of table
            /*
            $move = FALSE;
        
            for($courseIter = 0; $courseIter < count($courseIDs); $courseIter++){
                //ensure courses are not in same semester as reqs
                if (in_array( $courseIDs[$courseIter],$reqParents)) { //if course has requirement
                    for ($j = 0; $j < count($reqParents); $j++){
                        $offset = $schedIndex-($schedIndex%$numCoursesPerSemester);
                        $length = $numCoursesPerSemester;
                        $semester = (array_slice( $schedule, $offset,$length  ));
                        if ( ($reqParents[$j] == $courseIDs[$courseIter]) && (in_array( getCourseName($reqChildren[$j],$coursesinDept,$allCourseNames), $semester) ) ){ //if child is in this semester
                            $move = TRUE;
                            break;
                        } 
                        
                    } 
                }
                if ($move == TRUE) { 
                    $season = flip($season);
                    $schedIndex += $numCoursesPerSemester-($schedIndex%$numCoursesPerSemester); } //determine if currently doing fall (0) or spring (1) semester
                
                //handle seasons
                if ( ($schedIndex-($schedIndex%$numCoursesPerSemester)) % ($numCoursesPerSemester*2) != 0 ) { $season = 1; }
                else { $season = 0; }
                $supportedSeasons = getSeasons($courseIDs[$courseIter],$coursesinDept,$fallSems, $springSems);
                if ($supportedSeasons[$season] == 0){ $schedIndex += $numCoursesPerSemester-($schedIndex%$numCoursesPerSemester); } //if fall and course is not taught in fall, move to spring and vice versa
    
                //add course to schedule
                $schedule[$schedIndex] = getCourseName($courseIDs[$courseIter],$coursesinDept,$allCourseNames);
                $schedIndex++;
                $move = FALSE;
            }
            */
            
        }

        function flip($int){
            if ($int == 0) { return 1; }
            else if ($int == 1) { return 0; }
            else { return 0; }
        }

        function getCourseName( $courseID, $listOfCourseIDs, $listOfNames ){
            for ($i = 0; $i < count($listOfCourseIDs); $i++){
                if ($courseID == $listOfCourseIDs[$i]){
                    return $listOfNames[$i];
                }
            }
            return "";
        }

        function getSeasons( $courseID, $listOfCourseIDs, $falls, $springs){
            for ($i = 0; $i < count($listOfCourseIDs); $i++){
                if ($courseID == $listOfCourseIDs[$i]){
                    return [ $falls[$i],$springs[$i] ];
                }
            }
            return [0][0];
        }

        function getCourseID( $courseName, $listOfCourseIDs, $listOfNames ){
            for ($i = 0; $i < count($listOfNames); $i++){
                if ($courseName == $listOfNames[$i]){
                    return $listOfCourseIDs[$i];
                }
            }
            return "";
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
        <div class="toolbar">
        <a href="Dashboard.html">Home</a>
        <a href="WeeklySchedule.php">Schedule</a>
        <a href="Search4Classes">Search for classes</a>
        <a href="AcademicRequirements">Academic Rqueirements</a>
        <a href="Enrollment.php">Enroll</a>
        <a href="4YearPlan.php">Four Year Plan</a>
    </div>
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
            <th colspan = "2">Freshman</th>
            <th colspan = "2">Sophomore</th>
            <th colspan = "2">Junior</th>
            <th colspan = "2">Senior</th>
        </tr>
        <tr>
            <th>Fall</th>
            <th>Spring</th>
            <th>Fall</th>
            <th>Spring</th>
            <th>Fall</th>
            <th>Spring</th>
            <th>Fall</th>
            <th>Spring</th>
        <tr> <!--Row 1 -->
            <td><?php echo $schedule[0]; ?></td>
            <td><?php echo $schedule[4]; ?></td>
            <td><?php echo $schedule[8]; ?></td>
            <td><?php echo $schedule[12]; ?></td>
            <td><?php echo $schedule[16]; ?></td>
            <td><?php echo $schedule[20]; ?></td>
            <td><?php echo $schedule[24]; ?></td>
            <td><?php echo $schedule[28]; ?></td>
        </tr>
        <tr> <!--Row 2 -->
            <td><?php echo $schedule[1]; ?></td>
            <td><?php echo $schedule[5]; ?></td>
            <td><?php echo $schedule[9]; ?></td>
            <td><?php echo $schedule[13]; ?></td>
            <td><?php echo $schedule[17]; ?></td>
            <td><?php echo $schedule[21]; ?></td>
            <td><?php echo $schedule[25]; ?></td>
            <td><?php echo $schedule[29]; ?></td>
        </tr>
        <tr> <!--Row 3 -->
            <td><?php echo $schedule[2]; ?></td>
            <td><?php echo $schedule[6]; ?></td>
            <td><?php echo $schedule[10]; ?></td>
            <td><?php echo $schedule[14]; ?></td>
            <td><?php echo $schedule[18]; ?></td>
            <td><?php echo $schedule[22]; ?></td>
            <td><?php echo $schedule[26]; ?></td>
            <td><?php echo $schedule[30]; ?></td>
        </tr>
        <tr> <!--Row 3 -->
            <td><?php echo $schedule[3]; ?></td>
            <td><?php echo $schedule[7]; ?></td>
            <td><?php echo $schedule[11]; ?></td>
            <td><?php echo $schedule[15]; ?></td>
            <td><?php echo $schedule[19]; ?></td>
            <td><?php echo $schedule[23]; ?></td>
            <td><?php echo $schedule[27]; ?></td>
            <td><?php echo $schedule[31]; ?></td>
        </tr>
    </table>
</body>
</html>