<?php

include_once "../entidadAdministrador/proceso.entidad.php";
include_once "../modeloAdministrador/proceso.modelo.php";

$id_proceso = $_POST['numidProcesosMod'];
$id_macroproces=$_POST['idInput1'];
$macroprocesoAnt = $_POST['txtMacroActual'];
$macroprocesoNuev = $_POST['idInput1'];
$procesoAnt = $_POST['txtProcesoAnt'];
$procesoNuevo = $_POST['txtProcesoMod'];
$sigla_proceso = $_POST['txtSiglaProcesoMod'];
$objetivo = $_POST['txtObjetiProMod'];


if (!empty($macroprocesoNuev)) 
{
    $directorio = "../documentos/macroprocesos/$macroprocesoAnt/$procesoAnt";
    $directorioNew = "../documentos/macroprocesos/$$macroprocesoNuev/$procesoNuevo ";

    rename ($directorio, $directorioNew);

    $procesoE = new \entidad\Proceso();
    $procesoE -> setIdProceso($id_proceso);
    $procesoE -> setSiglaProceso($sigla_proceso);
    $procesoE -> setProceso($proceso);
    $procesoE -> setSiglaProceso($sigla_proceso);
    $procesoE -> setSiglaProceso($sigla_proceso);

    $procesoM= new \modelo\Proceso($procesoE);
    $resultado = $procesoM->actualizarProceso();

    unset($procesoE);
    unset($procesoM);

    echo json_encode($resultado);
    
}else{

    $directorio = "../documentos/macroprocesos/$macroprocesoAnt/$procesoAnt";
    $directorioNew = "../documentos/macroprocesos/$$macroprocesoAnt/$procesoNuevo ";

    rename ($directorio, $directorioNew);

    $procesoE = new \entidad\Proceso();
    $procesoE -> setIdProceso($id_proceso);
    $procesoE -> setProceso($proceso);
    $procesoE -> setSiglaProceso($sigla_proceso);

    $procesoM= new \modelo\Proceso($procesoE);
    $resultado = $procesoM->actualizarProceso();

    unset($procesoE);
    unset($procesoM);

    echo json_encode($resultado);
}

?>