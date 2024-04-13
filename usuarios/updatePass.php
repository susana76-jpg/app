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
 * Param: email,password
 * Actualiza el email y password del usuario.
*/

    if(isset($_POST['email']) && isset($_POST['password'])){
        
        $password = $mysqli->real_escape_string($_POST['password']);
        $email = $mysqli->real_escape_string($_POST['email']);
        
    
        if ($resultado = $mysqli->prepare("UPDATE usuarios set password = ? WHERE email = ?")) {
                  
            $resultado->bind_param("ss", $password, $email);
            
            if($resultado->execute()){
                echo "Se ha realizado el alta de usuario correctamente.";
            }else{
                echo "No se ha realizado el alta de usuario correctamente.";
            }  
        } else{
            echo 'No se están enviando correctamente los datos';
        }

    $mysqli->close();

    }

?>