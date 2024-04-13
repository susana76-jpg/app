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
/*
 * Actualiza el password y firebase cuando el usuario se loga en firebase
 * llamada: http://localhost/app/usuarios/nuevoUsuario.php
 * servidor: https://www.focused-kepler.85-214-239-118.plesk.page/app/usuarios/nuevoUsuario.php
*/

    if(isset($_POST['email']) && isset($_POST['password']) && isset($_POST['firebase'])){
        
        $password = $mysqli->real_escape_string($_POST['password']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $firebase = $_POST['firebase'];
        
    
        if ($resultado = $mysqli->prepare("UPDATE usuarios set password = ? , firebase = ? WHERE email = ?")) {
                  
            $resultado->bind_param("sss", $password, $firebase $email);
            
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