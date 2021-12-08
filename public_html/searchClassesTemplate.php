<!DOCTYPE html>
<html>
<head>
<style>
        .toolbar{
            background-color: maroon;
        }
        .toolbar a:hover{
            background-color:white;
            color: black
        }

        .toolbar a{
            padding: 15px 15px;
            color: white;
            font-size: 20px;
            font-family: arial;
            text-decoration: none;
        }
        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
            font-family: arial;
            font-size:20px;
            border-style: dotted;
            padding: 15px 15px;
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
        form{
            font-family: arial;
            margin-left: 5px;
        }
    </style>
    <div class="toolbar">
        <a href="dashboard.php">Home</a>
        <a href="WeeklySchedule.php">Schedule</a>
        <a href="searchClassesTemplate.php">Search for Classes</a>
        <!-- <a href="AcademicRequirements">Academic Requirements</a> -->
        <a href="Enrollment.php?msg=">Enroll</a>
        <!-- <a href="Discussion.html">Discussion Board</a> -->
        <a href="4YearPlan.php">Four Year Plan</a>
        <a href="logout.php" class="logout">Logout</a>
    </div>
    <title>Class Search</title>
</head>
<body style = "background-color:linen">
<h1 style = "color:beige;font-family:arial;background-color:maroon;text-align:center"> Search for Classes </h1>

        <form action='./searchClasses.php' method='post'>
        courseID: <input type='text' name='courseID' id='courseID'><br>

        <form action='./searchClasses.php' method='post'>
        deptID: <input type='text' name='deptID' id='deptID'><br>

        <form action='./searchClasses.php' method='post'>
        courseName: <input type='text' name='courseName' id='courseName'><br>

        <form action='./searchCourses.php' method='post'>
        semester: <select name='semester' id='semester'>
                  <option value=''>---</option>
                  <option value='fall'>Fall Semester</option>
                  <option value='spring'>Spring Semester</option>
                  <option value='fallOnly'>Fall Only</option>
                  <option value='springOnly'>Spring Only</option>
        
        <input type='submit' name='submit' value='Search'>
    <br>
    <br>
<!--
    <p>
                
            session_start();
            /*
            if(!isset($_SESSION["sID"]))
            { 
                 header("Location: 'project.php?msg=Please Login First'", true, 303);
                 exit; 
            }
            */
            $_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];

            if(isset($_SESSION["courAttrQuer"]) and count($_SESSION["courAttrQuer"]) != 0)
            {
                foreach($_SESSION["courAttrQuer"] as $tuple) 
                {
                    echo "<font color='blue'>$tuple[courseID] $tuple[deptID] $tuple[courseName] $tuple[fallSemester] $tuple[springSemester]<br></font>";
                }
                unset($_SESSION["courAttrQuer"]);
            }
        ?>
    </p>
        -->
    <table>
        <tr>
            <?php 
                echo "<th>Course ID</th>";
                echo "<th>Department ID</th>";
                echo "<th>Course Name</th>";
                echo "<th>Taught in Fall</th>";
                echo "<th>Taught in Spring</th>";
                ?>
        </tr>
        <tr>
            
        <?php 
        session_start();
        
        if(!isset($_SESSION["sID"]) and !isset($_SESSION["fID"])) // 
        { 
             header("Location: project.php?msg=Please Login First", true, 303);
             exit; 
        }
        
        $_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];
        $numAttrs = 5;
        $fallInd = 3;
        $sprInd = 4;
        if(isset($_SESSION["courAttrQuer"]) and count($_SESSION["courAttrQuer"]) != 0)
        {
            foreach($_SESSION["courAttrQuer"] as $tuple) 
            {
                $str = "<tr>";
                for ($i = 0; $i < $numAttrs; $i++){
                    if ($i == $fallInd || $i == $sprInd){
                        if($tuple[$i] == 1){
                            $tuple[$i] = '✓';
                        }
                        else{
                            $tuple[$i] = '✗';
                        }
                    }
                    $str .= '<td>'.$tuple[$i].'</td>';
                }
                $str .= "</tr>";
                echo $str;
            }
            unset($_SESSION["courAttrQuer"]);
        }
        
        ?>
    </table>

</body>
</html>
