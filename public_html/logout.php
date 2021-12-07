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

    if(isset($_SESSION["courAttrQuer"]))
    {
        unset($_SESSION["courAttrQuer"]);
    }

    if(isset($_SESSION["courEnrolQuer"]))
    {
        unset($_SESSION["courEnrolQuer"]);
    }

    $redirect_url = "./project.php?msg=Successfull Logout";
    header("Location: $redirect_url", true, 303);
    exit;
?>