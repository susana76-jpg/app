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


    if(isset($_POST['id_empleado_asignado']) && isset($_POST['id_cita'])){
        
        $idEmpleado = (int)$_POST['id_empleado_asignado'];
        $idCita = (int)$_POST['id_cita'];
        $query="UPDATE citas_asignadas set id_empleado_asignado = ?,finalizado=1 WHERE id_cita = ?;";
       
        if ($resultado = $mysqli->prepare($query)) {
                  
            $resultado->bind_param("ii", $idEmpleado, $idCita);
            
            if($resultado->execute()){
                echo "Se ha asignado el empleado a la cita correctamente.";
            }else{
                echo "Error al asignar el empleado a la cita.";
            }  
        } else{
            echo 'No se están enviando correctamente los datos';
        }
    }else{
        echo 'No se estan recibiendo parametros POST.';
    }
     
    $mysqli->close();



?>