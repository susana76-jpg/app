<?php
//Deteccion de errores:
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
mysqli_set_charset($mysqli,"utf8");


    if(isset($_GET['id_presupuesto_cliente'])){
        
        $idPresupuesto=(int)$_GET['id_presupuesto_cliente'];
        $query="SELECT aceptado FROM presupuestos_clientes WHERE id_presupuesto_cliente= ?";
    
        if ($resultado = $mysqli->prepare($query))
         {    
            $resultado->bind_param("i", $idPresupuesto);
            
            if ($resultado->execute()) {
                  
                $results=$resultado->get_result();
                
                if($results->num_rows>0){
                    while($row=$results->fetch_assoc()){
                        $RESULTADOS[]=$row;
                    }
                    echo json_encode($RESULTADOS);
                }else{
                    echo "Error no existen datos del estado del presupuesto.";
                }  
            } else{
                echo "No se están enviando correctamente los datos.";
            }

        }

    }else{
		echo "No se estan recibiendo los datos GET";
	}
    $mysqli->close();

?>