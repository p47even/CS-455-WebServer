<!DOCTYPE html>
<html>
<body>
    <?php
    $index = $_GET["index"];

        session_start();

        \array_splice($_SESSION['cart'], (int) $index, 1);

        $redirect_url = $_SESSION['redirect_url']; 
        unset($_SESSION['redirect_url']);
        header("Location: $redirect_url", true, 303);
        exit; 
    ?>

</body>
</html>