<?php

include_once "../entidadAdministrador/macroproceso.entidad.php";
include_once "../modeloAdministrador/macroproceso.modelo.php";

$id_macroproceso = $_POST['numMacroMod'];
$macroproceso = $_POST['txtMacroprocesoMod'];

$objetivoAnt = $_POST['txtMacroprocesoModAnt'];
$objetivo = $_POST['txtObjetivoMacroprocesoMod'];


if (!empty($macroprocesos) && !empty($objetivos)){

    $directorio = "../documentos/macroprocesos/$objetivoAnt/";
    $directorioNew = "../documentos/macroprocesos/$objetivo/";

    rename ($directorio, $directorioNew);

    $macroprocesoE = new \entidad\macroproceso();
    $macroprocesoE -> setIdmacroproceso($id_macroproceso);
    $macroprocesoE -> setMacroproceso($macroproceso);
    $macroprocesoE -> setObjetivo($objetivo);

    $macroprocesoM= new \modelo\macroproceso($macroprocesoE);
    $resultado = $macroprocesoM->actualizarmacroproceso();

    unset($macroprocesoE);
    unset($macroprocesoM);

    echo json_encode($resultado);
}

?>