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
/*
 * method: GET
 * param: id_marca
 * Listado de todas los modelos por marca
*/


if(isset($_GET['id'])){ 

    $idMarca = (int)$_GET['id'];

    if($query = $mysqli->prepare("SELECT * from vehiculo_modelo where id_marca = ? order by modelo asc")){

        $query->bind_param("i", $idMarca);
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