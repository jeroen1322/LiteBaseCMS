<?php 
require 'resources/info.php';

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
            title TEXT NOT NULL,
            text TEXT NOT NULL,
            reg_date TIMESTAMP
    )";
    
    if($mysqli->query($table) === FALSE){
        echo "Error creating table... " . $mysqli->error;
    }
}

function handlePosts($mysqli, $conn){
    $getPost = "SELECT * FROM articles ORDER BY id DESC";
    $result = $mysqli->query($getPost);
    
    if($result->num_rows > 0){
        while($row = $result->fetch_assoc()){
            $id = $row['id'];
            $nameDel = 'del'.$id;
            $nameEdit = 'edit'.$id;
            echo "<div id='del'><form action='' method='post'><input type=submit name='$nameDel' value='Delete post'></form></div>";
            echo "<div id='edit'><form action='' method='post'><input type=submit name='$nameEdit' value='Edit post'></form></div><br>";
            echo "<div id='title'><h4> " . $row['title'] . "</h4></div>";
            echo "<div id='text'> " . $row['text'] . "</div><br>";
            echo "<div id='id'>ID:  " . $id . "</div>";
            echo "<div id='time'>Posted on: " . $row['reg_date'] . "</div><br>";
            echo "<br>";
            
            if(isset($_POST[$nameDel])){
                $sql = "DELETE FROM articles WHERE id = $id LIMIT 1";
                if($conn->query($sql)){
                    echo "Post deleted. -- Refresh to see changes.";
                } else {
                    echo "Could not delete post";
                }
            }
            
            if(isset($_POST[$nameEdit])){
                echo "<form action='' method='post'>
                        <input type='text' name='edit' placeholder='Put in new text here' autocomplete='no'>
                        <input type='submit' name='editSubmit' value='Send'>
                    </form>";
                
            }
            
            echo "<hr>";
            
        }
    } else {
        echo "0 results --- Click <a href='./admin.php'>here</a> to add an article";
        echo $mysqli->error;
    }
    
}

function addPost($conn){
    if(isset($_POST['submit'])){

        $title = htmlspecialchars($_POST['title']);
        $text = htmlspecialchars($_POST['text']);

        $insert = "INSERT INTO articles (title, text) VALUES ('$title', '$text');";
        
        if($title != "" && $text != ""){
            $conn->query($insert);
            echo "<div id='posts'>The article was added successfully! Click <a href='./index.php'>here</a> to view it.</div>";
        } else {
            echo "<div id='posts'>Something went wrong while posting the article. <br> Have you filled in the title and text?</div>";
        }
    }
}
