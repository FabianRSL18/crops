<?php require_once('views/header.php') ?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">Administrador</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <!-- Dropdown for catalog -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Catálogo
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="invernadero.php">Invernaderos</a></li>
                        <li><a class="dropdown-item" href="seccion.php">Secciones</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Usuarios
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="usuario.php">Usuario</a></li>
                        <li><a class="dropdown-item" href="roles.php">Roles</a></li>
                        <li><a class="dropdown-item" href="permisos.php">Permisos</a></li>
                        <li><a class="dropdown-item" href="empleado.php">Empleados</a></li>
                    </ul>
                </li>
                <!-- Other links -->
                <li class="nav-item">
                    <a class="nav-link" href="login.php?accion=logout" aria-disabled="true">Salir</a>
                </li>
            </ul>
        </div>
    </div>
</nav>