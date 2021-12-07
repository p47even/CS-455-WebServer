<?php
    session_start();
    
    if(isset($_SESSION["sID"]))
    {
        usnet($_SESSION["sID"]);
    }

    if(isset($_SESSION["fID"]))
    {
        usnet($_SESSION["fID"]);
    }

    if(isset($_SESSION["cart"]))
    {
        usnet($_SESSION["cart"]);
    }

    $redirect_url = "./project.php";
    header("Location: $redirect_url", true, 303);
    exit;
?>