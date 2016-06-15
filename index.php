<?php
require '/resources/info.php';
require 'resources/functions.php';
checkDBCon($mysqli);
$dbSelect = mysqli_select_db($mysqli, 'litebasecms');

if(isset($_POST['del'])){
    delPost($conn);
}

//Check connection to the MYSQL server
checkDBCon($mysqli);
//If the database does not exist yet, create it by calling the createDB function

$dbSelect = mysqli_select_db($mysqli, 'litebasecms');

if(! $dbSelect){
    ?>
    <link rel="stylesheet" type="text/css" href="resources/style/style.css">
    <div id="first_run">
        <p>Hello there! This is the first time you've run this program so it needs a little setup before it is usable. <br> Give me a moment...</p>
    <?php
    createDB($mysqli);
    ?>
    </div>
<?php
} else {
    createTable($mysqli);
    ?>
    <html>
        <head>
            <title>Frontpage - LiteBaseCMS</title>
            <link rel="stylesheet" type="text/css" href="resources/style/style.css">
        </head>
        <body>
            <div id="posts">
                <div id="add">
                    <ul>
                        <li><a href="admin.php">Admin page</a></li>
                        <li>|</li>
                        <li><a href="https://github.com/jeroen1322/LiteBaseCMS">Github Page</a></li>
                        <li>|</li>
                        <li><a href="http://jeroengrooten.nl/#contact">Contact</a></li>
                    </ul>
                    <hr>
                </div>
                <?php 
                if($dbSelect){
                    getPost($mysqli);
                } 
                ?>
                <div id='footer'>
                    <p>| Made with: <a href="https://github.com/jeroen1322/LiteBaseCMS" target="_blank">LiteBaseCMS</a> by: <a href="http://www.jeroengrooten.nl" target="_blank">Jeroen Grooten</a> |  </p>
                </div>
            </div>
        </body>
    </html>
<?php
}
?>

