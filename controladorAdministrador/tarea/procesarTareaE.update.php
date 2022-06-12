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
$usuario_comentario = $_SESSION['usuario'];
$comentario = $_POST['comentarioTarea'];
$usuario_tarea_estado = $_POST['empleado'];
$ruta= $_POST['ruta'];
$correo= $_POST['empleadoCorreo'];
$fechaActual = date("Y-m-d H-i-s");


$directorio = "../../documentos/usuarios/$usuario_tarea_estado/tareas/$id_solicitud/$ruta/";

if(!file_exists($directorio)){
    mkdir($directorio,0777,true);
    $nombre = $_FILES['fileTarea']['name'];   
    move_uploaded_file($_FILES['fileTarea']['tmp_name'],$directorio.$nombre);        
}else{
    if(file_exists($directorio)){
        $nombre = $_FILES['fileTarea']['name'];
        move_uploaded_file($_FILES['fileTarea']['tmp_name'],$directorio.$nombre);
    }    
}

$solicitudesE = new \entidad\Solicitudes(); 
$solicitudesE -> setIdTarea($id_tarea);
$solicitudesE -> setIdSolicitud($id_solicitud);
$solicitudesE -> setUsuarioComentario($usuario_comentario);
$solicitudesE -> setComentario($comentario);
$solicitudesE -> setUsuarioTareaEstado($usuario_tarea_estado);
$solicitudesE -> setRuta($ruta);
$solicitudesE -> setDocumentoTarea($nombre);

$solicitudesM= new \modelo\Solicitudes($solicitudesE);
$resultado = $solicitudesM->tareaElaborada();
$resultado = $solicitudesM->comentarioTareaElaborada();
$resultado = $solicitudesM->actualizarTareaEstado();

unset($solicitudesE);
unset($solicitudesM);

try {

    
    $usuario_tarea_estado = $_POST['empleado'];
    $emailTo =  $_POST['empleadoCorreo'];
    $subject = "LIMARO - Asignación de Tarea";
    $bodyEmail = "


FECHA: $fechaActual
PARA: $usuario_tarea_estado - Funcionario COOPEAIPE
DE: Area De Calidad
ASUNTO: Asignación de Solicitud

Cordial Saludo,

Se le ha asignado una tarea para su desarrollo.

Cordialmente,

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
      
    }
} catch (Exception $e) {
    
}


?>