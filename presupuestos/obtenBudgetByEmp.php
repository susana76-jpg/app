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
        
        $idEmpleado = (int)$_GET['id_empleado_asignado'];
        $query="SELECT p.*,ci.id_empleado_asignado FROM presupuestos_clientes p JOIN citas_asignadas ci ON p.id_cita=ci.id_cita JOIN vehiculos_clientes v ON ci.id_vehiculo_cliente=v.id_vehiculo_cliente WHERE ci.id_empleado_asignado=?";
        $resultado = $mysqli->prepare($query);
		$resultado->bind_param("i",$idEmpleado);
    
        if ($resultado->execute()) {
                  
            $results=$resultado->get_result();
            
            if($results->num_rows>0){
                while($row=$results->fetch_assoc()){
                    $RESULTADOS[]=$row;
                }
                echo json_encode($RESULTADOS);
            }else{
                echo "No existen datos de presupuestos.";
            }  
        } else{
            echo "No se están enviando correctamente los datos";
        }

    }else{
		echo "No esta recibiendo GET";
	}
 $mysqli->close();
?>