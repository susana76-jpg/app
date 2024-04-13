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
* Listado de horas ya ocupadas por fecha
* https://www.focused-kepler.85-214-239-118.plesk.page/app/clientes/horasCitaOcupadas.php?fecha=2024-03-26
* http://localhost/app/clientes/horasCitaOcupadas.php?fecha=2024-03-28
* 
*/

if(isset($_GET['fecha'])){
        
    $fecha = ($_GET['fecha']);

    if($query = $mysqli->prepare("SELECT hora FROM  citas_asignadas WHERE fecha = ?;")){

        $query->bind_param("s", $fecha );
        $query->execute();
    
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $RESULT[]= $row;
            }
            echo json_encode($RESULT);
        }else{
            $RESULT=[];
            echo json_encode($RESULT);
        }
    } else {
    echo 'Disculpe, la consulta no está bien formulada. Vuelva a intentarlo, por favor.';
}

}
$mysqli->close();

?>