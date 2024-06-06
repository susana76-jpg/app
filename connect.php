<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$server="localhost";
$user="root";
$password = "";
$db ="project_dam";

$mysqli = new mysqli($server, $user, $password, $db);

if (! $mysqli->connect_errno) {
    //echo "conexión ok";
}else{
    echo "Fallo al conectar a MySQL: " . $mysqli->connect_error;
}


?>