<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Verificar si el ID de usuario está en la sesión
if (!isset($_SESSION['nombre_usuario'])) {
    header("Location: login.html");
    exit(); 
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca</title>
    <!-- Incluir Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
    .custom-alert {
        padding: 10px;
        border: 1px solid #4CAF50;
        background-color: #DFF2BF;
        color: #4CAF50;
        border-radius: 5px;
        margin-bottom: 15px;
    }
</style>
</head>
<body>
<!-- ... resto del código ... -->

<body>



<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
    <h1 class="mt-4">Buenos días
    <?php
    // Verificar si el ID de usuario está en la sesión
    if (isset($_SESSION['nombre_usuario'])) {
        echo ' ' . $_SESSION['nombre_usuario'];
    } else {
        header("login.html");
    }
    ?>
    </h1>

<div class="container-fluid">
    <div class="row">
        <nav id="menu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
            <div class="sidebar-sticky">
                <h5 class="mt-3 mb-3">Menú</h5>
                <ul class="nav flex-column">
                    <li class="nav-item">
                        <a class="nav-link" href="?section=usuarios">
                            Usuarios
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?section=solicitudes">
                            Solicitudes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?section=libros">
                            Libros
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="?section=adeudos">
                            Consulta de Adeudos
                        </a>
                    </li>

                    <li class="nav-item">
                        <br><br>
                    <a href="logout.php" class="btn btn-primary mb-3">Cerrar Sesión</a>
                    </li>

                </ul>
            </div>
        </nav>

        <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
        <div id="content">
    <?php
    // Manejar las secciones
    if (isset($_GET['section'])) {
        $section = $_GET['section'];

        switch ($section) {
            case 'usuarios':
                include 'usuarios.php'; // Archivo que contiene la lógica de usuarios
                break;
            case 'libros':
                include 'libros.php'; // Archivo que contiene la lógica de solicitudes
                break;
            // Agrega más casos para otras secciones
            default:
                echo 'Selecciona una sección';
        }
    }
    ?>
</div>
        </main>
    </div>
</div>

<!-- Incluir Bootstrap y jQuery (necesario para algunas funcionalidades de Bootstrap) -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</main>
</body>
</html>
