<?php
require 'info.php';
require 'functions.php';
checkDBCon($mysqli);
$dbSelect = mysqli_select_db($mysqli, 'litebasecms');
?>

<html>
    <head>
        <title>BaseLiteCMS</title>
        <style>
            #posts{
                background-color: red;
                width: 100%;
            }
        </style>
    </head>
    <body>
        <div id="posts">
            <?php 
            if($dbSelect){
                getPost($mysqli);
            } else {
                echo "ERROR";
            } 
            ?>
        </div>
    </body>
</html>
