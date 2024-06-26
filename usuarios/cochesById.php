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
/**
 * Method: GET
 * Param: id_usuario
 * Listado de vehículos por id usuario.
*/

if(isset($_GET['id_usuario'])){
        
    $id_usuario = (int) $_GET['id_usuario'];
    if($query = $mysqli->prepare("SELECT vh.*, ma.marca,mo.modelo, ser.serie, tr.version,ge.generacion, ti.tipo FROM vehiculos_clientes vh
                                    JOIN vehiculo_trim tr ON tr.id_vehiculo_trim = vh.id_vehiculo_trim 
                                    JOIN vehiculo_serie ser ON ser.id_serie = tr.id_serie
                                    JOIN vehiculo_modelo mo ON mo.id_modelo = tr.id_modelo
                                    JOIN vehiculo_marca ma ON ma.id_marca = mo.id_marca
                                    JOIN vehiculo_generacion ge ON ge.id_modelo = mo.id_modelo
                                    JOIN vehiculo_tipo ti ON ti.id_tipo = mo.id_tipo
                                    AND vh.id_usuario =  ?;")){

        $query->bind_param("i", $id_usuario );
        $query->execute();
    
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $RESULT[]= $row;
            }
            echo json_encode($RESULT);
        }else{
            echo "0 results";
        }
    }

} else {
    echo 'Disculpe, la consulta no está bien formulada. Vuelva a intentarlo, por favor.';
}

$mysqli->close();

?>