<?php
//Detección de errores:
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Headers:
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json;charset=utf-8');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE');
header('Allow: GET, POST, OPTIONES, PUT, DELETE');
$method = $_SERVER['REQUEST_METHOD'];
if ($method == 'OPTIONS') {
    die();
}

include_once("../connect.php");
mysqli_set_charset($mysqli,"utf8");

if (
    isset($_POST['email']) and isset($_POST['nombre']) and isset($_POST['telefono'])
    and isset($_POST['direccion']) and isset($_POST['cod_postal']) and isset($_POST['localidad'])
    and isset($_POST['provincia']) and isset($_POST['pass']) and isset($_POST['firebase']) and
    isset($_POST['dni_cif']) and isset($_POST['id_usuario'])
) {

    $email = $_POST['email'];
    $nombre = $_POST['nombre'];
    $telefono = (int) $_POST['telefono'];
    $direccion = $_POST['direccion'];
    $cod_postal = (int) $_POST['cod_postal'];
    $localidad = $_POST['localidad'];
    $provincia = $_POST['provincia'];
    $pass = $_POST['pass'];
    $token = $_POST['firebase'];
    $dni_cif = $_POST['dni_cif'];
    $id_usuario = (int) $_POST['id_usuario'];

    $query = "UPDATE usuarios SET email=?, nombre=?, telefono=?, direccion=?, cod_postal= ?,
localidad= ?, provincia=?, password=?, firebase=?, dni_cif=? WHERE id_usuario=?";

    if ($results = $mysqli->prepare($query)) {
        $results->bind_param(
            "ssisisssssi",
            $email,
            $nombre,
            $telefono,
            $direccion,
            $cod_postal,
            $localidad,
            $provincia,
            $pass,
            $token,
            $dni_cif,
            $id_usuario
        );

        if ($results->execute()) {
            echo "Registro modificado correctamente.";
        } else {
            echo "Error en actualización del registro";
        }
    } else {
        echo "Error en la preparación de la query.";
    }
} else {
    echo "No se estan recibiendo parametros POST.";
}
if ($mysqli) {
    $mysqli->close();
}
?>