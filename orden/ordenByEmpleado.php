<?php
//Modo indicación errores.
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);
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

    if( isset($_GET['id_empleado_asignado'])){
        
        $id = (int)$_GET['id_empleado_asignado'];
        $query="SELECT o.*,p.num_presupuesto,u.nombre,vh.matricula, m.marca,ci.id_empleado_asignado FROM ordenes_reparaciones o JOIN presupuestos_clientes p ON o.id_presupuesto=p.id_presupuesto_cliente JOIN citas_asignadas ci ON p.id_cita=ci.id_cita JOIN usuarios u ON ci.id_usuario=u.id_usuario JOIN vehiculos_clientes vh ON u.id_usuario=vh.id_usuario JOIN vehiculo_trim tr ON vh.id_vehiculo_trim=tr.id_vehiculo_trim JOIN vehiculo_modelo mo ON tr.id_modelo=mo.id_modelo JOIN vehiculo_marca m ON mo.id_marca=m.id_marca WHERE ci.id_empleado_asignado=?";
        $resultado = $mysqli->prepare($query);
		$resultado->bind_param("i",$id);
    
        if ($resultado->execute()) {
                  
            $results=$resultado->get_result();
            
            if($results->num_rows>0){
                while($row=$results->fetch_assoc()){
                    $RESULTADOS[]=$row;
                }
                echo json_encode($RESULTADOS);
            }else{
                echo "No existen datos de ordenes.";
            }  
        } else{
            echo "No se están enviando correctamente los datos";
        }

    }else{
		echo "No esta recibiendo GET";
	}
 $mysqli->close();
?>