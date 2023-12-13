<?php
include 'conexion.php';

// Verificar si se proporciona un ID de usuario válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];

    // Aquí coloca la lógica para eliminar el usuario con el ID proporcionado
    $delete_sql = "DELETE FROM usuarios WHERE id_usuarios = '$userId'";
    if ($conn->query($delete_sql) === TRUE) {
        echo "<script>
                alert('Usuario eliminado Exitosamente');
                window.location.href = '?section=usuarios';
              </script>";
    } else {
        echo "<script>
                alert('Error al eliminar usuario: " . $conn->error . "');
              </script>";
    }
} else {
    echo 'Solicitud no válida para eliminar usuarios';
}

// Si no se proporciona un ID válido, redirigir a algún lugar apropiado
header("Location: ?section=usuarios");
exit();
?>
