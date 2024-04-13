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
* Elimina una cita por su id_cita
* https://www.focused-kepler.85-214-239-118.plesk.page/app/clientes/deleteCitaById.php?id_cita=6
* http://localhost/app/clientes/deleteCitaById.php?id_cita=7
* 
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