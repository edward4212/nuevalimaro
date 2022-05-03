<?php
include_once "../../controladorLogin/logueo.read.php";
include_once "../../entidadAdministrador/usuario.entidad.php";
include_once "../../modeloAdministrador/usuario.modelo.php";
include_once "../../componente/Mailer/src/PHPMailer.php";
include_once "../../componente/Mailer/src/SMTP.php";
include_once "../../componente/Mailer/src/Exception.php";

$usuarioE = new \entidad\Usuario();

$usuarioM= new \modelo\Usuario($usuarioE);

$resultado = $usuarioM->usuariosCorreos();

$fechaActual = date("Y-m-d H-i-s");

if(array_key_exists('usuario',$resultado[0])){

    for($i = 0; $i < count($resultado); $i++) {
     
        $usuario['id_usuario']=$resultado[$i]['id_usuario'];

        // $mail->AddAddress($retorno[$i]);


        // try {

        //     $nombre_completo  = $_POST['txtNombreEmpleado'];
        //     $usuario  = $_POST['txtUsuario'];
        //     $emailTo =  $_POST['txtCorreoEmpleado'];
        //     $clave  = $_POST['txtClaveInicial'];
        //     $subject = "LIMARO - Actualziacion de Documento";
        //     $bodyEmail = "Estimado(a) $nombre_completo,
        
        // FECHA	: $fechaActual
        // PARA	: FUNCIONARIOS COOPEAIPE
        // DE		: AREA DE CALIDAD 
        // ASUNTO	: ENVIÓ INFORMACIÓN DE DOCUMENTO ACTUALIZADO
        
        // Cordial Saludo:
        
        // Me permito informar que el siguiente documento se encuentran actualizado para que sean consultado y aplicado:
        
        // TIPO:	
        // CÓDIGO:
        // NOMBRE:
        // VERSIÓN:
        // FECHA DE ACTUALIZACIÓN:
                        
                
        // Los cambios básicos están con letras en color verde, pero se recomienda leer en su totalidad el documento si lo desconoce o ha olvidado su contenido. Si todo el documento esta con letras de color negra, es porque el documento fue actualizado en su totalidad o es un documento nuevo.
        // Es obligación leer y difundir la información contenida en cada documento. UNA VEZ REPRODUCIDAS O IMPRESAS ESTAS PROCEDIMIENTOS, SE CONSIDERAN COPIAS NO CONTROLADAS.
        
        // Favor tener en cuenta las siguientes instrucciones:
        
        // 1. Una vez se tenga el documento favor, LEERLO en su totalidad Y COMPRENDERLO   y una vez comprendido asegúrese que las personas involucradas en los procesos los conozcan y cumplan. 
        // 2.  Para la lectura, entendimiento y aplicación del documento se da un plazo máximo de tres (3) días, a partir de la fecha de recibido este correo. Si él documento es de aplicación INMEDIATA su plazo máximo será de un (1) día. Los documentos referenciados que se citan hacen parte integral del mismo.
        // 3. Por ningún motivo los documentos deben ser reproducidas ni utilizadas para objetivos distintos a las necesidades del trabajo. Por su carácter normativo los documentos son de obligatorio cumplimiento
        // 4. Los documentos son una herramienta de trabajo cuya vigencia es importante mantener en todo momento; por ello las actualizaciones que demande deben ser efectuadas con el mayor cuidado y prontitud. Toda observación tendiente al mejoramiento de su contenido es de fundamental importancia, por lo tanto, debe darse a conocer oportunamente a la subgerencia administrativa mediante comunicación escrita o correo electrónico quien se encargará de coordinar con el área de calidad (OYM) la actualización, mejora, modificación o creación del documento.
        // 5. Si se relacionan documentos que deben ser descargados al computador del funcionario, este proceso se debe realizar de manera obligatoria una vez conocido el documento. El contenido y diseño de los documentos no deben ser modificados por ningún motivo. Si hay algún aporte o sugerencia para mejorarlos remitirla a la subgerencia administrativa mediante comunicación escrita o correo electrónico quien se encargará de coordinar con el área de calidad (OYM) la actualización, mejora, modificación o creación del formato.";
        
        //     $fromemail = "notificaciones@limaro.co";
        //     $fromname = "LIMARO";
        //     $host = "smtp.mi.com.co";
        //     $port ="465";
        //     $SMTPAuth = true;
        //     $SMTPSecure = "ssl";
        //     $password ="Kddbjw8b3d";
        //     $IsHTML=true;
        
        //     $mail = new PHPMailer\PHPMailer\PHPMailer();
        
        //     $mail ->IsSMTP();
        //     $mail ->SMTPDebug = 2;
        //     $mail ->SMTPAuth  =  $SMTPAuth;
        //     $mail ->SMTPSecure = $SMTPSecure;
        //     $mail ->Host =  $host;
        //     $mail ->Port = $port; 
        //     $mail ->IsHTML = $IsHTML; 
        //     $mail->CharSet  ="utf-8";
        //     $mail->SMTPKeepAlive = true;
        //     $mail ->Username =  $fromemail;
        //     $mail ->Password =  $password;
        
        //     $mail ->setFrom($fromemail, $fromname);
        //     $mail ->addAddress($emailTo);
        
        //     // $mail ->isSMTP(true);
        //     $mail ->Subject = $subject;
        //     $mail ->Body =$bodyEmail;
        
        //     if(!$mail->send()){
        //         echo ("no enviado"); 
        //     }
        
        //     echo ("enviado"); 
        
        
        
        // } catch (Exception $e) {
            
        // }
            
    }

}





?>  