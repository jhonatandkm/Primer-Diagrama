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
include 'conexion.php';

// Verificar si se proporciona un ID de usuario válido
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];
    $estado = 'no';

    // Aquí coloca la lógica para eliminar el usuario con el ID proporcionado
    try{
        $update_sql = "UPDATE usuarios SET estado_bloqueo='$estado' WHERE id_usuario='$userId'";
        if ($conn->query($update_sql) === TRUE) {
            echo "<script>
                    alert('Usuario desbloqueado del sistema');
                    window.location.href = '?section=usuarios';
                  </script>";
        } else {
            throw new Exception($conn->error);
        }
    } catch (Exception $e) {
        // Manejar la excepción, puedes imprimir el mensaje de error o realizar otra acción
        echo "<script>
                alert('Server internal error ');
              </script>";
    }
} else {
    echo 'Solicitud no válida para eliminar usuarios';
}

// Si no se proporciona un ID válido, redirigir a algún lugar apropiado
header("Location: ?section=usuarios");
exit();
?>
