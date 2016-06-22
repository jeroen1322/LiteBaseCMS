<?php
//This is super secret.... Sssshhhh
//Put this file outside of public_html and change the links to this file. 

//CONNECTION INFO
$host = 'localhost';
$user = 'root';
$passw = '';
$db = 'litebasecms';
$mysqli = new mysqli($host, $user, $passw);

$dbSelect = mysqli_select_db($mysqli, 'litebasecms');

if($dbSelect === TRUE){
    $conn = new mysqli($host, $user, $passw, $db);
} 


