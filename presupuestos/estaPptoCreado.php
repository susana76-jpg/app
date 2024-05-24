<?php
//Cabeceras HTTP en PHP para permitir el acceso CORS con Apache o con otro servidor web
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Allow: GET, POST, OPTIONS, PUT, DELETE");
$method = $_SERVER['REQUEST_METHOD'];
if($method == "OPTIONS") {
    die();
}

header('Content-Type: application/json; charset=utf-8');

include_once("../connect.php");
mysqli_set_charset($mysqli,"utf8");


if(isset($_GET['num_presupuesto'])) {

    if($query = $mysqli->prepare("SELECT id_presupuesto_cliente FROM presupuestos_clientes WHERE num_presupuesto=?")){

        $numPresupuesto = $_GET['num_presupuesto'];
        $query->bind_param("s", $numPresupuesto);
        $query->execute();
        $result = $query->get_result();
       
        if ($result->num_rows > 0) {
            echo "existe";
        }else{
            echo "No facturada";
        }
    }
}else{
	echo "No se estan recibiendo parametros por GET";	
}
$mysqli->close();
?>