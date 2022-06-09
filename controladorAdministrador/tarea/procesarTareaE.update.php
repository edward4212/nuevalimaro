<?php

date_default_timezone_set('America/Bogota');

include_once "../../entidadAdministrador/solicitudes.entidad.php";
include_once "../../modeloAdministrador/solicitudes.modelo.php";
include_once "../../controladorLogin/logueo.read.php";

include_once "../../componente/Mailer/src/PHPMailer.php";
include_once "../../componente/Mailer/src/SMTP.php";
include_once "../../componente/Mailer/src/Exception.php";

$id_tarea=  $_POST['idTarea2'];
$id_solicitud = $_POST['numIdSolicitudCom'];


$foto=$_FILES["fileDocumento"]["tmp_name"];
$tipo =$_FILES['fileDocumento']['type'];
$tamaño =$_FILES['fileDocumento']['size'];

$directorio = "../../documentos/macroprocesos/$macroproceso/$proceso/$tipDocCon/$codigo/$numero_version/";

if(!file_exists($directorio)){
    mkdir($directorio,0777,true);
    $nombre = $_FILES['fileDocumento']['name'];   
    move_uploaded_file($_FILES['fileDocumento']['tmp_name'],$directorio.$nombre);        
}else{
    if(file_exists($directorio)){
        $nombre = $_FILES['fileDocumento']['name'];
        move_uploaded_file($_FILES['fileDocumento']['tmp_name'],$directorio.$nombre);
    }    
}

$documentoE = new \entidad\documento(); 

$documentoE -> setNumeroVersion($numero_version);
$documentoE -> setIdDocumento($id_documento);
$documentoE -> setDescripcionVersion($descripcion_version);
$documentoE -> setUsuarioCreacion($usuario_creacion);
$documentoE -> setFechaCreacion($fecha_creacion);
$documentoE -> setUsuarioRevision($usuario_revision);
$documentoE -> setFechaRevision($fecha_revision);
$documentoE -> setUsuarioAprobacion($usuario_aprobacion);
$documentoE -> setFechaAprobacion($fecha_aprobacion);
$documentoE -> setDocumento($nombre);
$documentoE -> setVersionAnte($numero_version_ante);

$documentoM= new \modelo\documento($documentoE);
$resultado = $documentoM->creacionVersionamiento();
$resultado = $documentoM->actualizarVersionamiento();

unset($documentoE);
unset($documentoM);

try {

    $nombre_completo  = $_POST['txtNombreEmpleado'];
    $usuario  = $_POST['txtUsuario'];
    $emailTo =  $_POST['txtCorreoEmpleado'];
    $clave  = $_POST['txtClaveInicial'];
    $subject = "LIMARO - Creación De Usuario";
    $bodyEmail = "

FECHA: $fechaActual
PARA: $nombre_completo - Funcionario COOPEAIPE
DE: Area De Calidad
ASUNTO: Creación De Usuario

Su usuario dentro del sistema LIMARO SOFTWARE fue creado exitosamente con la siguiente información:

    Url de conexión: https://cop.limaro.co/login/login.php
    Usuario: $usuario
    Contraseña Inicial:  $clave

Para ingresar por primera vez, el sistema solicitará activar el usuario, para lo cual debe dar clic en el botón 'Activar Usuario' y realizar cambio de contraseña; No olvide guardar la contraseña en un sitio seguro.

Bienvenido(a)

LIMARO SOFTWARE - Software de gestión ISO 9001:2015 con funcionalidad de control de documentos

Este correo es de tipo informativo, agradecemos no dar respuesta a este mensaje ya que es generado de manera automática y no es un canal oficial de comunicación de LIMARO SOFTWARE.";

    $fromemail = "notificaciones@limaro.co";
    $fromname = "LIMARO";
    $host = "smtp.mi.com.co";
    $port ="465";
    $SMTPAuth = true;
    $SMTPSecure = "ssl";
    $password ="Kddbjw8b3d%";
    $IsHTML=true;

    $mail = new PHPMailer\PHPMailer\PHPMailer();

    $mail ->IsSMTP();
    $mail ->SMTPDebug = 0;
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