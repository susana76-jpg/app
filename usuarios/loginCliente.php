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
 * Devuelve usuario por su email y password.
*/

    if( isset($_POST['email']) and isset($_POST['password'])){
        
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = $mysqli->real_escape_string($_POST['password']);
    
    
        if ($resultado = $mysqli->prepare("SELECT * FROM clientes WHERE email = ? and password= ?")) {
                  
            $resultado->bind_param("ss", $email, $password);
            
            if($resultado->execute()){
                echo "Se ha realizado el alta de cliente correctamente.";
            }else{
                echo "No se ha realizado el alta de cliente correctamente.";
            }  
        } else{
            echo 'No se están enviando correctamente los datos';
        }

    $mysqli->close();

    }

?>