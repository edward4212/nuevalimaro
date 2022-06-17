<style type="text/css">
/* ============ desktop view ============ */
@media all and (min-width: 992px) {

    .dropdown-menu li {
        position: relative;
    }

    .dropdown-menu .submenu {
        display: none;
        position: absolute;
        left: 100%;
        top: -7px;
        background-color: #f8f9fa !important;
    }

    .dropdown-menu .submenu-left {
        right: 100%;
        left: auto;
    }

    .dropdown-menu>li:hover {
        background-color: #f1f1f1
    }

    .dropdown-menu>li:hover>.submenu {
        display: block;
    }
}

/* ============ desktop view .end// ============ */

/* ============ small devices ============ */
@media (max-width: 991px) {

    .dropdown-menu .dropdown-menu {
        margin-left: 0.7rem;
        margin-right: 0.7rem;
        margin-bottom: .5rem;
    }

}

/* ============ small devices .end// ============ */
</style>


<script type="text/javascript">
//	window.addEventListener("resize", function() {
//		"use strict"; window.location.reload(); 
//	});


document.addEventListener("DOMContentLoaded", function() {


    /////// Prevent closing from click inside dropdown
    document.querySelectorAll('.dropdown-menu').forEach(function(element) {
        element.addEventListener('click', function(e) {
            e.stopPropagation();
        });
    })



    // make it as accordion for smaller screens
    if (window.innerWidth < 992) {

        // close all inner dropdowns when parent is closed
        document.querySelectorAll('.navbar .dropdown').forEach(function(everydropdown) {
            everydropdown.addEventListener('hidden.bs.dropdown', function() {
                // after dropdown is hidden, then find all submenus
                this.querySelectorAll('.submenu').forEach(function(everysubmenu) {
                    // hide every submenu as well
                    everysubmenu.style.display = 'none';
                });
            })
        });

        document.querySelectorAll('.dropdown-menu a').forEach(function(element) {
            element.addEventListener('click', function(e) {

                let nextEl = this.nextElementSibling;
                if (nextEl && nextEl.classList.contains('submenu')) {
                    // prevent opening link if link needs to open dropdown
                    e.preventDefault();
                    console.log(nextEl);
                    if (nextEl.style.display == 'block') {
                        nextEl.style.display = 'none';
                    } else {
                        nextEl.style.display = 'block';
                    }

                }
            });
        })
    }
    // end if innerWidth

});
// DOMContentLoaded  end
</script>



