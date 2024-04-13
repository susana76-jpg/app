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
 * Busca si es cliente o empleado
 * llamada: http://localhost/app/usuarios/esCliente.php?email=susanaricovara@hotmail.com&password=susana
 * servidor: https://www.focused-kepler.85-214-239-118.plesk.page/app/usuarios/esCliente.php?email=susanaricovara@hotmail.com&password=susana
*/

    if( isset($_POST['email']) and isset($_POST['password'])){
 

if($query = $mysqli->prepare("SELECT es_cliente FROM usuarios WHERE email = ? and password= ?")){

        $query->bind_param("ss", $_POST['email'], $_POST['password']);
        $query->execute();

        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $RESULT= $row["es_cliente"];
                
            }
            echo json_encode($RESULT);
        }else{
            echo "El email introducido no es válido. Vuelva a intentarlo, por favor.";
        }
    }

    }else{
    echo 'El email introducido no es válido. Vuelva a intentarlo, por favor.';
    }

    $mysqli->close();

    

?>