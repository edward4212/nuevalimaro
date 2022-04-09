<?php
include_once "../controladorLogin/logueo.read.php";
include_once "../entidadAdministrador/usuario.entidad.php";
include_once "../modeloAdministrador/usuario.modelo.php";
include_once "../componente/Mailer/src/PHPMailer.php";
include_once "../componente/Mailer/src/SMTP.php";
include_once "../componente/Mailer/src/Exception.php";

 $nombre_completo  = $_POST['NombreMoClave'];
 $correo_empleado  = $_POST['CorreoUsurioMoClave'];
 $usuario  = $_POST['UsurioMoClave'];
 $clave  = '12345';
 

try {

    $nombre_completo  = $_POST['NombreMoClave'];
    $usuario  = $_POST['UsurioMoClave'];
    $emailTo =  $_POST['CorreoUsurioMoClave'];
    $clave  = '12345';
    $subject = "LIMARO - Restablecimiento Contraseña de usuario";
    $bodyEmail = "Estimado(a) $nombre_completo,

Su solicitud de restablecimiento de Contraseña dentro del sistema LIMARO SOFTWARE fue realizado exitosamente con la siguiente información:

    Url de conexión: https://cop.limaro.co/login/login.php
    Usuario: $usuario
    Contraseña Inicial:  $clave
    
Para ingresar nuevamente, el sistema solicitará activar el usuario, para lo cual debe dar clic en el botón 'Activar Usuario' y realizar cambio de clave; No olvide guardar la clave en un sitio seguro.

Cordialmente,

LIMARO SOFTWARE - Software de gestión ISO 9001:2015 con funcionalidad de control de documentos.

Este correo es de tipo informativo, agradecemos no dar respuesta a este mensaje ya que es generado de manera automática y no es un canal oficial de comunicación de LIMARO SOFTWARE.";

    $fromemail = "notificaciones@limaro.co";
    $fromname = "LIMARO";
    $host = "smtp.mi.com.co";
    $port ="465";
    $SMTPAuth = true;
    $SMTPSecure = "ssl";
    $password ="Kddbjw8b3d";
    $IsHTML=true;

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail ->IsSMTP();
    $mail ->SMTPDebug = 2;
    $mail ->SMTPAuth  =  $SMTPAuth;
    $mail ->SMTPSecure = $SMTPSecure;
    $mail ->Host =  $host;
    $mail ->Port = $port; 
    $mail ->IsHTML = $IsHTML; 
    $mail->CharSet  ="utf-8";
    $mail->SMTPKeepAlive = true;
    $mail ->Username =  $fromemail;
    $mail ->Password =  $password;

    $mail ->setFrom($fromemail, $fromname);
    $mail ->addAddress($emailTo);

    // $mail ->isSMTP(true);
    $mail ->Subject = $subject;
    $mail ->Body =$bodyEmail;

    if(!$mail->send()){
       echo ("no enviado"); 
    }

    echo ("enviado"); 



} catch (Exception $e) {
    
}



?>  