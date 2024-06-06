<?php
if(isset($_POST['token']) and isset($_POST['titulo']) and(isset($_POST['mensaje']))){
$tokenCliente= $_POST['token'];
$titulo = $_POST['titulo'];
$mensaje = $_POST['mensaje'];

 ////////ENVÍO DE NOTIFICACIÓN/////////
$fcmUrl = 'https://fcm.googleapis.com/fcm/send';
$token = $tokenCliente;
$apiKey = 'AAAAyozJPu8:APA91bHBLgeEONC-CDkvjJjsIVZby91rqZXkp3c21kO4D4nPe2lFPixO8zGp5skZ8M47OFZjH-BTTCQcaof9czr6GfHE1pLgoF5fD87Et4lrVafuCwVVQQdA_EpvdFSzYydspdB94DyO';
$notification = ['title' => $titulo, 'body' => $mensaje, 'icon' => 'myIcon', 'sound' => 'mySound'];
$extraNotificationData = ["message" => $notification, "moredata" => 'dd'];
$fcmNotification = [
        
'to' => $token,
'notification' => $notification, 'data' => $extraNotificationData];
$headers = ['Authorization: key=' . $apiKey, 'Content-Type: application/json'];
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $fcmUrl);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
$result = curl_exec($ch);
curl_close($ch);
echo $result;

}else{
    echo "No se reciben los parametros POST.";
}
?>