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


    if(isset($_POST['id_orden']) and isset($_POST['num_factura']) and isset($_POST['observaciones'])){
        
    $idOrdenRep=(int)$_POST['id_orden']; 
	$numFactura=$_POST['num_factura'];
	$fecha= date("Y-m-d");
	$observaciones=$_POST['observaciones'];
    
        if ($resultado = $mysqli->prepare("INSERT INTO facturas_clientes (id_orden_reparacion, num_factura, fecha, observaciones) VALUES (?,?,?,?)"))
         {
                  
            $resultado->bind_param("isss", $idOrdenRep, $numFactura, $fecha, $observaciones);
            
            if($resultado->execute()){
                echo "Factura creada correctamente.";
            }else{
                echo "Error al crear factura.";
            }  
        } else{
             echo 'No se ejecutando correctamente los datos.';
        }

    }else{
        echo 'No se están enviando correctamente los datos POST';
    }
    $mysqli->close();

?>