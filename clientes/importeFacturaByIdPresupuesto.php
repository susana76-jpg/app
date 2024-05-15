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
 * Param: id_presupuesto
 * Listado de líneas de presupuesto por id presupuesto .
*/

if(isset($_GET['id_presupuesto']) and is_numeric($_GET['id_presupuesto'])){

    $idPresupuesto = ((int)$_GET['id_presupuesto']);
    
    $sql = "SELECT sum(importe) FROM lineas_presupuesto WHERE id_presupuesto = ?";

    if($query = $mysqli->prepare($sql)){

        $query->bind_param("i", $idPresupuesto );
        $query->execute();
    
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $RESULT[]= $row;
            }
            echo json_encode($RESULT);
        }else{
            $RESULT=[];
            echo json_encode($RESULT);
        }
    } else {
    echo 'Disculpe, la consulta no está bien formulada. Vuelva a intentarlo, por favor.';
}
$mysqli->close();

}
?>

