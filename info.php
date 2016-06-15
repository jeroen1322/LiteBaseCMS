<?php
//This is super secret.... Sssshhhh


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


