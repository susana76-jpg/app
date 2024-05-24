<?php

//Detección de errores:
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Cabeceras:
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json; charset=utf-8');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Allow: GET, POST, OPTIONS, PUT, DELETE');
$method=['REQUEST_METHOD'];
if($method=='OPTIONS'){
	die();
}

//Conexión a la bdd:
include_once('../connect.php');
//Codificación:
mysqli_set_charset($mysqli,"utf8");

if(isset($_GET['fecha_inicio'])){

	$fechaInicio=$_GET['fecha_inicio'];
	$initialTime = strtotime($fechaInicio);
	$newformatInicial = date('Y-m-d',$initialTime);

	$query="SELECT SUM(li.importe*li.cantidad) as total FROM facturas_clientes fa JOIN ordenes_reparaciones o ON fa.id_orden_reparacion=o.id_orden_reparacion JOIN presupuestos_clientes pre ON o.id_presupuesto=pre.id_presupuesto_cliente JOIN lineas_presupuesto li ON pre.id_presupuesto_cliente=li.id_presupuesto WHERE fa.fecha=?";

	if($resultados=$mysqli->prepare($query)){
		$resultados->bind_param("s", $newformatInicial);

		if($resultados->execute()){
			$resultado=$resultados->get_result();

			if($resultado->num_rows> 0){
				while($row=$resultado->fetch_assoc()){
					$RESULTADOS[] = $row;
				}
				echo json_encode($RESULTADOS);
			}else{
				echo " Sin resultados.";
			}
		}else{
			echo "No se ha podido ejecutar la consulta.";
		}
	}else{
		echo "Error en la preparación de la consulta";
	}
}else{
	echo "No se reciben parámetros GET.";
}

if($mysqli){
	$mysqli->close();
}
?>
