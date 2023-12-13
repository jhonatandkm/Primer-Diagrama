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

<?php
include "conexion.php";

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $search = $_POST["search"];
    $sql = "SELECT * FROM usuarios WHERE nombre LIKE '%$search%' OR apellido LIKE '%$search%' OR email LIKE '%$search%' ORDER BY id_usuario DESC";
} else {
    $sql = "SELECT * FROM usuarios ORDER BY id_usuario DESC";
}

$result = $conn->query($sql);
?>

<div class="container mt-5">
    <?php
    if (isset($_GET['section']) && $_GET['section'] === 'usuarios' && isset($_GET['action']) && $_GET['action'] === 'add') {
        include 'add_usuarios.php';
    } elseif(isset($_GET['section']) && $_GET['section'] === 'usuarios' && isset($_GET['action']) && $_GET['action'] === 'edit') {
        include 'edit_usuarios.php';
    } else {
    ?>
        <h2>Usuarios</h2>

        <form action="?section=usuarios" method="post" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar usuario" name="search">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
            </div>
        </form>

        <a href="?section=usuarios&action=add" class="btn btn-primary mb-3">Agregar Usuario</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Apellido</th>
                    <th>Correo</th>
                    <th>Dirección</th>
                    <th>Bloqueo</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";

                        if($row["estado_bloqueo"]=="si"){
                            echo "<tr style='color:red;'>";
                        }
                        echo "<td>" . $row["id_usuario"] . "</td>";
                        echo "<td>" . $row["nombre"] . "</td>";
                        echo "<td>" . $row["apellido"] . "</td>";
                        echo "<td>" . $row["email"] . "</td>";
                        echo "<td>" . $row["direccion"] . "</td>";
                        echo "<td>" . $row["estado_bloqueo"] . "</td>";
                        echo "<td>";
                        // echo "<a href='?section=usuarios&action=add_adeudo&id=" . $row["id_usuarios"] . "' class='btn btn-success btn-sm'>Añadir Adeudo</a> ";
                        echo "<a href='?section=usuarios&action=edit&id=" . $row["id_usuario"] . "' class='btn btn-primary btn-sm'>Editar</a> ";

                        if($row["estado_bloqueo"]=="si"){
                            echo "<a href='#' onclick='confirmUnblock(" . $row["id_usuario"] . ", \"" . $row["nombre"] . "\")' class='btn btn-success btn-sm'>Desbloquear</a>";
                            echo "<script>
                                function confirmUnblock(userId, userName) {
                                    var confirmUnblock = confirm('¿Estás seguro de que quieres desbloquear al usuario ' + userName + '?');
                                    if (confirmUnblock) {
                                        window.location.href = '?section=usuarios&action=unblock&id=' + userId;
                                    }
                                }
                            </script>";
                        }else{
                            echo "<a href='#' onclick='confirmBlock(" . $row["id_usuario"] . ", \"" . $row["nombre"] . "\")' class='btn btn-danger btn-sm'>Bloquear</a>";
                            echo "<script>
                                function confirmBlock(userId, userName) {
                                    var confirmBlock = confirm('¿Estás seguro de que quieres bloquear al usuario ' + userName + '?');
                                    if (confirmBlock) {
                                        window.location.href = '?section=usuarios&action=block&id=' + userId;
                                    }
                                }
                            </script>";
                        }
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No se encontraron usuarios.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    <?php } ?>
</div>

<?php
if (isset($_GET['section'])) {
    $section = $_GET['section'];

    switch ($section) {
        case 'usuarios':
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                switch ($action) {
                    case 'add':
                        break;
                    case 'block':
                        include 'block_usuarios.php';
                        break;
                    case 'edit':
                        
                        break;
                    case 'unblock':
                        include 'unblock_usuarios.php';
                        break;
                    default:
                        echo 'Acción no válida para Usuarios';
                }
            }
        break;
        case 'solicitudes':
            include 'solicitudes.php';
            break;
        default:
            echo 'Selecciona una sección';
    }
}
?>

<?php
//$conn->close();
?>
