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


    if(isset($_POST['id_presupuesto']) && isset($_POST['descripcion']) && isset($_POST['importe']) && isset($_POST['cantidad'])){
        
        $idPresupuesto=(int)$_POST['id_presupuesto']; 
        $descripcion=$_POST['descripcion']; 
        $importe=(int)$_POST['importe']; 
        $cantidad=(int)$_POST['cantidad']; 
    
        if ($resultado = $mysqli->prepare("INSERT INTO lineas_presupuesto (id_presupuesto, descripcion, importe, cantidad) VALUES (?,?,?,?)"))
         {
                  
            $resultado->bind_param("isii", $idPresupuesto, $descripcion,$importe,$cantidad);
            
            if($resultado->execute()){
                echo "insertado";
            }else{
                echo "Error";
            }  
        } else{
             echo 'No se ejecutando correctamente los datos.';
        }

    }else{
        echo 'No se están enviando correctamente los datos POST';
    }
    $mysqli->close();

?>