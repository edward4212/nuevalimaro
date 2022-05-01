<?php

include_once "../../entidadAdministrador/documento.entidad.php";
include_once "../../modeloAdministrador/documento.modelo.php";
include_once "../../controladorLogin/logueo.read.php";

$id_documento=  $_POST['idDocumento1'];
$macroproceso = $_POST['macroproceso'];
$proceso = $_POST['proceso'];
$tipDocCon = $_POST['tipo'];
$codigo = $_POST['codigo1'];
$numero_version_ante = $_POST['versionAnt'];
$numero_version = $_POST['versionSig1'];
$descripcion_version = $_POST['descriCambio1'];
$usuario_creacion = $_POST['usuarioCreacion'];
$fecha_creacion = $_POST['fechaCreacion'];
$usuario_revision = $_POST['usuarioRevision'];
$fecha_revision = $_POST['fechaRevision'];
$usuario_aprobacion = $_POST['usuarioAprobacion'];
$fecha_aprobacion = $_POST['fechaAprobacion'];

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

// echo '
//     <link rel="stylesheet" href="../../componente/css/globales/sweetalert2.min.css"> 
//     <script src="../../componente/libreria/globales/sweetalert2.all.min.js"></script> 
//     <script type="text/javascript" src="../../componente/libreria/globales/jquery-3.6.0.js"></script>
//     <script>    
//         jQuery(function(){
//             Swal.fire({
//                 icon: "success",
//                 title: "Versionamiento Creado con Éxito",
//                 showConfirmButton: false,
//                 timer: 3000
//                 }).then(function() {
//                 window.location.href = "../../administrador/documentos.php";
//             });
//         });
//     </script>';

?>  