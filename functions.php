<?php 
require (__dir__).'/info.php';

function checkDBCon($mysqli){
    if($mysqli->connect_error){
        die("Connection failed: " . $mysqli->connect_error);
    }
}

//Function to create a DataBase called 'litebasecms' and a table called 'articles' 
function createDB($mysqli){
    
    $sql = "CREATE DATABASE LiteBaseCMS";
    if($mysqli->query($sql) === TRUE){
        echo "Database created successfully. Refresh to continue.";
    } else {
        echo "Error creating database.. " . $mysqli->error;
    }
    
}

function createTable($mysqli){
    //Check create table 'articles' if it doesn't exist already
    $table = "CREATE TABLE IF NOT EXISTS articles (
            id int NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(id),
            title VARCHAR (100) NOT NULL,
            text VARCHAR (100) NOT NULL,
            reg_date TIMESTAMP
    )";
    
    if($mysqli->query($table) === FALSE){
        echo "Error creating table... " . $mysqli->error;
    }
}

function getPost($mysqli){
    $getPost = "SELECT * FROM articles order by id desc";
    $result = $mysqli->query($getPost);
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<div id='title'><h2> " . $row['title'] . "</h2></div>";
            echo "<div id='text'> " . $row['text'] . "</div><br>";
            echo "<div id='id'>ID:  " . $row['id'] . "</div>";
            echo "<hr>";
        }
    } else {
        echo "0 results --- Click <a href='admin.php'>here</a> to add an article";
        echo $mysqli->error;
    }
}

function addPost($conn){
    if(isset($_POST['submit'])){

        $title = $_POST['title'];
        $text = $_POST['text'];

        $insert = "INSERT INTO articles (title, text) VALUES ('$title', '$text');";
        
        if($title != "" && $text != ""){
            $conn->query($insert);
            echo "<div id='posts'>The article was added successfully! Click <a href='index.php'>here</a> to view it.</div>";
        } else {
            echo "<div id='posts'>Something went wrong while posting the article. <br> Have you filled in the title and text?</div>";
        }
    }
}
