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
        <a href="Dashboard.html">Home</a>
        <a href="WeeklySchedule.html">Schedule</a>
        <a href="searchClassesTemplate.php">Search for Classes</a>
        <a href="AcademicRequirements">Academic Requirements</a>
        <a href="Enrollment.php">Enroll</a>
        <a href="Discussion.html">Discussion Board</a>
    </div>

</head>
<body>

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
        
        <input type='submit' name='submit' value='Search'>
    <br>
    <br>

    <p>
        <?php
            session_start();

            // if(!isset($_SESSION["sID"]))
            // { 
            //     header("Location: 'project.php?msg=Please Login First'", true, 303);
            //     exit; 
            // }

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

</body>
</html>
