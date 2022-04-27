<!-- Se agrega Head -->
<?php include_once "head.php" ?>
<title>Gestión de Usuarios</title>

<body class="bg-light d-flex flex-column h-100">
    <!-- se agrega Menu -->
    <?php include_once "menu.php" ?>
    <!-- se Inicia Pagina Inicio  -->
    <main class="flex-shrink-0">
        <div class="container">
            <nav class="">
                <br>
                <div class="nav nav-pills " id="nav-tab" role="tablist">
                    <button class="nav-link active " id="nav-usuarios-tab" data-bs-toggle="tab"
                        data-bs-target="#nav-usuarios" type="button" role="tab" aria-controls="nav-usuarios"
                        aria-selected="false">Usuarios</button>
                    <button class="nav-link " id="nav-cargo-tab" data-bs-toggle="tab" data-bs-target="#nav-cargo"
                        type="button" role="tab" aria-controls="nav-cargo" aria-selected="true">Cargos</button>
                    <button class="nav-link  " id="nav-rol-tab" data-bs-toggle="tab" data-bs-target="#nav-rol"
                        type="button" role="tab" aria-controls="nav-rol" aria-selected="false">Roles</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">
                <!-- Modulo para el manejo de usuarios-->
                <div class="tab-pane fade show active " id="nav-usuarios" role="tabpanel"
                    aria-labelledby="nav-usuarios-tab">
                    <div class="row ">
                        <!-- Formulario para la creacion de usuarios-->
                        <div class="col-md-12 col-xs-12 col-sm-12 ">
                            <h2 class="card-title text-center"><b>Usuarios</b></h2>
                            <br>
                            <button type="button" class="btn btn-primary mb-3" id="btnFomularioCrear"><i
                                    class="fas fa-plus"></i> Crear Usuario</button>
                            <button type="button" id="volverRegistro" class="btn btn-primary mb-3" hidden><i
                                    class="fas fa-eye"></i>
                                Ver usuarios Registrados</button>
                            <br>
                            <br>
                            <form class="row g-3 form-group needs-validation bordeado" id="usuario" method="POST"
                                hidden>
                                <h4 class="card-title text-center"><b>Crear Empleado</b></h4>
                                <div class="col-md-6 col-xs-12 col-sm-12">
                                    <h5><b>Nombre Completo Empleado*</b></h5>
                                    <input class="form-control inicialM" type="text" name="txtNombreEmpleado"
                                        id="txtNombreEmpleado" aria-label="E" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-12">
                                    <h5><b>Correo Electrónico* </b></h5>
                                    <input type="email" class="form-control" name="txtCorreoEmpleado"
                                        id="txtCorreoEmpleado" placeholder="name@example.com"
                                        pattern="^[a-zA-Z0-9_.-]*$" title="Introduzca una direccion de correo valido"
                                        aria-label="E" aria-describedby="emailHelp" style="text-transform:lowercase;"
                                        required>
                                    <span id="emailOK"></span>
                                </div>
                                <div class="col-md-3 col-xs-12 col-sm-12">
                                    <h5><b>Cargo*</b></h5>
                                    <select class="form-control " id="cargosUsuario" name="cargosUsuario" aria-label="E"
                                        aria-describedby="basic-addon1" required></select>
                                </div>
                                <div class="col-md-3 col-xs-12 col-sm-12">
                                    <h5><b>Rol*</b></h5>
                                    <select class="form-control " id="rolesUsuario" name="rolesUsuario" aria-label="E"
                                        aria-describedby="basic-addon1" required></select>
                                </div>
                                <div class="col-md-3 col-xs-12 col-sm-12">
                                    <h5><b>Usuario*</b></h5>
                                    <input class="form-control" type="text" name="txtUsuario" id="txtUsuario"
                                        aria-label="E" aria-describedby="basic-addon1" required>
                                </div>
                                <div class="col-md-3 col-xs-12 col-sm-12">
                                    <h5><b>Clave Inicial</b></h5>
                                    <input class="form-control" type="password" name="txtClaveInicial"
                                        id="txtClaveInicial" autocomplete="current-password" aria-label="E"
                                        aria-describedby="basic-addon1" value="12345" readonly required>
                                </div>
                                <span class="text-muted">* Campo Obligatorio</span>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <button type="submit" class="btn btn-primary mb-3" id="btnRegistrarUsuario"><i
                                            class="fas fa-plus"></i> Crear</button>
                                    <button type="reset" class="btn btn-secondary mb-3"><i class="fas fa-broom"></i>
                                        Limpiar</button>
                                </div>
                            </form>
                        </div>
                        <!--Fin Formulario para la creacion de usuarios-->
                        <!--Se muestras los usuario registrados-->
                        <div class="col-md-12 col-xs-12 col-sm-12 bordeado" id="usuariosRegistrados">
                            <br>
                            <h4 class="card-title text-center"><b>Usuarios Registrados</b></h4>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <br>
                                <h5 id="usuarios"></h5>
                            </div>
                        </div>
                        <!--Fin de los usuario registrados-->
                        <!-- Modal para actualizaciones clave usuario-->
                        <div class="modal fade bd-example-modal-lg" id="modClaveUsuario" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><b>Restablecer Contraseña de
                                                Usuario</b></h5>
                                        <button type="button" id="btnCerrarModal" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="row g-3 form-group" id="modifClaveUsu" method="POST">
                                        <div class="modal-body">
                                            <div class="row">
                                                <input class="form-control" type="number" name="numIdUsurioMoClave"
                                                    id="numIdUsurioMoClave" hidden>
                                                <input class="form-control" type="text" name="UsurioMoClave"
                                                    id="UsurioMoClave" hidden>
                                                <input class="form-control" type="text" name="NombreMoClave"
                                                    id="NombreMoClave" hidden>
                                                <input class="form-control" type="text" name="CorreoUsurioMoClave"
                                                    id="CorreoUsurioMoClave" hidden>
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <h5><b>Restablecer Contraseña</b></h5>
                                                    <input class="form-control" type="password" name="txtClaveMod"
                                                        id="txtClaveMod" autocomplete="current-password" aria-label="E"
                                                        aria-describedby="basic-addon1" value="12345" hidden>
                                                    <span class="">Se generará una nueva contraseña automática y será
                                                        notificada al correo registrado </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btnModClaveUsu" class="btn btn-primary"><i
                                                    class="far fa-edit"></i> Restablecer</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                                    class="fas fa-undo"></i> Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Fin para actualizaciones clave usuario-->
                        <!-- Modal para actualizaciones sobre Usuario-->
                        <div class="modal fade bd-example-modal-xl" id="modUsuario" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-xl">
                                <div class="modal-content ">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><b>Actualizar Información del
                                                Usuario</b></h5>
                                        <button type="button" id="btnCerrarModal" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="row g-3 form-group" id="actulizarUsuario" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <input class="form-control" type="number" name="numIdUsuMod"
                                                    id="numIdUsuMod" hidden>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5><b>Nombre Empleado</b></h5>
                                                    <input class="form-control inicialM " type="text"
                                                        name="txtNombreMod" id="txtNombreMod">
                                                    <br>
                                                </div>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5><b>Correo Electrónico</b></h5>
                                                    <input class="form-control" type="text" name="txtCorreoMod"
                                                        id="txtCorreoMod"
                                                        onkeyup="javascript:this.value=this.value.toLowerCase();">
                                                    <span id="emailOKM"></span>
                                                    <br>
                                                </div>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5><b>Cargo Actual</b></h5>
                                                    <input class="form-control" type="text" name="idCargoActuUsuAnt"
                                                        id="idCargoActuUsuAnt" aria-label="E"
                                                        aria-describedby="basic-addon1" hidden readonly>
                                                    <input class="form-control" type="text" name="cargoActuUsuAnt"
                                                        id="cargoActuUsuAnt" aria-label="E"
                                                        aria-describedby="basic-addon1" readonly>
                                                    <br>
                                                    <h5><b>Cargo Nuevo</b></h5>
                                                    <select class="form-control " id="cargosUsuarioAct"
                                                        name="cargosUsuarioAct" aria-label="E"
                                                        aria-describedby="basic-addon1"></select>
                                                    <br>
                                                </div>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5><b>Rol Actual</b></h5>
                                                    <input class="form-control" type="text" name="idRolActuUsuAnt"
                                                        id="idRolActuUsuAnt" aria-label="E"
                                                        aria-describedby="basic-addon1" hidden readonly>
                                                    <input class="form-control" type="text" name="rolActuUsuAnt"
                                                        id="rolActuUsuAnt" aria-label="E"
                                                        aria-describedby="basic-addon1" readonly>
                                                    <br>
                                                    <h5><b>Rol Nuevo</b></h5>
                                                    <select class="form-control " id="rolesUsuarioAct"
                                                        name="rolesUsuarioAct" aria-label="E"
                                                        aria-describedby="basic-addon1"></select>   
                                                </div>

                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btnActualizarEmpl" class="btn btn-primary"><i
                                                    class="far fa-edit"></i> Modificar</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                                    class="fas fa-undo"></i> Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Modal para actualizaciones sobre Usuario-->
                        <!-- Modal para actualziacion de estado Cargo-->
                        <div class="modal fade bd-example-modal-lg" id="estadoUsuario" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><b>Cambiar estado del usuario</b>
                                        </h5>
                                        <button type="button" id="btnCerrarModal" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="row g-3 form-group" id="inactivarUsuario" method="POST">
                                        <div class="modal-body">
                                            <div class="row">
                                                <input class="form-control" type="number" name="numidUsuElim"
                                                    id="numidUsuElim" hidden>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5><b>Estado actual del usuario</b></h5>
                                                    <input class="form-control" type="text" name="estadoUsuActu"
                                                        id="estadoUsuActu" aria-label="E"
                                                        aria-describedby="basic-addon1" readonly>
                                                    <br>
                                                </div>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5><b>Nuevo estado del usuario</b></h5>
                                                    <select class="form-group select1" id="estadoModusuario"
                                                        name="estadoModusuario">
                                                        <option >- Seleccione el nuevo estado -</option>
                                                        <option value="ACTIVO">Activo</option>
                                                        <option value="INACTIVO">Inactivo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btnEliminarUsuario" class="btn btn-primary"><i
                                                    class="fas fa-times"></i> Cambiar Estado</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                                    class="fas fa-undo"></i> Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Fin Modal para actualziacion de estado Cargo-->
                    </div>
                </div>
                <!-- Fin Modulo para el manejo de usuarios-->
                <!-- Modulo para el manejo de cargos-->
                <div class="tab-pane fade " id="nav-cargo" role="tabpanel" aria-labelledby="nav-cargo-tab">
                    <div class="row ">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <h2 class="card-title text-center"><b>Cargos</b></h2>
                            <br>
                            <button type="button" class="btn btn-primary mb-3" id="btnFomularioCargo"><i
                                    class="fas fa-plus"></i> Crear Cargo</button>
                            <button type="button" id="volverRegistroCargo" class="btn btn-primary mb-3" hidden><i
                                    class="fas fa-eye"></i>
                                Ver Cargos Registrados</button>
                            <br>
                            <br>
                            <form class="row g-3 form-group bordeado"
                                action="../controladorAdministrador/cargo.create.php" method="POST"
                                enctype="multipart/form-data" hidden id="formCArgo">
                                <h4 class="card-title text-center"><b>Crear Cargo</b></h4>
                                <div class="col-md-6 col-xs-12 col-sm-12">
                                    <h5><b>Nombre Cargo*</b></h5>
                                    <input class="form-control inicialM " type="text" name="txtCargo" id="txtCargo"
                                        required>
                                </div>
                                <div class="col-md-6 col-xs-12 col-sm-12 ">
                                    <h5><b>Manual de Funciones*</b></h5>
                                    <input class="form-control" type="file" id="fileCargo" name="fileCargo" multiple>
                                </div>
                                <span class="text-muted">* Campo Obligatorio</span>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <button type="submit" class="btn btn-primary mb-3"><i class="fas fa-plus"></i> Crear
                                        Cargo</button>
                                    <button type="reset" class="btn btn-secondary mb-3"><i class="fas fa-broom"></i>
                                        Limpiar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12 bordeado" id="cargosRegistradoss">
                            <h4 class="card-title text-center"><b>Cargos Registrados</b></h4>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <br>
                                <h5 id="cargos"></h5>
                            </div>
                        </div>
                        <!-- Modal para actualizaciones sobre cargo-->
                        <div class="modal fade bd-example-modal-lg" id="modCargo" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><b>Actualizar Cargo</b></h5>
                                        <button type="button" id="btnCerrarModal" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="row g-3 form-group"
                                        action="../controladorAdministrador/cargo.update.php" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <input class="form-control" type="number" name="numidCargoMod"
                                                    id="numidCargoMod" hidden>
                                                <input class="form-control" type="text" name="txtCargoModAnt"
                                                    id="txtCargoModAnt" hidden>
                                                <input class="form-control" type="text" name="txtManualModAnt"
                                                    id="txtManualModAnt" hidden>
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <h5><b>Cargo</b></h5>
                                                    <input class="form-control inicialM" type="text" name="txtCargoMod"
                                                        id="txtCargoMod">
                                                    <br>
                                                </div>
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <h5><b>Manual de Funciones</b></h5>
                                                    <input class="form-control" type="file" id="fileCargoMod"
                                                        name="fileCargoMod" multiple>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary"><i class="far fa-edit"></i>
                                                Modificar</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                                    class="fas fa-undo"></i> Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal para actualziacion de estado Cargo-->
                        <div class="modal fade bd-example-modal-lg" id="estadoCargo" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><b>Cambiar estado del cargo</b></h5>
                                        <button type="button" id="btnCerrarModal" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="row g-3 form-group" id="inactivarCargo" method="POST">
                                        <div class="modal-body">
                                            <div class="row">
                                                <input class="form-control" type="number" name="numidCargoElim"
                                                    id="numidCargoElim" hidden>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5><b>Estado Actual</b></h5>
                                                    <input class="form-control" type="text" name="txtCargoElim"
                                                        id="txtCargoElim" readonly>
                                                    <br>
                                                </div>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5><b>Nuevo estado del cargo</b></h5>
                                                    <select class="form-group select1" id="estadoModCargo"
                                                        name="estadoModCargo">
                                                        <option >- Seleccione el nuevo estado -</option>
                                                        <option value="ACTIVO">Activo</option>
                                                        <option value="INACTIVO">Inactivo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btnEliminarCargo" class="btn btn-primary"><i
                                                    class="fas fa-times"></i> Cambiar Estado</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                                    class="fas fa-undo"></i> Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Fin Modulo para el manejo de cargo-->
                <!-- Modulo para el manejo de rol-->
                <div class="tab-pane fade " id="nav-rol" role="tabpanel" aria-labelledby="nav-rol-tab">
                    <div class="row ">
                        <div class="col-md-12 col-xs-12 col-sm-12">
                            <h2 class="card-title text-center"><b>Roles</b></h2>
                            <br>
                            <button type="button" class="btn btn-primary mb-3" id="btnFomularioRol"><i
                                    class="fas fa-plus"></i> Crear Rol</button>
                            <button type="button" id="volverRegistroRol" class="btn btn-primary mb-3" hidden><i
                                    class="fas fa-eye"></i>
                                Ver Roles Registrados</button>
                            <br>
                            <form class="form-group bordeado" id="rol" method="POST" hidden>
                                <h4 class="card-title text-center"><b>Crear Rol</b></h4>
                                <div class="col-md-3 col-xs-12 col-sm-12">
                                    <h5><b>Nombre Rol*</b></h5>
                                    <input class="form-control inicialM" type="text" name="txtRol" id="txtRol" required>
                                </div>
                                <span class="text-muted">* Campo Obligatorio</span>
                                <div class="col-md-12 col-xs-12 col-sm-12">
                                    <button type="submit" class="btn btn-primary mb-3" id="btnRegistrarRol"><i
                                            class="fas fa-plus"></i> Crear Rol</button>
                                    <button type="reset" class="btn btn-secondary mb-3"><i class="fas fa-broom"></i>
                                        Limpiar</button>
                                </div>
                            </form>
                        </div>
                        <div class="col-md-12 col-xs-12 col-sm-12 bordeado" id="rolesRegistrados">
                            <h4 class="card-title text-center"><b>Roles Registrados</b></h4>
                            <div class="col-md-12 col-xs-12 col-sm-12">
                                <h5 id="roles"></h5>
                            </div>
                        </div>
                        <!-- Modal para actualizaciones sobre roles-->
                        <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><b>Actualizar rol</b></h5>
                                        <button type="button" id="btnCerrarModal" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="row g-3 form-group" id="ModificarRol" method="POST"
                                        enctype="multipart/form-data">
                                        <div class="modal-body">
                                            <div class="row">
                                                <input class="form-control" type="number" name="numidRolMod"
                                                    id="numidRolMod" hidden>
                                                <div class="col-md-12 col-xs-12 col-sm-12">
                                                    <h5><b>Rol</b></h5>
                                                    <input class="form-control inicialM" type="text" name="txtRolMod"
                                                        id="txtRolMod">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btnModificarRol" class="btn btn-primary"><i
                                                    class="far fa-edit"></i> Modificar</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                                    class="fas fa-undo"></i> Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- Modal para actualziacion de estado rol-->
                        <div class="modal fade bd-example-modal-lg" id="exampleModal1" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel"><b>Cambiar el estado del rol</b></h5>
                                        <button type="button" id="btnCerrarModal" class="btn-close"
                                            data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <form class="row g-3 form-group" id="inactivarRol" method="POST">
                                        <div class="modal-body">
                                            <div class="row">
                                                <input class="form-control" type="number" name="numidRolElim"
                                                    id="numidRolElim" hidden>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5><b>Estado actual</b></h5>
                                                    <input class="form-control" type="text" name="txtRolElim"
                                                        id="txtRolElim" readonly>
                                                    <br>
                                                </div>
                                                <div class="col-md-6 col-xs-12 col-sm-12">
                                                    <h5><b>Nuevo estado del rol</b></h5>
                                                    <select class="form-group select1" id="estadoModRol" name="estadoModRol">
                                                        <option >- Seleccione el nuevo estado -</option>
                                                        <option value="ACTIVO">Activo</option>
                                                        <option value="INACTIVO">Inactivo</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" id="btnEliminarRol" class="btn btn-primary"><i
                                                    class="fas fa-times"></i> Cambiar Estado</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i
                                                    class="fas fa-undo"></i> Volver</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Gin Modulo para el manejo de rol-->
            </div>
        </div>
    </main>
    <?php include_once "footer.php" ?>
    <script src="../js/administrador/usuario.adm.js"></script>

</body>

</html>