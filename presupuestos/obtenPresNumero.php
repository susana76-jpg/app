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
mysqli_set_charset($mysqli,"utf8");

/*
 * Login del cliente / empleado
 * el id_cliente == id_empleado (si el usuario logado es un empleado)
 * llamada: http://localhost/app/clientes/loginCliente.php
 * servidor: https://www.focused-kepler.85-214-239-118.plesk.page/app/clientes/loginCliente.php
*/

    if( isset($_GET['num_presupuesto'])){
        
          $numPresupuesto = $_GET['num_presupuesto'];
        $query="SELECT li.* FROM lineas_presupuesto li JOIN presupuestos_clientes pre ON li.id_presupuesto=pre.id_presupuesto_cliente JOIN citas_asignadas ci ON pre.id_cita=ci.id_cita JOIN vehiculos_clientes vh ON ci.id_vehiculo_cliente=vh.id_vehiculo_cliente WHERE pre.num_presupuesto=?";
        $resultado = $mysqli->prepare($query);
        $resultado->bind_param("s", $numPresupuesto);
    
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
		echo "No esta recibiendo get";
	}
 $mysqli->close();
?>