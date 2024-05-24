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


if(isset($_GET['id_orden_reparacion'])) {

    if($query = $mysqli->prepare("SELECT id_factura_cliente FROM facturas_clientes WHERE id_orden_reparacion=?")){

        $idOrden = (int)$_GET['id_orden_reparacion'];
        $query->bind_param("i", $idOrden);
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