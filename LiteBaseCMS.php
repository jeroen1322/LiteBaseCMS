<?php 

require 'info.php';
require 'functions.php';

//Check connection to the MYSQL server
if($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}


//If the database does not exist yet, create it by calling the createDB function
$dbSelect = mysqli_select_db($mysqli, 'litebasecms');
if(! $dbSelect){
    createDB($mysqli);
} else {
    createTable($mysqli);
    echo '
        <form action="LiteBaseCMS.php" method="post">
        <input type="text" name="title" placeholder="Title"><br><br>
        <input type="text" name="text" placeholder="Put your text here"><br><br><br>
        <input type="submit" name="submit" value="Submit">
        </form>
        ';
}

if(isset($_POST['submit'])){
    
    $title = $_POST['title'];
    $text = $_POST['text'];
    
    $insert = "INSERT INTO articles (title, text) VALUES ('$title', '$text');";
    
    if($mysqli->query($insert) === TRUE){
        echo "The article was added succefully.";
    } else {
        echo "ERROR: " . $insert . "<br>" . $mysqli->error; 
    }
}

$mysqli->close();
