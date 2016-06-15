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
        <link type="text/css" rel="stylesheet" href="resources/style/materialize.min.css"  media="screen,projection"/>
    </head>
    <body>
        <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
        <script type="text/javascript" src="resources/js/materialize.min.js"></script>
        <div id="posts">
            <form action="admin.php" method="post">
                <input type="text" name="title" placeholder="Title" autocomplete="off"><br><br>
                <input type="text" name="text" placeholder="Add text" autocomplete="off"><br>
                <input type="submit" name="submit" value="Submit">
            </form>
        </div>
    </body>
</html>
