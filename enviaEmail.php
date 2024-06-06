<?php
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    if(isset($_POST['asunto']) and isset($_POST['mensaje']) and isset($_POST['destinatario'])){

        $asunto=$_POST['asunto'];
        $mensaje=$_POST['mensaje'];
        $destinatario=$_POST['destinatario'];

        $from = "talleresMegacar@gmail.com";
        $to = $destinatario;
        $subject = $asunto;
        $message = $mensaje;
        $headers = "From:" . $from;
        mail($to,$subject,$message, $headers);
        echo "El email ha sido enviado.";
    }else{
        echo "No se reciben parametros POST.";
    }
    
?>