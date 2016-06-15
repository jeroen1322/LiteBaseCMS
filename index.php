<?php
require (__dir__).'/info.php';
require (__dir__).'/functions.php';
checkDBCon($mysqli);
$dbSelect = mysqli_select_db($mysqli, 'litebasecms');


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
    ?>
    <html>
        <head>
            <title>BaseLiteCMS</title>
            <style>
                body{
                    width: 100%;   
                    background-color: #A1A1A1;
                }
                
                #posts{
                    background-color: #CACBCC;
                    margin: auto;
                    width: 60%;
                    border: 1px solid #E1E4E6;
                    padding: 10px;
                    font-family: calibri;
                }
                
                #title{
                    text-align: center;
                }
                
                #text{
                    margin-left: 75px;
                    margin-right: 75px;
                    background-color: #D3D3D3;
                    min-height: 70px;
                    padding-top: 10px;
                    padding-left: 20px;
                    padding-right: 20px;
                }
                
                #id{
                    font-style: italic;
                }
                
            </style>
        </head>
        <body>
            <div id="posts">
                <?php 
                if($dbSelect){
                    getPost($mysqli);
                } 
                ?>
            </div>
        </body>
    </html>
<?php
}
?>

