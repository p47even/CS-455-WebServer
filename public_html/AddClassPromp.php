<!DOCTYPE html>
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
    </style>
    <div class="toolbar">
        <a href="Dashboard.html">Home</a>
        <a href="WeeklySchedule.php">Schedule</a>
        <a href="searchClasses.php">Search for classes</a>
        <a href="AcademicRequirements">Academic Rqueirements</a>
        <a href="Enrollment.php">Enroll</a>
        <a href="4YearPlan.php">Four Year Plan</a>
    </div>
</head>
<body>
    <h3>Do you want to: </h3>
    <?php
        echo
        "<form action='./AddClassForm.php' method='post'>
        <input type='checkbox'>Add a new class to catalogue<br>
        <form action='./EditSchedule.php' method='post'>
        <input type='checkbox'>Add class to schedule<br>
        <input type='submit' value='Submit'>";
    ?>
</body>
</html>
