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


    if(isset($_POST['id_cita']) && isset($_POST['num_presupuesto']) && isset($_POST['descripcion']) && isset($_POST['fecha'])){
        
        $idCita=(int)$_POST['id_cita'];
        $numPresupuesto=$_POST['num_presupuesto'];
        $descripcion=$_POST['descripcion'];
        $fecha=$_POST['fecha'];
        $initialTime = strtotime($fecha);
	    $newformatInicial = date('Y-m-d',$initialTime);     
    
        if ($resultado = $mysqli->prepare("INSERT INTO presupuestos_clientes (id_cita, num_presupuesto, descripcion, fecha) VALUES (?,?,?,?)"))
         {
                  
            $resultado->bind_param("isss", $idCita, $numPresupuesto,$descripcion,$newformatInicial);
            
            if($resultado->execute()){
                echo "insertado";
            }else{
                echo "error";
            }  
        } else{
            echo 'No se están enviando correctamente los datos';
        }

    $mysqli->close();

    }

?>