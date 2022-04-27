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
                        type="button" role="tab" aria-controls="nav-contact" aria-selected="false">Listado Maestro de Documentos
                        Obsoletos</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <div class="tab-pane fade show active" id="nav-documentos" role="tabpanel"
                    aria-labelledby="nav-documentos-tab">
                    <div class="row ">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <br>
                            <h2 class="card-title text-center"><b>Documentos Vigentes</b></h2>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <h5 id="consulta"></h5>
                            </div>
                        </div>
                    </div>
                </div>  
                <div class="tab-pane fade" id="nav-creacion1" role="tabpanel" aria-labelledby="nav-creacion-tab">
                    <div class="row">
                        <div>
                        </div>
                        <div class="row">
                            <form class="row g-3 form-group"
                                action="../controladorAdministrador/versionamiento.create1.php" method="POST"
                                enctype="multipart/form-data">
                                <div class="col-md-10 col-xs-12 col-sm-12">
                                    <input class="form-control" type="text" name="idDocumento1" id="idDocumento1"
                                        hidden>
                                    <h5 for="data">Seleccionar Documento</h5>
                                    <input class="form-control" type="text" name="documentoAuto1" id="documentoAuto1">
                                    <input class="form-control" type="text" name="proceso1" id="proceso1" hidden>
                                    <input class="form-control" type="text" name="sigla_tipo_documento1"
                                        id="sigla_tipo_documento1" hidden>
                                    <input class="form-control" type="text" name="codigo1" id="codigo1" hidden>
                                </div>
                                <div class="col-md-2 col-xs-12 col-sm-12">
                                    <h5>Versión Siguiente</h5>
                                    <input class="form-control" type="text" name="versionSig1" id="versionSig1"
                                        readonly>
                                </div>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <h5>Descripción del Cambio</h5>
                                    <textarea type="text" class="form-control redondeado" rows="2" id="descriCambio1"
                                        name="descriCambio1" required></textarea>
                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-12">
                                    <h5>Elaborado por:</h5>
                                    <select class="form-control" id="elaborado" name="elaborado" aria-label="E"
                                        aria-describedby="basic-addon1" required></select>
                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-12">
                                    <h5>Revisado por:</h5>
                                    <select class="form-control" id="revisado" name="revisado" aria-label="E"
                                        aria-describedby="basic-addon1" required></select>
                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-12">
                                    <h5>Aprobado por:</h5>
                                    <select class="form-control" id="aprobado" name="aprobado" aria-label="E"
                                        aria-describedby="basic-addon1" required></select>
                                </div>
                                <div class="col-md-3 col-xs-12 col-sm-12">
                                    <h5>Fecha Aprobación</h5>
                                    <input class="form-control" type="date" name="fileDocumento1" id="fileDocumento1"
                                        required>
                                </div>
                                <div class="col-md-3 col-xs-12 col-sm-12">
                                    <h5>Agregar Documento</h5>
                                    <input class="form-control" type="file" name="fileDocumento1" id="fileDocumento1"
                                        required>
                                </div>
                                <div class="col-md-4 col-xs-12 col-sm-12 dt-center" style="align-self: end;">
                                    <button class="btn btn-primary" type="submit"><i class="fas fa-plus"></i>Iniciar
                                        Versión</button>
                                    <button type="reset" id="restaurar" class="btn btn-primary"><i
                                            class="fas fa-undo"></i>
                                        Volver</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="nav-obsoletos" role="tabpanel" aria-labelledby="nav-contact-tab">
                    <div class="row ">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <br>
                            <h3 class="card-title text-center">Documentos Obsoletos</h3>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <h5 id="documentosObs"></h5>
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