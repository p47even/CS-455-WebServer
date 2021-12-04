<!DOCTYPE html>
<html>
<body>
        <form action='./searchClasses.php' method='post'>
        courseID: <input type='text' name='courseID' id='courseID'><br>

        <form action='./searchClasses.php' method='post'>
        deptID: <input type='text' name='deptID' id='deptID'><br>

        <form action='./searchClasses.php' method='post'>
        courseName: <input type='text' name='courseName' id='courseName'><br>

        <form action='./searchClasses.php' method='post'>
        fallSemester: <input type='text' name='fallSemester' id='fallSemester'><br>
        
        <form action='./searchClasses.php' method='post'>
        springSemester: <input type='text' name='springSemester' id='springSemester'><br>
        
        <input type='submit' name='submit' value='Update Info'>
    <br>
    <br>

    <?php>
        foreach($_SESSION["courAttrQuer"] as $tuple) {
                echo "<font color='blue'>$tuple[courseID]</font> $tuple[deptID] $tuple[courseName] $tuple[fallSemester] $tuple[springSemester]> </a>";
            }
    ?>
</body>
</html>
