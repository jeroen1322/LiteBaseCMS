<?php 

require (__dir__).'/info.php';
require (__dir__).'/functions.php';

//Check connection to the MYSQL server
if($mysqli->connect_error){
    die("Connection failed: " . $mysqli->connect_error);
}else{
    
    if(isset($_POST['submit'])){

        $title = $_POST['title'];
        $text = $_POST['text'];

        $insert = "INSERT INTO articles (title, text) VALUES ('$title', '$text');";

        if($mysqli->query($insert) === TRUE){
            echo "The article was added succefully.<br><br>";
            echo "<a href='index.php'/><button>Go to homepage</button></a>";
        } else {
           echo "ERROR: " . $insert . "<br>" . $mysqli->error; 
        }
    }
}




$mysqli->close();
