
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
/**
 * Method: GET
 * Param: dni
 * Devuelve los datos del cliente por dni_cif.
*/

    if( isset($_GET['valor'])){
        
          $dni = $_GET['valor'];
        $query="SELECT u.*, v.matricula FROM usuarios u JOIN vehiculos_clientes v ON u.id_usuario=v.id_usuario WHERE u.dni_cif=?;";
        $resultado = $mysqli->prepare($query);
        $resultado->bind_param("s", $dni);
    
        if ($resultado->execute()) {
                  
            $results=$resultado->get_result();
            
            if($results->num_rows>0){
                while($row=$results->fetch_assoc()){
                    $RESULTADOS[]=$row;
                }
                echo json_encode($RESULTADOS);
            }else{
                echo "No existen datos del cliente.";
            }  
        } else{
            echo "No se están enviando correctamente los datos";
        }

    }else{
		echo "No esta recibiendo get";
	}
 $mysqli->close();
?>