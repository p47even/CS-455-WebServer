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
        <a href="ProfSchedule.php">Schedule</a>
        <a href="searchClasses.php">Search for classes</a>
        <a href="4YearPlan.php">Four Year Plan</a>
    </div>
</head>
<body>
    <h3>Do you want to: </h3>
    <?php
        echo
        "<form action='./AddClassForm.php' method='post'>
        <input type='checkbox'>Add a new class to catalogue<br>
        <form action='./removeClass.php' method='post'>
        <input type='checkbox'>Delete a class<br>
        <input type='submit' value='Submit'>";
    ?>
</body>
</html>
