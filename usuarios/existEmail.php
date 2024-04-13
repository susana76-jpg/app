<?php
//Cabeceras HTTP en PHP para permitir el acceso CORS con Apache o con otro servidor web
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

header('Content-Type: application/json; charset=utf-8');

include_once("../connect.php");
/** 
 * Comprueba si existe el email enviado por método POST
 * Llamada: http://localhost/app/usuarios/existEmail.php
*/

if(isset($_POST['email'])) {

    if($query = $mysqli->prepare("SELECT * from usuarios where email = ?")){

        $email = $_POST['email'];
        $query->bind_param("s", $email);
        $query->execute();
        $result = $query->get_result();
       
        if ($result->num_rows > 0) {
            echo "1";
        }else{
            echo "0";
        }
    }
}
$mysqli->close();
?>