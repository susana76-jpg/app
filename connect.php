<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//local
$server="localhost";
$user="root";
$password = "";
$db ="project_dam";

//remoto
//$server = 'localhost';
//$user = 'proyectodam';
//$password = 'proyectodam';
//$db = 'project_dam';

//local
$mysqli = new mysqli($server, $user, $password, $db);


if (! $mysqli->connect_errno) {
    //echo "conexión ok";
}else{
    echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
}


?>