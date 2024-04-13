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
 * Selecciona cliente por email
 * llamada: http://localhost/app/usuarios/byEmail.php?email=susanaricovara@gmail.com
 * servidor: https://www.focused-kepler.85-214-239-118.plesk.page/app/usuarios/byEmail.php?email=susanaricovara@gmail.com
*/

if(isset($_GET['email'])){

    if($query = $mysqli->prepare("SELECT * from usuarios where email = ?")){

        $query->bind_param("s", $_GET['email']);
        $query->execute();
    
        $result = $query->get_result();

        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()){
                $RESULT= $row;
		//print_r($row); 
            }
            echo json_encode($RESULT);
        }else{
            echo "0 results";
        }
    }

}else{
    echo 'El email introducido no es válido. Vuelva a intentarlo, por favor.';
}

$mysqli->close();

?>