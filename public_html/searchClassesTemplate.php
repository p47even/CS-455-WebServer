<!DOCTYPE html>
<html>
<body>
<iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

        <form action='./searchClasses.php' target="dummyframe" method='post'>
        courseID: <input type='text' name='courseID' id='courseID'><br>

        <form action='./searchClasses.php' target="dummyframe" method='post'>
        deptID: <input type='text' name='deptID' id='deptID'><br>

        <form action='./searchClasses.php' target="dummyframe" method='post'>
        courseName: <input type='text' name='courseName' id='courseName'><br>

        <form action='./searchClasses.php' target="dummyframe" method='post'>
        fallSemester: <input type='text' name='fallSemester' id='fallSemester'><br>
        
        <form action='./searchClasses.php' target="dummyframe" method='post'>
        springSemester: <input type='text' name='springSemester' id='springSemester'><br>
        
        <input type='submit' name='submit' value='Update Info'>
    <br>
    <br>

    <p>
        <?php>
            foreach($_SESSION["courAttrQuer"] as $tuple) {
                echo "<font color='blue'>$tuple[courseID] $tuple[deptID] $tuple[courseName] $tuple[fallSemester] $tuple[springSemester]></font>";
            }
        ?>
    </p>

</body>
</html>
