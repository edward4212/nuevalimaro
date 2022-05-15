<!-- Se agrega Head -->
<?php include_once "head.php" ?>
<title>Solicitudes</title>

<body class="bg-light d-flex flex-column h-100">
    <!-- se agrega Menu -->
    <?php include_once "menu.php" ?>
    <!-- se Inicia Pagina Inicio  -->
    <main class="flex-shrink-0">
        <div class="container">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active " id="nav-solicitudes-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-solicitudes" type="button" role="tab" aria-controls="nav-solicitudes"
                        aria-selected="false">Tareas hola Asignadas</button>
                    <button class="nav-link " id="nav-proceso-tab" data-bs-toggle="tab" data-bs-target="#nav-proceso"
                        type="button" role="tab" aria-controls="nav-proceso" aria-selected="true">Tareas En
                        Proceso</button>
                    <button class="nav-link " id="nav-finalizadas-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-finalizadas" type="button" role="tab" aria-controls="nav-finalizadas"
                        aria-selected="true">Tareas Finalizadas</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade  show active" id="nav-solicitudes" role="tabpanel"
                    aria-labelledby="nav-solicitudes-tab">
                    <div class="row ">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <br>
                            <h2 class="card-title text-center"><b>Tareas Asignadas</b></h2>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <form action="" class="form-group" id="iniciarTarea">
                                    <input type="number" name="numIdSolicitud" id="numIdSolicitud" hidden>
                                    <input type="number" name="numIdSolicitud3" id="numIdSolicitud3" hidden>
                                    <br>
                                    <h5 id="solicitudesAsig"></h5>
                                </form>
                            </div>

                        </div>
                        <!-- Modal para ver comentarios-->
                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><b>Comentarios de la Tarea</b>
                                        </h5>
                                        <button type="button" id="btnCerrarModal" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form action="" class="form-group" id="buscar1">
                                        <div class="modal-body">
                                            <input type="number" name="numIdSolicitud1" id="numIdSolicitud1" hidden>
                                            <div class="col-md-12 col-xs-12 col-sm-12">
                                                <h5><b>Agregar Comentario</b></h5>
                                                <label class="text-muted"> Caracteres restantes: <span></span></label>
                                                <textarea type="text" class="form-control inicialM" rows="2"
                                                    id="comentrioEmpleado" name="comentrioEmpleado" maxlength="600"
                                                    required></textarea>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" id="btnCrearcomentario"
                                                name="btnCrearcomentario" data-bs-dismiss="modal"> <i
                                                    class="fas fa-plus"></i>Agregar
                                                Comentario</button>
                                        </div>
                                        <div class="modal-body">
                                            <h5 id="comentarios"></h5>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> <i
                                                    class="fas fa-undo"></i> Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-proceso" role="tabpanel" aria-labelledby="nav-proceso-tab">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <br>
                            <h3 class="card-title text-center">Tareas En Proceso</h3>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <form action="" class="form-group" id="buscarTareaComentario1">
                                    <input type="number" name="numIdTarea" id="numIdTarea" hidden>
                                    <input type="number" name="numIdTidTareaCom1" id="numIdTidTareaCom1" hidden>
                                    <br>
                                    <h5 id="tareas"></h5>
                                </form>
                            </div>
                        </div>
                        <!-- Modal para administrar tarea-->
                        <div class="modal fade" id="modaltarea" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ADMINISTRAR TAREA</h5>
                                        <button type="button" id="btnCerrarModal" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="row g-3 form-group"
                                        action="../controladorAdministrador/versionamiento.create.php" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <input type="number" name="numIdTarea1" id="numIdTarea1" hidden>
                                                <div class="col-md-10 col-xs-12 col-sm-12">
                                                    <input class="form-control" type="text" name="numIdSolT"
                                                        id="numIdSolT" hidden>
                                                    <input class="form-control" type="text" name="idDocumento"
                                                        id="idDocumento" hidden>
                                                    <h5 for="data">Seleccionar Documento</h5>
                                                    <input class="form-control" type="text" name="documentoAuto"
                                                        id="documentoAuto">
                                                    <input class="form-control" type="text" name="proceso" id="proceso"
                                                        hidden>
                                                    <input class="form-control" type="text" name="sigla_tipo_documento"
                                                        id="sigla_tipo_documento" hidden>
                                                    <input class="form-control" type="text" name="codigo" id="codigo"
                                                        hidden>
                                                </div>
                                                <div class="col-md-2 col-xs-12 col-sm-12">
                                                    <h5>Versión Siguiente</h5>
                                                    <input class="form-control" type="text" name="versionSig"
                                                        id="versionSig" readonly>
                                                </div>
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <h5>Descripción de la Versión</h5>
                                                    <textarea type="text" class="form-control redondeado" rows="2"
                                                        id="descriCambio" name="descriCambio" required></textarea>
                                                </div>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5>Agregar Documento</h5>
                                                    <input class="form-control" type="file" name="fileDocumento"
                                                        id="fileDocumento">
                                                </div>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5>Seleccionar Usuario para Revisión</h5>
                                                    <select class="form-control" id="empleado" name="empleado"
                                                        aria-label="E" aria-describedby="basic-addon1"
                                                        required></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit" data-bs-dismiss="modal"> <i
                                                    class="fas fa-plus"></i>Iniciar Versión</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> <i
                                                    class="fas fa-undo"></i> Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-finalizadas" role="tabpanel" aria-labelledby="nav-finalizadas-tab">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <br>
                            <h3 class="card-title text-center">Tareas Finalizadas</h3>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <form action="" class="form-group" id="buscarTareaComentario1">
                                    <input type="number" name="numIdTarea" id="numIdTarea" hidden>
                                    <input type="number" name="numIdTidTareaCom1" id="numIdTidTareaCom1" hidden>
                                    <br>
                                    <h5 id="tareas"></h5>
                                </form>
                            </div>
                        </div>
                        <!-- Modal para administrar tarea-->
                        <div class="modal fade" id="modaltarea" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">ADMINISTRAR TAREA</h5>
                                        <button type="button" id="btnCerrarModal" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="row g-3 form-group"
                                        action="../controladorAdministrador/versionamiento.create.php" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <input type="number" name="numIdTarea1" id="numIdTarea1" hidden>
                                                <div class="col-md-10 col-xs-12 col-sm-12">
                                                    <input class="form-control" type="text" name="numIdSolT"
                                                        id="numIdSolT" hidden>
                                                    <input class="form-control" type="text" name="idDocumento"
                                                        id="idDocumento" hidden>
                                                    <h5 for="data">Seleccionar Documento</h5>
                                                    <input class="form-control" type="text" name="documentoAuto"
                                                        id="documentoAuto">
                                                    <input class="form-control" type="text" name="proceso" id="proceso"
                                                        hidden>
                                                    <input class="form-control" type="text" name="sigla_tipo_documento"
                                                        id="sigla_tipo_documento" hidden>
                                                    <input class="form-control" type="text" name="codigo" id="codigo"
                                                        hidden>
                                                </div>
                                                <div class="col-md-2 col-xs-12 col-sm-12">
                                                    <h5>Versión Siguiente</h5>
                                                    <input class="form-control" type="text" name="versionSig"
                                                        id="versionSig" readonly>
                                                </div>
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <h5>Descripción de la Versión</h5>
                                                    <textarea type="text" class="form-control redondeado" rows="2"
                                                        id="descriCambio" name="descriCambio" required></textarea>
                                                </div>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5>Agregar Documento</h5>
                                                    <input class="form-control" type="file" name="fileDocumento"
                                                        id="fileDocumento">
                                                </div>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5>Seleccionar Usuario para Revisión</h5>
                                                    <select class="form-control" id="empleado" name="empleado"
                                                        aria-label="E" aria-describedby="basic-addon1"
                                                        required></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button class="btn btn-primary" type="submit" data-bs-dismiss="modal"> <i
                                                    class="fas fa-plus"></i>Iniciar Versión</button>
                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal"> <i
                                                    class="fas fa-undo"></i> Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php include_once "footer.php" ?>
    <script src="../js/administrador/tareas.adm.js"></script>
</body>

</html>