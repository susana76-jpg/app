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
/*
 * Listado de series por id_generación
 * llamada: http://localhost/app/vehiculos/motorBySerieModelo.php?id_serie=457&id_modelo=350
 * servidor: https://www.focused-kepler.85-214-239-118.plesk.page/app/vehiculos/motorBySerieModelo.php?id_serie=457&id_modelo=350
*/

if(isset($_GET['id_serie']) and isset($_GET['id_modelo'])){

    $idSerie = (int)$_GET['id_serie'];
    $idModelo = (int)$_GET['id_modelo'];

    if($query = $mysqli->prepare("SELECT * from vehiculo_trim where id_serie = ? and id_modelo = ? order by version asc")){

        $query->bind_param("ii", $idSerie, $idModelo);
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
    echo 'Disculpe, la consulta no está bien formulada. Vuelva a intentarlo, por favor.';
}

$mysqli->close();

?>