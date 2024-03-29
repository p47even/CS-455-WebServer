<!DOCTYPE html>
<html>
<head>
<style>
        .toolbar{
            background-color: maroon;
        }
        .toolbar a:hover{
            background-color:linen;
            color: black
        }

        .toolbar a{
            padding: 15px 15px;
            color: white;
            font-size: 20px;
            font-family: arial;
            text-decoration: none;
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
    <title>Class Search</title>
</head>
<body style = "background-color:linen">
<h1 style = "color:beige;font-family:arial;background-color:maroon;text-align:center"> Search for Classes </h1>
<!-- form for what parameters user wants defined (to be sent to searchClasses.php) -->
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

    <table>
        <tr>
            <?php 
                echo "<th>Course ID</th>"; //table columns
                echo "<th>Department ID</th>";
                echo "<th>Course Name</th>";
                echo "<th>Taught in Fall</th>";
                echo "<th>Taught in Spring</th>";
                ?>
        </tr>
        <tr>
            
        <?php 
        session_start();
        
        if(!isset($_SESSION["sID"]) and !isset($_SESSION["fID"])) //Return to login screen if ids not set
        { 
             header("Location: project.php?msg=Please Login First", true, 303);
             exit; 
        }
        
        // Set redirect adddress to come back here
        $_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];
        $numAttrs = 5;
        $fallInd = 3; //index of fallSemester attribute
        $sprInd = 4; //index of fallSemester attribute

        // Display results of the search
        if(isset($_SESSION["courAttrQuer"]) and count($_SESSION["courAttrQuer"]) != 0)
        {
            foreach($_SESSION["courAttrQuer"] as $tuple) //build table elements
            {
                $str = "<tr>";
                for ($i = 0; $i < $numAttrs; $i++){
                    if ($i == $fallInd || $i == $sprInd){
                        if($tuple[$i] == 1){ //replace spring and fall semester values (0 and 1) with ✓ and ✗ for simplicity
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
