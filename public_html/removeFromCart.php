<!DOCTYPE html>
<html>
<body>
    <?php
    $index = $_GET["index"];

        session_start();

        if(!isset($_SESSION["sID"]))
            { 
                $loginUrl = 'project.php?msg=Please Login First';
                header("Location: $loginUrl", true, 303);
                exit; 
            }

        \array_splice($_SESSION['cart'], (int) $index, 1);

        $redirect_url = $_SESSION['redirect_url']."?msg="; 
        unset($_SESSION['redirect_url']);
        header("Location: $redirect_url", true, 303);
        exit; 
    ?>

</body>
</html>