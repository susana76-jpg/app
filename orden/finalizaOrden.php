<?php
//Detección de errores
ini_set('display_errors',1);
ini_set('display_startup_errors',1);
error_reporting(E_ALL);

//Headers:
header('Control-Access-Allow-Origin: *');
header('Content-Type: application/json;charset=utf-8');
header('Control-Access-Allow-Method: GET, POST, PUT, OPTIONS, DELETE');
header('Allow: GET, POST, PUT, OPTIONS, DELETE');
$method=$_SERVER['REQUEST_METHOD'];
if($method=='OPTIONS'){
	die();
}

//Conexión a bdd:
include_once('../connect.php');
mysqli_set_charset($mysqli,'utf8');

//RESTO DE CONSULTA:
if(isset($_GET['id_orden_reparacion'])){

	$idOrden=(int)$_GET['id_orden_reparacion'];

	$query="UPDATE ordenes_reparaciones SET finalizado=1 WHERE id_orden_reparacion = ?";

	if($resultados=$mysqli->prepare($query)){
	
		$resultados->bind_param("i",$idOrden);

		if($resultados->execute()){
			echo "Orden finalizada correctamente.";

		}else{
			echo "Error en cambiado de estado a finalizado en orden";
		}
	}else{
		echo "Error en la preparacion de la consulta";
	}
}else{
	echo "No se estan recibiendo los parámetros GET";
}

if($mysqli){
	$mysqli->close();
}

?>