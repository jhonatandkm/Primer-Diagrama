<?php
include "conexion.php";

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["search"])) {
    $search = $_POST["search"];
    $sql = "SELECT * FROM libros WHERE titulo LIKE '%$search%' OR autor LIKE '%$search%' ORDER BY id_libro DESC";
} else {
    $sql = "SELECT * FROM libros ORDER BY id_libro DESC";
}

$result = $conn->query($sql);
?>

<div class="container mt-5">
    <?php
    if (isset($_GET['section']) && $_GET['section'] === 'libros' && isset($_GET['action']) && $_GET['action'] === 'add') {
        include 'add_libros_r.php';
    } elseif(isset($_GET['section']) && $_GET['section'] === 'libros' && isset($_GET['action']) && $_GET['action'] === 'edit') {
        include 'edit_libros.php';
    } else {
    ?>
        <h2>Libros</h2>

        <form action="?section=libros" method="post" class="mb-3">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Buscar libro" name="search">
                <div class="input-group-append">
                    <button class="btn btn-outline-secondary" type="submit">Buscar</button>
                </div>
            </div>
        </form>

        <a href="?section=libros&action=add" class="btn btn-primary mb-3">Agregar Libro</a>

        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Titulo</th>
                    <th>Autor</th>
                    <th>Número de Ejemplares</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id_libro"] . "</td>";
                        echo "<td>" . $row["titulo"] . "</td>";
                        echo "<td>" . $row["autor"] . "</td>";
                        echo "<td>" . $row["numero_ejemplar"] . "</td>";
                        echo "<td>";
                        // echo "<a href='?section=libros&action=add_adeudo&id=" . $row["id_usuarios"] . "' class='btn btn-success btn-sm'>Añadir Adeudo</a> ";
                        echo "<a href='?section=libros&action=edit&id=" . $row["id_libro"] . "' class='btn btn-primary btn-sm'>Editar</a> ";
                        echo "<a href='#' onclick='confirmDelete(" . $row["id_libro"] . ", \"" . $row["titulo"] . "\")' class='btn btn-danger btn-sm'>Eliminar</a>";
                        echo "<script>
                                function confirmDelete(userId, userName) {
                                    var confirmDelete = confirm('¿Estás seguro de que quieres eliminar el libro ' + userName + '?');
                                    if (confirmDelete) {
                                        window.location.href = '?section=libros&action=delete&id=' + userId;
                                    }
                                }
                            </script>";
                        echo "</td>";
                        echo "</tr>";
                    }
                } else {
                    echo "<tr><td colspan='6'>No se encontraron Libros.</td></tr>";
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
        case 'libros':
            if (isset($_GET['action'])) {
                $action = $_GET['action'];
                switch ($action) {
                    case 'add':
                        break;
                    case 'delete':
                        include 'delete_libros.php';
                        break;
                    case 'edit':
                        
                        break;
                    default:
                        echo '  ';
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
