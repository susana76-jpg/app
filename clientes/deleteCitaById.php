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
 * Param: id_cita
 * Elimina cita por id.
*/

if(isset($_GET['id_cita'])){
       

        $idCita = (int) $_GET['id_cita'];
        $sql = "DELETE FROM citas_asignadas where id_cita = ?;";

        // prepare the statement for execution
        $statement = $mysqli->prepare($sql);
        $statement->bind_param("i", $idCita );

        // execute the statement
        if ($statement->execute()) {
        echo 'Cita eliminada';
        }



} else {
    echo 'Disculpe, la consulta no está bien formulada. Vuelva a intentarlo, por favor.';
}

$mysqli->close();

?>