<?php

include_once "../entidadEmpleado/solicitudes.entidad.php";
include_once "../modeloEmpleado/solicitudes.modelo.php";
include_once "../controladorLogin/logueo.read.php";

include_once "../componente/Mailer/src/PHPMailer.php";
include_once "../componente/Mailer/src/SMTP.php";
include_once "../componente/Mailer/src/Exception.php";

if (isset($_FILES["fileEliminacion"]))
{
$id_empleado = $_SESSION['id_empleado'];
$usuario = $_SESSION['usuario'];
$codigo = $_POST['codigo2'];
$id_tipoDocumento = $_POST['idTipoDoc2'];
$id_prioridad = $_POST['prioridad2'];
$solicitud = $_POST['solicitud2'];
$fechaActual = date("Y-m-d H-i-s");

    $directorio = "../documentos/usuarios/$usuario/solicitudes/$fechaActual/";
   
    if(!file_exists($directorio)){
        mkdir($directorio,0777,true);
        $nombre = $_FILES['fileEliminacion']['name'];   
        move_uploaded_file($_FILES['fileEliminacion']['tmp_name'],$directorio.$nombre);        
    }else{
        if(file_exists($directorio)){
            $nombre = $_FILES['fileEliminacion']['name'];
            move_uploaded_file($_FILES['fileEliminacion']['tmp_name'],$directorio.$nombre);
        }    
    }
    $solicitudesE = new \entidad\Solicitudes(); 
    $solicitudesE -> setIdEmpleado($id_empleado);
    $solicitudesE -> setCodigo($codigo);
    $solicitudesE -> setIdTipoDocumento($id_tipoDocumento);
    $solicitudesE -> setPrioridad($id_prioridad);
    $solicitudesE -> setSolicitud($solicitud);
    $solicitudesE -> setDocumento($nombre);  
    $solicitudesE -> setRuta($fechaActual); 
    $solicitudesE -> setUsuarioComentario($usuario);
    
    $solicitudesM= new \modelo\Solicitudes($solicitudesE);
    $resultado = $solicitudesM->solicitudEliminacion();
}
else{

$id_empleado = $_SESSION['id_empleado'];
$usuario = $_SESSION['usuario'];
$codigo = $_POST['codigo2'];
$id_tipoDocumento = $_POST['idTipoDoc2'];
$id_prioridad = $_POST['prioridad2'];
$solicitud = $_POST['solicitud2'];
$fechaActual = date("Y-m-d H-i-s");
$nombre = NULL ;

    $directorio = "../documentos/usuarios/$usuario/solicitudes/$fechaActual/";
    if(!file_exists($directorio)){
        mkdir($directorio,0777,true);
    }else{
        if(file_exists($directorio)){
        }    
    }
$solicitudesE = new \entidad\Solicitudes(); 
$solicitudesE -> setIdEmpleado($id_empleado);
$solicitudesE -> setCodigo($codigo);
$solicitudesE -> setIdTipoDocumento($id_tipoDocumento);
$solicitudesE -> setPrioridad($id_prioridad);
$solicitudesE -> setSolicitud($solicitud);
$solicitudesE -> setDocumento($nombre);  
$solicitudesE -> setRuta($fechaActual); 
$solicitudesE -> setUsuarioComentario($usuario);

$solicitudesM= new \modelo\Solicitudes($solicitudesE);
$resultado = $solicitudesM->solicitudEliminacion();
}

unset($solicitudesE);
unset($solicitudesM);

if(empty($retorno)){
    $usuario = $_SESSION['nombre_completo'];
    $correo = $_SESSION['correo_empleado'];
    $fechaActual = date("Y-m-d H-i-s");

    try {
    
        $emailTo =  $correo;
        $subject = "LIMARO - Notificaci??n De Solicitud Creada con ??xito";
        $bodyEmail = "
FECHA: $fechaActual
PARA: $usuario - Funcionario COOPEAIPE
DE: Area De Calidad
ASUNTO: Notificaci??n De Solicitud Creada con ??xito

Estimado(a)  $usuario,

Cordial Saludo,

Me permito informar que su solicitud de eliminaci??n de documento fue recibida con ??xito.

Atentamente,

LIMARO SOFTWARE - Software de gesti??n ISO 9001:2015 con funcionalidad de control de documentos

Este correo es de tipo informativo, agradecemos no dar respuesta a este mensaje ya que es generado de manera autom??tica y no es un canal oficial de comunicaci??n de LIMARO SOFTWARE.";

    $fromemail = "notificaciones@limaro.co";
    $fromname = "LIMARO";
    $host = "smtp.mi.com.co";
    $port ="465";
    $SMTPAuth = true;
    $SMTPDebug=true;
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

    $mail ->Subject = $subject;
    $mail ->Body =$bodyEmail;

    if(!$mail->send()){
        echo ("no enviado"); 
    }else{
        echo '
        <link rel="stylesheet" href="../componente/css/globales/sweetalert2.min.css"> 
        <script src="../componente/libreria/globales/sweetalert2.all.min.js"></script> 
        <script type="text/javascript" src="../componente/libreria/globales/jquery-3.6.0.js"></script>
        <script>    
        jQuery(function(){
            Swal.fire({
                icon: "success",
                title: "Solicitud de Eliminaci??n de Documento creada con ??xito",
                showConfirmButton: false,
                timer: 2000
                }).then(function() {
                window.location.href = "../empleado/solicitudes.php";
            });
        });
        </script>';
    }
    } catch (Exception $e) {
        
    }
                
        }


if(empty($retorno)){

$correo = $_SESSION['correo_empleado'];
$fechaActual = date("Y-m-d H-i-s");
$solicitud = $_POST['solicitud2'];
$usuario = $_SESSION['nombre_completo'];
$id_prioridad = $_POST['prioridad2'];
try {

    $emailTo =  "notificaciones@limaro.co";
    $subject = "LIMARO - Notificaci??n De Solicitud Creada";
    $bodyEmail = "

FECHA: $fechaActual
PARA: Area De Calidad
DE: $usuario - Funcionario COOPEAIPE
ASUNTO: Notificaci??n De Solicitud Creada con ??xito

Se recibio la siguiente solicitud:

Funcionario : $usuario
Prioridad: $id_prioridad
Tipo de Solicitud: Eliminaci??n de Documento
Solicitud: $solicitud

Atentamente,

LIMARO SOFTWARE - Software de gesti??n ISO 9001:2015 con funcionalidad de control de documentos

Este correo es de tipo informativo, agradecemos no dar respuesta a este mensaje ya que es generado de manera autom??tica y no es un canal oficial de comunicaci??n de LIMARO SOFTWARE.";

$fromemail = "notificaciones@limaro.co";
$fromname = "LIMARO";
$host = "smtp.mi.com.co";
$port ="465";
$SMTPAuth = true;
$SMTPDebug=true;
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

$mail ->Subject = $subject;
$mail ->Body =$bodyEmail;

if(!$mail->send()){
    echo ("no enviado"); 
}else{
    echo (""); 
}
} catch (Exception $e) {
    
}
            
    }



?>  