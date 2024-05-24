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

    if( isset($_GET['id_orden_reparacion'])){
        
        $idOrdenRepara = (int)$_GET['id_orden_reparacion'];
        $query="SELECT li.* FROM lineas_presupuesto li JOIN presupuestos_clientes pre ON li.id_presupuesto=pre.id_presupuesto_cliente JOIN ordenes_reparaciones o ON pre.id_presupuesto_cliente=o.id_presupuesto JOIN facturas_clientes f ON o.id_orden_reparacion=f.id_orden_reparacion WHERE o.id_orden_reparacion=?";
        $resultado = $mysqli->prepare($query);
        $resultado->bind_param("i", $idOrdenRepara);
    
        if ($resultado->execute()) {
                  
            $results=$resultado->get_result();
            
            if($results->num_rows>0){
                while($row=$results->fetch_assoc()){
                    $RESULTADOS[]=$row;
                }
                echo json_encode($RESULTADOS);
            }else{
                echo "No existen datos de lineas para esa factura";
            }  
        } else{
            echo "No se están enviando correctamente los datos";
        }

    }else{
		echo "No esta recibiendo GET";
	}
 $mysqli->close();
?>