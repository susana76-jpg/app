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
mysqli_set_charset($mysqli,"utf8");
/**
 * Method: GET
 * Param: matricula
 * Listado de vehiculos por matrícula like
*/

if(isset($_GET['matricula'])){
    
    if($query = $mysqli->prepare("SELECT * from vehiculos_clientes where matricula like ? order by id_vehiculo_cliente asc")){

        $matricula = "%".$_GET['matricula']."%";
        $query->bind_param("s", $matricula);
        $query->execute();
    
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $RESULT[]= $row;
            }
            echo json_encode($RESULT);
        }else{
            
            echo "0 results";
        }
    }

}else{
    echo 'El valor introducido no es válido. Vuelva a intentarlo, por favor.';
}

$mysqli->close();

?>