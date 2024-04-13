<?php
//Cabeceras HTTP en PHP para permitir el acceso CORS con Apache o con otro servidor web
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}
include_once("../connect.php");
mysqli_set_charset($mysqli,"utf8");
/**
 * Method: POST
 * Param: nombre,dni_cif,direccion,localidad,codPostal,provincia,telefono,email,password,firebase
 * Inserta nuevo usuario.
*/

    if( isset($_POST['nombre']) and isset($_POST['dni_cif']) 
    and isset($_POST['direccion']) and  isset($_POST['localidad']) and isset($_POST['codPostal']) 
    and isset($_POST['provincia']) and isset($_POST['telefono']) and isset($_POST['email']) 
    and isset($_POST['password']) and isset($_POST['firebase'])){
        
        $nombre = $mysqli->real_escape_string($_POST['nombre']);
        $dni_nif = $mysqli->real_escape_string($_POST['dni_cif']);
        $direccion = $mysqli->real_escape_string($_POST['direccion']);
        $localidad = $mysqli->real_escape_string($_POST['localidad']);
        $codPostal = $mysqli->real_escape_string($_POST['codPostal']);
        $provincia = $mysqli->real_escape_string($_POST['provincia']);
        $telefono = $mysqli->real_escape_string($_POST['telefono']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = $mysqli->real_escape_string($_POST['password']);
        $firebase = $_POST['firebase'];
    
        if ($resultado = $mysqli->prepare("INSERT INTO usuarios (email, nombre, telefono, direccion, cod_postal, localidad, provincia, password,firebase, dni_cif) VALUES (?,?,?,?,?,?,?,?,?,?)")) {
                  
            $resultado->bind_param("ssssssssss", $email, $nombre, $telefono, $direccion, $codPostal, $localidad, $provincia, $password, $firebase, $dni_nif);
            
            if($resultado->execute()){
                echo "Se ha realizado el alta de usuario correctamente.";
            }else{
                echo "No se ha realizado el alta de usuario.";
            }  
        } else{
            echo 'No se están enviando correctamente los datos';
        }

    $mysqli->close();

    }

?>