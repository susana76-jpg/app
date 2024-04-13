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
/*
 * Login del cliente / empleado
 * el id_cliente == id_empleado (si el usuario logado es un empleado)
 * llamada: http://localhost/app/clientes/loginCliente.php
 * servidor: https://www.focused-kepler.85-214-239-118.plesk.page/app/clientes/loginCliente.php
*/

    if( isset($_POST['email']) and isset($_POST['password'])){
        
        $email = $mysqli->real_escape_string($_POST['email']);
        $password = $mysqli->real_escape_string($_POST['password']);
        //$password = base64_decode($password);
    
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