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
 * Param: id_vehiculo_cliente,id_usuario,id_empleado_asignado,hora,fecha,fecha_larga,fecha_larga2,observaciones,motivo
 * Inserta nueva cita.
*/

    if( isset($_POST['id_vehiculo_cliente']) and isset($_POST['id_usuario']) and isset($_POST['id_empleado_asignado']) and isset($_POST['hora']) 
    and  isset($_POST['fecha']) and  isset($_POST['fecha_larga']) and  isset($_POST['fecha_larga2']) 
    and isset($_POST['observaciones']) and  isset($_POST['motivo'])){
        
        $idVehiculoCliente = (int)($_POST['id_vehiculo_cliente']);
        $idUsuario = (int)($_POST['id_usuario']);
        $idEmpleadoAsignado = (int)($_POST['id_empleado_asignado']);
        $hora = (int)($_POST['hora']);
        $fecha = $_POST['fecha'];
        $fechaLarga = $_POST['fecha_larga'];
        $fechaLarga2 = $_POST['fecha_larga2'];
        $observaciones = $_POST['observaciones'];
        $motivo = $_POST['motivo'];
        
        if ($resultado = $mysqli->prepare("INSERT INTO citas_asignadas (id_vehiculo_cliente, id_usuario, id_empleado_asignado, hora, fecha,fecha_larga, fecha_larga2, observaciones, motivo) VALUES ( ?, ?, ?, ?, ?, ?, ?, ?, ?);")) {
                  
            print_r($resultado);

            $resultado->bind_param("iiiisssss", $idVehiculoCliente, $idUsuario, $idEmpleadoAsignado, $hora, $fecha, $fechaLarga, $fechaLarga2, $observaciones, $motivo);
            
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