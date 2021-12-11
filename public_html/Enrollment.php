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

</head>
<body>

    <form action='./validClassQuery.php' method='post'>
        courseID: <input type='text' name='courseID' id='courseID'><br>

        <form action='./validClassQuery.php' method='post'>
        deptID: <input type='text' name='deptID' id='deptID'><br>

        <form action='./validClassQuery.php' method='post'>
        courseName: <input type='text' name='courseName' id='courseName'><br>

        <form action='./validClassQuery.php' method='post'>
        meetTime: <input type='text' name='meetTime' id='meetTime'>
        
        <form action='./validClassQuery.php' method='post'>
        endTime: <input type='text' name='endTime' id='endTime'><br>

        <form action='./validClassQuery.php' method='post'>
        location: <input type='text' name='location' id='location'><br>

        <form action='./validClassQuery.php' method='post'>
        semester: <select name='semester' id='semester'>
                  <option value=''>---</option>
                  <option value='fall'>Fall Semester</option>
                  <option value='spring'>Spring Semester</option>
        
        <br><input type='submit' name='submit' value='Search'> <br>

        
    <p>
        <?php
            session_start();

            // If the user is not signed in to a student accoutn, redirect them to login page
            if(!isset($_SESSION["sID"]))
            { 
                $loginUrl = 'project.php?msg=Please Login First';
                header("Location: $loginUrl", true, 303);
                exit; 
            }
            
            // Set redirection url so it can return here
            $_SESSION['redirect_url'] = $_SERVER['PHP_SELF'];

            // Display search results
            echo "<h>Search Results: </h><br>";
            if(isset($_SESSION["courEnrolQuer"]) and count($_SESSION["courEnrolQuer"]) != 0)
            {
                $counter = 0;
                $previous_tups = array();
                foreach($_SESSION["courEnrolQuer"] as $tuple) 
                {
                    $this_tup = array($tuple['courseID'], $tuple['section']);
                    
                    if(!in_array($this_tup, $previous_tups))
                    {
                        $semesterStr = "Fall/Spring";
                    if($tuple[fallSemester] == 1 && $tuple[springSemester] == 0)
                    {
                        $semesterStr = "Fall";
                    }
                    else
                    {
                        $semesterStr = "Spring";
                    }
                    
                        echo "$tuple[courseID] $tuple[deptID] $tuple[courseName] $tuple[section]  $semesterStr <a href='./addToCart.php?index=$counter'>  Add To Cart</a><br>";
                        array_push($previous_tups, $this_tup);
                    }

                   echo "<font color='blue'>$tuple[meetDay] $tuple[meetTime] -> $tuple[endTime] $tuple[location]</font><br>";

                   $counter++;
                }
            }
            
            // Display error / success message if any
            echo "<br><br><br><font color='red'>".$_GET['msg']."</font><br>";

            echo "<br><br><br><h>Cart:<h><br>";

            // Display current cart
            if(isset($_SESSION["cart"]) and count($_SESSION["cart"]) > 0)
            {
                $counter = 0;
                foreach($_SESSION["cart"] as $tuple) 
                {
                    $semesterStr = "Fall/Spring";
                    if($tuple[fallSemester] == 1 && $tuple[springSemester] == 0)
                    {
                        $semesterStr = "Fall";
                    }
                    else
                    {
                        $semesterStr = "Spring";
                    }

                   echo "<font color='blue'>$tuple[courseID] $tuple[deptID] $tuple[courseName] $tuple[section] $semesterStr</font> <a href='./removeFromCart.php?index=$counter'>  Remove</a><br>";
                   $counter++;
                }
            }
        ?>
        <a href="./enroll.php">Enroll</a>
    </p>

</body>
</html>
