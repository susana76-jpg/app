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
 * Param: cliente
 * Listado de facturas con presupuesto aceptado y orden de fabricación finalizada, por id usuario .
*/

if(isset($_GET['cliente']) and is_numeric($_GET['cliente'])){

    $idCliente = ((int)$_GET['cliente']);
	
    $sql = "SELECT fac.*, vc.id_vehiculo_cliente,pre.id_presupuesto_cliente,pre.num_presupuesto, 
            cit.id_cita, cit.id_empleado_asignado, vc.id_vehiculo_cliente, vc.matricula, vmo.modelo, vm.marca
            FROM facturas_clientes fac 
            JOIN ordenes_reparaciones ord ON ord.ID_ORDEN_REPARACION = fac.ID_ORDEN_REPARACION 
            JOIN presupuestos_clientes pre ON pre.ID_PRESUPUESTO_CLIENTE = ord.ID_PRESUPUESTO
            JOIN citas_asignadas cit ON cit.id_cita = pre.id_cita
            JOIN vehiculos_clientes vc ON vc.ID_VEHICULO_CLIENTE = cit.ID_VEHICULO_CLIENTE
            JOIN vehiculo_trim vt ON vt.id_vehiculo_trim = vc.id_vehiculo_trim
            JOIN vehiculo_modelo vmo ON  vmo.id_modelo = vt.id_modelo
            JOIN vehiculo_marca vm ON vm.id_marca = vmo.id_marca
            WHERE pre.aceptado = 1
            AND ord.finalizado =1
            AND vc.id_usuario = ? order by fac.fecha desc";
	

    if($query = $mysqli->prepare($sql)){

        $query->bind_param("i", $idCliente );
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