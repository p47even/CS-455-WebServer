<html>
    <?php 
        $season = 1; //current semester; 0 = Fall, 1 = Spring
        $db = new SQLite3('uni.db');
        $numCoursesPerSemester = 4;
        $numSemesters = 8;
        $studentID = 5; //TODO: GET STUDENTID FROM SOMEWHERE, MAYBE MAKE HTML TABLE GENERATION LESS HARD CODEY
        $query = 'select * from Students natural join Enroll natural join Course where studentID = '.$studentID.';';

        $result = $db->query($query);
        $currCoursesArray = array();

        //declare vars
        $startingCourses = array(); //courses currently enrolled in
        $startingCourseNames = array(); //names of all currently enrolled courses
        $allCourseNames = array(); //courseNames for whole department
        $coursesinDept = array(); //courseIDs for whole department
        $class = '';
        $studentName = '';

        //populate $startingCourses
        $i = 0;
        while ($currCoursesArray = $result->fetchArray()) { 
            $startingCourses[$i] = $currCoursesArray['courseID'];
            $startingCourseNames[$i] = $currCoursesArray['courseName'];
            $studentName = $currCoursesArray['studentName'];
            $class = $currCoursesArray['class'];
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

            $filterQuery = 
                'with tmp as (select courseID from Enroll where studentID = '.$studentID.'),
                tmp2 as (select distinct courseID from Requirements where requirementID in tmp),
                tmp3 as (select courseID from tmp2 union select courseID from Requirements natural join Course where deptID = \''.$major.'\' and requirementID in tmp2)
                select * from tmp3 natural join course;';
            $filterResult = $db->query($filterQuery);

            while ($filterResultArray = $filterResult->fetchArray()){
                $courseIDs[$j] = $filterResultArray['courseID'];
                $courseNames[$j] = $filterResultArray['courseName'];
                $fallSems[$j] = $filterResultArray['fallSemester'];
                $springSems[$j] = $filterResultArray['springSemester'];
                $j++;
            }

            //get reqs for all future courses
            $reqQuery = 'with tmp as (select courseID from Enroll where studentID = '.$studentID.'),
                tmp2 as (select distinct courseID from Requirements where requirementID in tmp),
                tmp3 as (select courseID from tmp2 union select courseID from Requirements natural join Course where deptID = \''.$major.'\' and requirementID in tmp2),
                tmp4 as (select * from tmp3 natural join course),
                tmp5 as (select * from tmp4 natural join Requirements),
                tmp6 as (select requirementID as courseID from tmp5),
                tmp7 as (select courseID as requirementID, courseName as requirementName from tmp6 natural join course)
                select * from tmp5 natural join tmp7;';
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

            //add in future courses
            for ($courseIter = 0; $courseIter < count($courseIDs); $courseIter++ ){
                if (in_array($courseIDs[$courseIter], $reqParents) ){
                    for ($j = 0; $j < count($reqParents); $j++){
                        $offset = $schedIndex-($schedIndex%$numCoursesPerSemester);
                        $length = $numCoursesPerSemester;
                        $semester = (array_slice( $schedule, $offset,$length  ));
                        if ( ($reqParents[$j] == $courseIDs[$courseIter]) && (in_array( $reqChildrenNames[$j], $semester) ) ){ //if child is in this semester
                            $season = flip($season);
                            $schedIndex += $numCoursesPerSemester-($schedIndex%$numCoursesPerSemester);
                        } 
                        
                    }                    
                }
                //handle seasons
                if ( ($schedIndex-($schedIndex%$numCoursesPerSemester)) % ($numCoursesPerSemester*2) != 0 ) { $season = 1; }
                else { $season = 0; }
                $supportedSeasons = [$fallSems[$courseIter],$springSems[$courseIter]];
                if ($supportedSeasons[$season] == 0){ $schedIndex += $numCoursesPerSemester-($schedIndex%$numCoursesPerSemester); } //if fall and course is not taught in fall, move to spring and vice versa
    
                //add course to schedule
                $schedule[$schedIndex] = $courseNames[$courseIter];
                $schedIndex++;             
            }
            
        }

        function flip($int){
            if ($int == 0) { return 1; }
            else if ($int == 1) { return 0; }
            else { return 0; }
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
        <a href="Class Roster.php">Class Roster</a>
        <a href="ProfSchedule.php">Schedule</a>
        <a href="searchClasses.php">Search for classes</a>
        <a href="ClassRoster.php">Class Roster</a>
        <a href="AddClass.php">Add Class</a>
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