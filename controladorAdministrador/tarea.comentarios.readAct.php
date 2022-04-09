<?php

include_once "../entidadAdministrador/tarea.entidad.php";
include_once "../modeloAdministrador/tarea.modelo.php";
include_once "../controladorLogin/logueo.read.php";

$id_tarea = $_POST['numIdTidTareaCom1Act'];  

$tareaE = new \entidad\Tarea();
$tareaE -> setIdTarea($id_tarea);

$tareaM= new \modelo\Tarea($tareaE);

$resultado = $tareaM->comentariosRev();

unset($tareaE);
unset($tareaM);

echo json_encode($resultado);


?>  