<?php
include 'conexion.php';

// Verificar si se proporciona un ID de usuario válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $bookId = $_GET['id'];

    // Aquí coloca la lógica para eliminar el usuario con el ID proporcionado
    $delete_sql = "DELETE FROM libros WHERE id_libro = '$bookId'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>
                alert('Libro eliminado Exitosamente');
                window.location.href = '?section=libros';
              </script>";
    } else {
        echo "<script>
                alert('Error al eliminar el libro: " . $conn->error . "');
              </script>";
    }
} else {
    echo 'Solicitud no válida para eliminar libros';
}

// Si no se proporciona un ID válido, redirigir a algún lugar apropiado
header("Location: ?section=libros");
exit();
?>
