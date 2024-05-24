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

if(isset($_GET['marca'])){

	$marca=$_GET['marca'];

	$query="SELECT DISTINCT u.*, vh.matricula, vh.kilometraje, ma.marca, mo.modelo FROM usuarios u JOIN vehiculos_clientes vh ON u.id_usuario=vh.id_usuario JOIN vehiculo_trim vt ON vh.id_vehiculo_trim=vt. id_vehiculo_trim JOIN vehiculo_serie s ON vt.id_serie=s.id_serie JOIN vehiculo_modelo mo ON s.id_modelo=mo.id_modelo JOIN vehiculo_marca ma ON mo.id_marca=ma.id_marca WHERE ma.marca=? ORDER BY u.id_usuario";

	if($resultados=$mysqli->prepare($query)){
		$resultados->bind_param("s", $marca);

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