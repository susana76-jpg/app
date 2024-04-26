<?php
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
/**
 * Method: POST
 * Param: id_usuario, id_vehiculo_trim, matricula, kilometraje, combustible, cambio, anio
 * Añade un vehíuclo.
*/

    if( isset($_POST['id_vehiculo_trim']) and  isset($_POST['kilometraje'])){
        
        $idVehiculoTrim = (int)($_POST['id_vehiculo_trim']);
        $kilometraje = (int)($_POST['kilometraje']);
        
    
        if ($resultado = $mysqli->prepare("UPDATE vehiculos_clientes SET kilometraje =? WHERE id_vehiculo_trim = ?")) {
                  
            $resultado->bind_param("ii", $idVehiculoTrim, $kilometraje);
            
            if($resultado->execute()){
                echo "Se ha realizado la actualización del vehiculo_cliente correctamente.";
            }else{
                echo "No se ha realizado el alta de vehiculo_cliente.";
            }  
        } else{
            echo 'No se están enviando correctamente los datos';
        }

    $mysqli->close();

    }

?>