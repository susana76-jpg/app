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
if(isset($_GET['num_presupuesto'])){

	$idPresupuesto=$_GET['num_presupuesto'];

	$query="UPDATE presupuestos_clientes SET aceptado=1 WHERE num_presupuesto = ?";

	if($resultados=$mysqli->prepare($query)){
	
		$resultados->bind_param("i",$idPresupuesto);

		if($resultados->execute()){
			echo "Presupuesto aceptado";

		}else{
			echo "Error en aceptacion de presupuesto";
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