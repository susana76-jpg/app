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
Datos de los presupuestos por id de cliente
llamada:  http://localhost/proyecto_dam/admin/presupuestoByCliente.php?cliente=1
*/


if(isset($_GET['cliente']) and is_numeric($_GET['cliente'])){
    
    $sql = "SELECT pred.* FROM presupuestos_clientes fac 
            JOIN ordenes_reparaciones ord ON ord.ID_ORDEN_REPARACION = fac.ID_ORDEN_REPARACION 
            JOIN presupuestos_clientes pre ON pre.ID_PRESUPUESTO_CLIENTE = ord.ID_PRESUPUESTO
            JOIN citas_asignadas cit ON cit.ID_VEHICULO_CLIENTE = pre.ID_CITA_ASIGNADA
            JOIN vehiculos_clientes vc ON vc.ID_VEHICULO_CLIENTE = cit.ID_VEHICULO_CLIENTE
            AND vc.id_cliente = ?";

    if($query = $mysqli->prepare($sql)){

        $query->bind_param("i", $_GET['cliente']);
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