<!-- Inicio Menu -->
<header class="navbar navbar-expand-md  ">
    <nav class=" navbar  bg-light container-lg flex-wrap flex-md-nowrap fixed-top head-model border"
        aria-label="Main navigation" style="top: 5px;">
        <div class="container-fluid ">
            <a class="navbar-brand">
                <img src="../documentos/limaro/horizontal_on_white_by_logaster.png" alt="" width="100" height="40">
                <img src="../documentos/empresa/logo/<?php $logo= $_SESSION['logo']; echo $logo;?>" alt="" width="100"
                    height="40">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
                aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"><i class="fas fa-angle-double-down"></i></span>
            </button>
            <div class="collapse navbar-collapse " id="navbarNavAltMarkup">
                <ul class=" navbar-nav flex-row flex-wrap bd-navbar-nav pt-2 py-md-0  ">
                    <li class="nav-item col-6 col-md-auto">
                        <a class="nav-link p-2" aria-current="page" href="inicio.php"><i class="fas fa-home"></i>
                            Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle p-2" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-indent"></i>
                            Indice de Documentos</a>
                        <ul class="dropdown-menu bg-light" aria-labelledby="navbarDropdownMenuLink">
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2 dropdown-item" href="macroprocesos.php"><i
                                        class="fas fa-cogs"></i>
                                    Gestión de Macroprocesos</a>
                            </li>
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2 dropdown-item" href="procesos.php"><i class="fas fa-cog"></i>
                                    Gestión de Procesos</a>
                            </li>
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2 dropdown-item" href="documentos.php"><i class="fas fa-book"></i>
                                    Gestión de Tipo de Documentos</a>
                            </li>
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2 dropdown-item" href="registro.php"><i
                                        class="far fa-address-book"></i>
                                    Gestión de Registro de Documentos</a>
                            </li>
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2 dropdown-item" href="vigentes.php"><i class="fas fa-list"></i>
                                    Listado Maestro de Documentos Vigentes</a>
                            </li>
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2 dropdown-item" href="obsoletos.php"><i
                                        class="far fa-times-circle"></i>
                                    Listado Maestro de Documentos Obsoletos</a>
                            </li>
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2 dropdown-item" href="versionamiento.php"><i
                                        class="far fa-plus-square"></i>
                                    Versionamiento</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i
                                class="fas fa-th-list"></i> Solicitudes </a>

                        <ul class="dropdown-menu" style="background-color: #f8f9fa!important;">
                            <li><a class="dropdown-item" style="color: #0d6efd;" href="#"><i
                                        class="far fa-calendar-alt"></i> Gestión De Solicitudes <i
                                        class="fas fa-caret-right"></i> </a>
                                <ul class="submenu dropdown-menu">
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="solicitudes.php"><i
                                                class="far fa-calendar-check"></i> Solicitudes
                                            Radicadas</a></li>
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="solicitudesAs.php"><i
                                                class="fas fa-calendar-alt"></i> Solicitudes
                                            Asignadas</a></li>
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="solicitudesDe.php"><i
                                                class="fas fa-hourglass-end"></i> Solicitudes En
                                            Desarrollo</a></li>
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="solicitudesFI.php"><i
                                                class="far fa-calendar-times"></i> Solicitudes
                                            Finalizadas</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" style="color: #0d6efd;" href="#"><i
                                        class="fas fa-file-signature"></i> Radicar Solicitudes <i
                                        class="fas fa-caret-right"></i> </a>
                                <ul class="submenu dropdown-menu">
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="solicitudes.Reg.php"><i
                                                class="fas fa-clipboard-list"></i> Mis Solicitudes
                                            Radicadas</a></li>
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="solicitudesCr.php"><i
                                                class="far fa-edit"></i> Crear Documento</a></li>
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="solicitudesAct.php"><i
                                                class="fas fa-sync-alt"></i> Actualizar Documento</a></li>
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="solicitudesEli.php"><i
                                                class="fas fa-times-circle"></i> Eliminar Documento</a></li>

                                </ul>
                            </li>

                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" data-bs-toggle="dropdown"><i
                                class="fas fa-tasks"></i> Tareas</a>
                        <ul class="dropdown-menu" style="background-color: #f8f9fa!important;">
                            <li><a class="dropdown-item" style="color: #0d6efd;" href="#"><i
                                        class="far fa-calendar-alt"></i> Gestión de Tareas <i
                                        class="fas fa-caret-right"></i> </a>
                                <ul class="submenu dropdown-menu">
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="tareasAsig.php"><i
                                                class="fas fa-clipboard-list"></i> Tareas Iniciadas</a></li>
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="tareasDes.php"><i
                                                class="far fa-edit"></i> Tareas En Desarrollo</a></li>
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="#"><i class="fas fa-undo"></i> Tareas Devueltas</a></li>
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="#"><i
                                                class="fas fa-times-circle"></i> Tareas Finalizadas</a></li>
                                </ul>
                            </li>
                            <li><a class="dropdown-item" style="color: #0d6efd;" href="#"><i
                                        class="fas fa-file-signature"></i> Tareas <i class="fas fa-caret-right"></i>
                                </a>
                                <ul class="submenu dropdown-menu">
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="tareas.php"><i
                                                class="fas fa-clipboard-list"></i> Solicitudes Asignadas</a></li>
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="#"><i
                                                class="far fa-edit"></i> Tareas En Desarrollo <i class="fas fa-caret-right"></i></a>
                                        <ul class="submenu dropdown-menu">
                                            <li><a class="dropdown-item" style="color: #0d6efd;" href="tareasDesa.php"><i class="far fa-clipboard"></i> Elaboración</a></li>
                                            <li><a class="dropdown-item" style="color: #0d6efd;" href="tareasRevi.php"><i class="fas fa-check"></i> Revisión</a></li>
                                            <li><a class="dropdown-item" style="color: #0d6efd;" href="#"><i class="fas fa-check-double"></i>Aprobación</a></li>
                                        </ul>
                                    </li>
                                    <li><a class="dropdown-item" style="color: #0d6efd;" href="#"><i
                                                class="fas fa-times-circle"></i> Tareas Finalizadas</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="" class="nav-link dropdown-toggle p-2" id="navbarDropdownMenuLink" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-users"></i>
                            Usuarios </a>
                        <ul class="dropdown-menu bg-light" aria-labelledby="navbarDropdownMenuLink">
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2 dropdown-item" href="usuarios.php"><i class="fas fa-users"></i>
                                    Gestión de Usuarios</a>
                            </li>
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2 dropdown-item" href="cargo.php"><i class="fas fa-user-plus"></i>
                                    Gestión de Cargos</a>
                            </li>
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2 dropdown-item" href="rol.php"><i class="fas fa-user-tag"></i>
                                    Gestión de Roles</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="perfil.php" class="nav-link dropdown-toggle p-2" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"><img href="perfil.php"
                                src="../documentos/usuarios/<?php $usuario= $_SESSION['usuario']; echo $usuario;?>/imagen/<?php $img_empleado= $_SESSION['img_empleado']; echo $img_empleado; ?>"
                                alt="mdo" width="32" height="32" class="rounded-circle">
                            <?php $usuario= $_SESSION['usuario']; echo $usuario;?>
                        </a>
                        <ul class="dropdown-menu bg-light" aria-labelledby="navbarDropdownMenuLink">
                            <li><a class="dropdown-item" href="perfil.php" style="color: #0A58CD;"><i
                                        class="fas fa-user-alt"></i> Mi Perfil</a></li>

                        </ul>
                    </li>
                </ul>
            </div>
            <form class="d-flex">
                <a class="btn" id="btnCerrar" style="color: #0A58CD;"><i class="fas fa-sign-out-alt"
                        style="color: #0A58CD;"></i> Cerrar Sesión</a>
                <script src="../js/Login/logueo.js"></script>
            </form>
        </div>
    </nav>
</header>

<!-- --Fin Menu -->