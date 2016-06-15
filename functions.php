<?php 
require 'info.php';

function checkDBCon($mysqli){
    if($mysqli->connect_error){
        die("Connection failed: " . $mysqli->connect_error);
    }
}

//Function to create a DataBase called 'litebasecms' and a table called 'articles' 
function createDB($mysqli){
    
    $sql = "CREATE DATABASE LiteBaseCMS";
    if($mysqli->query($sql) === TRUE){
        echo "Database created successfully. Reload to continue";
    } else {
        echo "Error creating database.. " . $mysqli->error;
    }
    
}

function createTable($mysqli){
    //Check create table 'articles' if it doesn't exist already
    $table = "CREATE TABLE IF NOT EXISTS articles (
            id int NOT NULL AUTO_INCREMENT,
            PRIMARY KEY(id),
            title VARCHAR (30) NOT NULL,
            text VARCHAR (30) NOT NULL,
            reg_date TIMESTAMP
    )";
    
    if($mysqli->query($table) === FALSE){
        echo "Error creating table... " . $mysqli->error;
    }
}

function getPost($mysqli){
    $getPost = "SELECT * FROM articles";
    $result = $mysqli->query($getPost);
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            echo "<div id='title'><h2> " . $row['title'] . "</h2></div>";
            echo "<div id='text'> " . $row['text'] . "</div><br>";
            echo "<div id='id'>ID:  " . $row['id'] . "</div>";
            echo "<hr>";
        }
    } else {
        echo "0 results<br>";
        echo $mysqli->error;
    }
}
