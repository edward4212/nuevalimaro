<!-- Inicio Menu -->
<header class="navbar navbar-expand-md">
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
                <span class="navbar-toggler-icon"><i class="far fa-caret-square-down"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <ul class=" navbar-nav flex-row flex-wrap bd-navbar-nav pt-2 py-md-0  ">
                    <li class="nav-item col-6 col-md-auto">
                        <a class="nav-link p-2" aria-current="page" href="inicio.php"><i class="fas fa-home"></i>
                            Inicio</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="perfil.php" class="nav-link dropdown-toggle p-2" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-indent"></i>
                            Indice de Documentos</a>
                        <ul class="dropdown-menu bg-light" aria-labelledby="navbarDropdownMenuLink">
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2 dropdown-item" href="documento.php"><i class="fas fa-book"></i>
                                    Listado Maestro de Documentos</a>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="perfil.php" class="nav-link dropdown-toggle p-2" id="navbarDropdownMenuLink"
                            role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-file"></i>
                            Solicitudes y Tareas</a>
                        <ul class="dropdown-menu bg-light" aria-labelledby="navbarDropdownMenuLink">
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2" href="solicitudes.php"><i class="fas fa-check-double"></i>
                                    Solicitudes</a>
                            </li>
                            <li class="nav-item col-6 col-md-auto">
                                <a class="nav-link p-2" href="tareas.php"><i class="fas fa-list"></i> Tareas</a>
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