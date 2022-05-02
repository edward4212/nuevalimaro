<!-- Se agrega Head -->
<?php include_once "head.php" ?>
<title>Listado Maestro de Documentos</title>

<body class="bg-light d-flex flex-column h-100">
    <!-- se agrega Menu -->
    <?php include_once "menu.php" ?>
    <!-- se Inicia Pagina Inicio  -->
    <main class="flex-shrink-0">
        <div class="container">
            <nav>
                <br>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-documentos-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-documentos" type="button" role="tab" aria-controls="nav-documentos"
                        aria-selected="true">Listado Maestro de Documentos Vigentes</button>
                    <button class="nav-link " id="nav-creacion1-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-creacion1" type="button" role="tab" aria-controls="nav-creacion1"
                        aria-selected="true">Versionamiento</button>
                    <button class="nav-link" id="nav-contact-tab" data-bs-toggle="tab" data-bs-target="#nav-obsoletos"
                        type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Listado Maestro de
                        Documentos Obsoletos</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-documentos" role="tabpanel"
                    aria-labelledby="nav-documentos-tab">
                    <div class="row ">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <br>
                            <h2 class="card-title text-center"><b>Listado Maestro de Documentos Vigentes</b></h2>
                            <br>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <h5 id="consulta"></h5>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-creacion1" role="tabpanel" aria-labelledby="nav-creacion-tab">
                    <div class="row">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <br>
                            <h2 class="card-title text-center"><b>Versionamiento de Documentos </b></h2>
                            <br>
                            <form class="row g-3 form-group"
                                action="../controladorAdministrador/documento/versionamiento.create.php" method="POST"
                                enctype="multipart/form-data">
                                <div class="col-md-10 col-xs-12 col-sm-12">
                                    <input class="form-control" type="text" name="idDocumento1" id="idDocumento1"
                                        hidden>
                                    <h5 for="data"><b>Seleccionar Documento a Actualizar*</b></h5>
                                    <input class="form-control" type="text" name="documentoAuto1" id="documentoAuto1">
                                    <input class="form-control" type="text" name="macroproceso" id="macroproceso"
                                        hidden>
                                    <input class="form-control" type="text" name="proceso" id="proceso" hidden>
                                    <input class="form-control" type="text" name="tipo" id="tipo" hidden>
                                    <input class="form-control" type="text" name="codigo1" id="codigo1" hidden>

                                </div>
                                <div class="col-md-2 col-xs-12 col-sm-12">
                                    <h5><b>Versión Siguiente*</b></h5>
                                    <input class="form-control" type="text" name="versionAnt" id="versionAnt" hidden>
                                    <input class="form-control" type="text" name="versionSig1" id="versionSig1"
                                        readonly>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <h5><b>Descripción del Cambio*</b></h5>
                                    <textarea type="text" class="form-control redondeado" rows="2" id="descriCambio1"
                                        name="descriCambio1" required></textarea>
                                </div>
                                <div class="col-md-8 col-xs-12 col-sm-12">
                                    <h5><b>Elaborado por*</b></h5>
                                    <select class="form-control" id="usuarioCreacion" name="usuarioCreacion"
                                        aria-label="E" aria-describedby="basic-addon1" required></select>
                                </div>
                                <div class="col-md-4 col-xs-12 col-sm-12">
                                    <h5><b>Fecha Elaboración*</b></h5>
                                    <input class="form-control" type="date" name="fechaCreacion" id="fechaCreacion"
                                        onkeydown="return false"
                                        max="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 1 day"));?>" required>
                                </div>
                                <div class="col-md-8 col-xs-12 col-sm-12">
                                    <h5><b>Revisado por*</b></h5>
                                    <select class="form-control" id="usuarioRevision" name="usuarioRevision"
                                        aria-label="E" aria-describedby="basic-addon1" required></select>
                                </div>
                                <div class="col-md-4 col-xs-12 col-sm-12">
                                    <h5><b>Fecha Revisión*</b></h5>
                                    <input class="form-control" type="date" name="fechaRevision" id="fechaRevision"
                                        onkeydown="return false"
                                        max="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 1 day"));?>" required>
                                </div>
                                <div class="col-md-8 col-xs-12 col-sm-12">
                                    <h5><b>Aprobado por*</b></h5>
                                    <select class="form-control" id="usuarioAprobacion" name="usuarioAprobacion"
                                        aria-label="E" aria-describedby="basic-addon1" required></select>
                                </div>
                                <div class="col-md-4 col-xs-12 col-sm-12">
                                    <h5><b>Fecha Aprobación</b></h5>
                                    <input class="form-control" type="date" name="fechaAprobacion" id="fechaAprobacion"
                                        onkeydown="return false"
                                        max="<?php echo date("Y-m-d",strtotime(date("Y-m-d")."- 1 day"));?>" required>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <h5><b>Agregar Documento*</b></h5>
                                    <input class="form-control" type="file" name="fileDocumento" id="fileDocumento"
                                        required>
                                </div>
                                <span class="text-muted">* Campo Obligatorio</span>
                                <div class="col-md-4 col-xs-12 col-sm-12">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-check"></i>Actualizar
                                        Versión</button>
                                    <button type="reset" id="limpiar" name="limpiar" class="btn btn-secondary"><i
                                            class="fas fa-broom"></i>
                                        Limpiar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <br>
                </div>
                <div class="tab-pane fade" id="nav-obsoletos" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="row ">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <br>
                            <h2 class="card-title text-center"><b> Documentos Obsoletos </b></h2>
                            <br>
                            <form class="row g-3 form-group bordeado" id="frmObsoletos" method="POST">
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <input class="form-control" type="text" name="idDocumento2" id="idDocumento2"
                                        hidden>
                                    <h5 for="data"><b>Seleccionar Documento a Inactivar*</b></h5>
                                    <input class="form-control" type="text" name="documentoAuto2" id="documentoAuto2">
                                    <input class="form-control" type="text" name="estadoObs" id="estadoObs"
                                        value="OBSOLETO" hidden>
                                </div>
                                <span class="text-muted">* Campo Obligatorio</span>
                                <br>
                                <div class="col-md-4 col-xs-12 col-sm-12" id="btnObsoletos" hidden>
                                    <button class="btn btn-danger" id="btnObsoleto" namne="btnobsoleto"><i
                                            class="fas fa-times"></i> Inactivar
                                        Documento</button>
                                    <button type="reset" id="limpiar1" name="limpiar1" class="btn btn-secondary"><i
                                            class="fas fa-broom"></i>
                                        Limpiar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12 bordeado" id="obsoletos">
                            <br>
                            <h4 class="card-title text-center">Listado Maestro de Documentos Obsoletos</h4>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <h5 id="documentosObs"></h5>
                            </div>
                        </div>
                        <!-- Modal para actualizaciones sobre la version-->
                        <div class="modal fade bd-example-modal-lg" id="activarVersion" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><b>Activar la Version</b></h5>
                                        <button type="button" id="btnCerrarModal" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="row g-3 form-group" id="ModificarTipoDoc" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <input class="form-control" type="number" name="idDocumentoAct"
                                                    id="idDocumentoAct" hidden>
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <h5><b>Se activara el documento y la version:</b></h5>
                                                    <input class="form-control inicialM" type="text"
                                                        name="txtNombreDocum" id="txtNombreDocum" readonly required>
                                                        <input class="form-control" type="text" name="estadoObs" id="estadoObs"
                                        value="VIGENTE" hidden>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btnModificarTipoDoc" class="btn btn-primary"><i
                                                    class="far fa-edit"></i> Activar</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
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
    <script src="../js/administrador/versionamiento.js"></script>
</body>

</html>