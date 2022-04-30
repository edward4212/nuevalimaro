<?php

include_once "../../entidadAdministrador/documento.entidad.php";
include_once "../../modeloAdministrador/documento.modelo.php";
include_once "../../controladorLogin/logueo.read.php";


$s ="-";
$e =" ";
$tipDocCon = $sigla_tipoDoc.$e.$e.$tipo_documento;

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
$documentoE -> setDescripcionVersion($descriocion_version);
$documentoE -> setUsuario($usuario);
$documentoE -> setUsuarioRevision($usuario_revision);
$documentoE -> setDocumento($nombre);

$documentoE -> setIddocumento($id_documento);
$documentoE -> setIdSolicitud($id_solicitud);

$documentoM= new \modelo\documento($documentoE);
$resultado = $documentoM->creacionVersionamiento();
$resultado = $documentoM->comentariosCrearDoc();
$resultado = $documentoM->comentariosdocumento();
$resultado = $documentoM->actualizardocumento();

unset($documentoE);
unset($documentoM);

echo '
    <link rel="stylesheet" href="../../componente/css/globales/sweetalert2.min.css"> 
    <script src="../../componente/libreria/globales/sweetalert2.all.min.js"></script> 
    <script type="text/javascript" src="../../componente/libreria/globales/jquery-3.6.0.js"></script>
    <script>    
        jQuery(function(){
            Swal.fire({
                icon: "success",
                title: "Versionamiento Creado con Éxito",
                showConfirmButton: false,
                timer: 3000
                }).then(function() {
                window.location.href = "../../administrador/documentos.php";
            });
        });
    </script>';

?>  