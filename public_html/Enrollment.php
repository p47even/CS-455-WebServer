<!DOCTYPE html>
<html>
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
        <a href="searchClasses.php">Search for classes</a>
        <a href="AcademicRequirements">Academic Rqueirements</a>
        <a href="Enrollment.html">Enroll</a>
        <a href="Discussion.html">Discussion Board</a>
    </div>

    <h2>Shopping Cart</h2>
</head>
<body>

    <form action='./searchClasses.php' method='post'>
        courseID: <input type='text' name='courseID' id='courseID'><br>

        <form action='./searchClasses.php' method='post'>
        deptID: <input type='text' name='deptID' id='deptID'><br>

        <form action='./searchClasses.php' method='post'>
        courseName: <input type='text' name='courseName' id='courseName'><br>

        <form action='./searchClasses.php' method='post'>
        meetTime: <input type='text' name='meetTime' id='meetTime'>
        
        <form action='./searchClasses.php' method='post'>
        endTime: <input type='text' name='endTime' id='endTime'><br>

        <form action='./searchClasses.php' method='post'>
        location: <input type='text' name='location' id='location'><br>

        <form action='./searchClasses.php' method='post'>
        semester: <select name='semester' id='semester'>
                  <option value=''>---</option>
                  <option value='fall'>Fall Semester</option>
                  <option value='spring'>Spring Semester</option>
        <br>
        
        <input type='submit' name='submit' value='Search'>

    <?php
        try {

            //open connection to the university's database file
            $db = new PDO('sqlite:' . './uni.db');      // <------ Line 13
    
            //set errormode to use exceptions
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            
            echo "<h>Search For Classes:<h><br>";

            

          
            $db = null;
        }
        catch(PDOException $e) {
            die('Exception : '.$e->getMessage());
        }


        // echo 
        //     "<form action="/EnrollmentHandler.php">
        //         <table class="center">
        //             <tr>
        //                 <th>Select</th>
        //                 <th>Course Number</th>
        //                 <th>Course Name</th>
        //                 <th>Meeting Time</th>
        //                 <th>Location</th>
        //             </tr>";
        //             foreach($classes as $class){
        //                 echo 
        //                     "<tr>
        //                         <td><input type="checkbox"></td>
        //                         <td value='".$class["courseID"]."'></td>
        //                         <td value='".$class["courseName"]."'></td>
        //                         <td  value='".$class["deptID"]."'></td>
        //                         <td value='".$class["location"]."'></td>";
        //             }
                
        //         echo  "</table>
        //         <input type='submit' value='Enroll'>
        //     </form>"
    ?>
</body>
</html>
