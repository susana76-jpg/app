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

/**
 * Method: GET
 * Param: idUsuario
 * Listado de averías atendidas y facturadas por id de usuario.
*/

if(isset($_GET['idUsuario'])){
        
    $idUsuario = (int)($_GET['idUsuario']);

    if($query = $mysqli->prepare("SELECT distinct c.*, vc.id_vehiculo_cliente, vc.matricula, vc.kilometraje, vt.id_vehiculo_trim, 
                                    vmo.modelo, vm.marca, pr.id_presupuesto_cliente, pr.num_presupuesto, f.num_factura, pr.aceptado as presupuesto_aceptado , o.finalizado as orden_finalizada  
                                    FROM citas_asignadas c
                                    JOIN vehiculos_clientes vc ON vc.id_vehiculo_cliente = c.id_vehiculo_cliente
                                    JOIN vehiculo_trim vt ON vt.id_vehiculo_trim = vc.id_vehiculo_trim
                                    JOIN vehiculo_modelo vmo ON  vmo.id_modelo = vt.id_modelo
                                    JOIN vehiculo_marca vm ON vm.id_marca = vmo.id_marca
                                    JOIN presupuestos_clientes pr ON c.id_cita = pr.id_cita 
                                    JOIN ordenes_reparaciones o ON pr.id_presupuesto_cliente = o.id_presupuesto
                                    JOIN facturas_clientes f ON o.id_orden_reparacion = f.id_orden_reparacion
                                    WHERE c.id_usuario = ? order by c.fecha desc, c.hora desc;")){

        $query->bind_param("i", $idUsuario );
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
    } else {
    echo 'Disculpe, la consulta no está bien formulada. Vuelva a intentarlo, por favor.';
}

}
$mysqli->close();

?>