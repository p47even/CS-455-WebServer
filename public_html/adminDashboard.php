<!DOCTYPE html>
<html>
        <head>
                <title>Welcome Admin!</title>
                <link rel="stylesheet" href="dashboardStyling.css"/>

                <style>
        .toolbar{
            background-color: maroon;
        }
        .toolbar a:hover{
            background-color:white;
            color: black
        }

        .toolbar a{
            padding: 15px 15px;
            color: white;
            font-size: 20px;
            text-decoration: none;
        }
        table, th, td{
            border: 1px solid black;
            border-collapse: collapse;
        }

        table.center {
            margin-left: auto;
            margin-right: auto;
        }

        th{
            color: maroon;
        }
        h2{
            text-align: center;
        }
    </style>
    <div class="toolbar">
    <a href="adminDashboard.php">Home</a>

        <a href="addFacultyHandler.php">Add New Faculty</a>
        <a href="logout.php" class="logout">Logout</a>

    </div>
        </head>
        <body>
            <?php
                session_start();


                if(isset($_GET["msg"])){
                    $error_message = $_GET["msg"];

                    if(strlen($error_message) >= 0){
                        echo $error_message;

                    }
                }

                if(!isset($_SESSION["aID"]))
                {
                    $loginUrl = 'aProject.php?msg=Please Login First';
                    header("Location: $loginUrl", true, 303);
                    exit;
                }
            ?>
            <img src = "./sugedpount.jpg" alt = "Welcome!" style="margin-top: 35px; padding-left: 480px">
        </body>
</html>
