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
 * Selecciona el id de cliente por email
 * llamada: http://localhost/app/usuarios/idByEmail.php?email=susanaricovara@gmail.com
 * servidor: https://www.focused-kepler.85-214-239-118.plesk.page/app/usuarios/idByEmail.php?email=susanaricovara@hotmail.com
*/
if(isset($_GET['email'])){
	$email=$_GET['email'];
    if($query = $mysqli->prepare("SELECT id_usuario from usuarios where email = ?")){

        $query->bind_param("s", $email);
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

}else{
    echo 'El email introducido no es válido. Vuelva a intentarlo, por favor.';
}

$mysqli->close();

?>