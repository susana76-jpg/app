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
/*
 * Insert en la tabla de vehiculos-clientes por el método POST
 * llamada: http://localhost/app/veh-cli/nuevoVehiculoCliente.php
 * servidor: https://www.focused-kepler.85-214-239-118.plesk.page/app/veh-cli/nuevoVehiculoCliente.php
*/

    if( isset($_POST['id_usuario']) and isset($_POST['id_vehiculo_trim']) and 
    isset($_POST['matricula']) and  isset($_POST['kilometraje']) and
    isset($_POST['combustible']) and  isset($_POST['cambio']) and isset($_POST['anio'])){
        
        $idUsuario = (int)($_POST['id_usuario']);
        $idVehiculoTrim = (int)($_POST['id_vehiculo_trim']);
        $matricula = $mysqli->real_escape_string($_POST['matricula']);
        $kilometraje = (int)($_POST['kilometraje']);
        $combustible = $mysqli->real_escape_string($_POST['combustible']);
        $cambio = $mysqli->real_escape_string($_POST['cambio']);
        $anio= (int)($_POST['anio']);
        
    
        if ($resultado = $mysqli->prepare("INSERT INTO vehiculos_clientes (id_vehiculo_trim, id_usuario, matricula, kilometraje,combustible,cambio,anio) VALUES (?,?,?,?,?,?,?)")) {
                  
            $resultado->bind_param("iisissi", $idVehiculoTrim, $idUsuario, $matricula, $kilometraje, $combustible, $cambio,$anio);
            
            if($resultado->execute()){
                echo "Se ha realizado el alta del vehiculo_cliente correctamente.";
            }else{
                echo "No se ha realizado el alta de vehiculo_cliente.";
            }  
        } else{
            echo 'No se están enviando correctamente los datos';
        }

    $mysqli->close();

    }

?>