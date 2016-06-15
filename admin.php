<?php
require '/resources/info.php';
require 'resources/functions.php';
    //Check connection to the MYSQL server
    if($mysqli->connect_error){
        die("Connection failed: " . $mysqli->connect_error);
    }else{
        addPost($conn);
    }
?>
<html>
    <head>
        <title>Admin Pannel - LiteBaseCMS</title>
        <link rel="stylesheet" type="text/css" href="resources/style/style.css">
    </head>
    <body>
        <div id="posts">
            <form action="admin.php" method="post">
                <input type="text" name="title" placeholder="Title" autocomplete="off"><br><br>
                <input type="text" name="text" placeholder="Add text" autocomplete="off">
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </body>
</html>