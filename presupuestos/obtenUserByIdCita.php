<?php
//Modo indicación errores.
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

    if( isset($_GET['id_cita'])){
        
          $idUsuario = (int)$_GET['id_cita'];
        $query="SELECT u.*,vh.matricula,mo.modelo,ma.marca FROM usuarios u JOIN citas_asignadas ci ON u.id_usuario=ci.id_usuario JOIN vehiculos_clientes vh ON ci.id_vehiculo_cliente=vh.id_vehiculo_cliente JOIN vehiculo_trim vt ON vh.id_vehiculo_trim=vt.id_vehiculo_trim JOIN vehiculo_modelo mo ON vt.id_modelo=mo.id_modelo JOIN vehiculo_marca ma ON mo.id_marca=ma.id_marca WHERE ci.id_cita=?";
        $resultado = $mysqli->prepare($query);
        $resultado->bind_param("i", $idUsuario);
    
        if ($resultado->execute()) {
                  
            $results=$resultado->get_result();
            
            if($results->num_rows>0){
                while($row=$results->fetch_assoc()){
                    $RESULTADOS[]=$row;
                }
                echo json_encode($RESULTADOS);
            }else{
                echo "No existen datos de usuario.";
            }  
        } else{
            echo "No se están enviando correctamente los datos";
        }

    }else{
		echo "No esta recibiendo GET";
	}
 $mysqli->close();
?>