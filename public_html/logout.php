<?php
    session_start();
    
    if(isset($_SESSION["sID"]))
    {
        unset($_SESSION["sID"]);
    }

    if(isset($_SESSION["fID"]))
    {
        unset($_SESSION["fID"]);
    }

    if(isset($_SESSION["cart"]))
    {
        unset($_SESSION["cart"]);
    }

    $redirect_url = "./project.php?msg=Successfully Logout";
    header("Location: $redirect_url", true, 303);
    exit;
?>