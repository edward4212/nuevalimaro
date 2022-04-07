<?php

include_once "../entidadAdministrador/proceso.entidad.php";
include_once "../modeloAdministrador/proceso.modelo.php";

$procesos = $_POST['txtProceso'];
$proceso =  ucwords($procesos);

$macroproceso = $_POST['tipoMacroProceso'];

$macroprocesoN = $_POST['idInput'];

$sigla_procesos = $_POST['txtSiglaProceso'];
$sigla_proceso = strtoupper($sigla_procesos);

$objetivo = $_POST['txtObjetivoproceso'];



$directorio = "../documentos/macroprocesos/$macroprocesoN/$proceso/";
   
if(!file_exists($directorio)){
    mkdir($directorio,0777,true);        
}

$procesoE = new \entidad\Proceso();
$procesoE -> setIdMacroproceso($macroproceso);
$procesoE -> setProceso($proceso);
$procesoE -> setSiglaProceso($sigla_proceso);
$procesoE -> setObjetivo($objetivo);

$procesoM= new \modelo\Proceso($procesoE);
$resultado = $procesoM->crearProceso();

unset($procesoE);
unset($procesoM);

echo json_encode($resultado);


?>