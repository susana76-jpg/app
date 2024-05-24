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

	$query="SELECT ci.*, u.nombre,u.firebase,u.email , u.telefono, v.matricula, ma.marca,mo.modelo FROM citas_asignadas ci
		JOIN usuarios u ON ci.id_usuario=u.id_usuario 
		JOIN vehiculos_clientes v ON ci.id_vehiculo_cliente= v.id_vehiculo_cliente
		JOIN vehiculo_trim tr ON v.id_vehiculo_trim=tr.id_vehiculo_trim
		JOIN vehiculo_modelo mo ON tr.id_modelo=mo.id_modelo
		JOIN vehiculo_marca ma ON mo.id_marca=ma.id_marca
		WHERE ci.fecha = ? AND ci.finalizado=0";

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
