<!DOCTYPE html>
<html>
<body>
<iframe name="dummyframe" id="dummyframe" style="display: none;"></iframe>

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
        
        <input type='submit' name='submit' value='Search'>
    <br>
    <br>

    <p>
        <?php
            session_start();
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
