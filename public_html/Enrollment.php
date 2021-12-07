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
            text-decoration: none;
        }
        .logout
        {
            float: right;
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
        <a href="AcademicRequirements">Academic Requirements</a>
        <a href="Enrollment.php">Enroll</a>
        <a href="Discussion.html">Discussion Board</a>
        <a href="4YearPlanHelper.php">Four Year Plan</a>
        <a href="4YearPlanHelper.php" class="logout">Logout</a>
    </div>

</head>
<body>

    <form action='./searchCourses.php' method='post'>
        courseID: <input type='text' name='courseID' id='courseID'><br>

        <form action='./searchCourses.php' method='post'>
        deptID: <input type='text' name='deptID' id='deptID'><br>

        <form action='./searchCourses.php' method='post'>
        courseName: <input type='text' name='courseName' id='courseName'><br>

        <form action='./searchCourses.php' method='post'>
        meetTime: <input type='text' name='meetTime' id='meetTime'>
        
        <form action='./searchCourses.php' method='post'>
        endTime: <input type='text' name='endTime' id='endTime'><br>

        <form action='./searchCourses.php' method='post'>
        location: <input type='text' name='location' id='location'><br>

        <form action='./searchCourses.php' method='post'>
        semester: <select name='semester' id='semester'>
                  <option value=''>---</option>
                  <option value='fall'>Fall Semester</option>
                  <option value='spring'>Spring Semester</option>
        
        <br><input type='submit' name='submit' value='Search'> <br>

        
    <p>
        <?php
            session_start();

            if(!isset($_SESSION["sID"]))
            { 
                $loginUrl = 'project.php?msg=Please Login First';
                header("Location: $loginUrl", true, 303);
                exit; 
            }
            
            $_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];

            echo "<h>Search Results: </h><br>";

            if(isset($_SESSION["courAttrQuer"]) and count($_SESSION["courAttrQuer"]) != 0)
            {
                foreach($_SESSION["courAttrQuer"] as $tuple) 
                {
                    echo "<font color='blue'>$tuple[courseID] $tuple[deptID] $tuple[courseName] $tuple[meetDay] $tuple[section] $tuple[meetTime] -> $tuple[endTime] $tuple[location] $tuple[fallSemester] $tuple[springSemester]</font><a href='./addToCart.php?meetDay=$tuple[meetDay]&section=$tuple[section]&courseID=$tuple[courseID]'>  Add To Cart</a><br>";
                }
                unset($_SESSION["courAttrQuer"]);
            }
            
            echo "<br><br><br><h>Cart:<h><br>";

            if(isset($_SESSION["cart"]) and count($_SESSION["cart"]) > 0)
            {
                $counter = 0;
                foreach($_SESSION["cart"] as $tuple) 
                {
                   echo "<font color='blue'>$tuple[courseID] $tuple[deptID] $tuple[courseName] $tuple[meetDay] $tuple[section] $tuple[meetTime] -> $tuple[endTime] $tuple[location] $tuple[fallSemester] $tuple[springSemester]</font> <a href='./removeFromCart.php?index=$counter'>  Remove</a><br>";
                   $counter++;
                }
            }
        ?>
        <a href="./enroll.php">Enroll</a>
    </p>

</body>
</html>
