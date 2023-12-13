<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_user"])) {
    $userId = $_POST["user_id"];
    $newName = $_POST["new_name"];
    $newLastName = $_POST["new_last_name"];
    $newEmail = $_POST["new_email"];
    $newAddress = $_POST["new_address"];


    try{
        $update_sql = "UPDATE usuarios SET nombre='$newName', apellido='$newLastName', correo='$newEmail', direccion='$newAddress' WHERE id_usuarios='$userId'";
        if ($conn->query($update_sql) === TRUE) {
            echo "<script>
                    alert('Usuario actualizado exitosamente');
                    window.location.href = '?section=usuarios';
                  </script>";
        } else {
            throw new Exception($conn->error);
        }
    } catch (Exception $e) {
        // Manejar la excepción, puedes imprimir el mensaje de error o realizar otra acción
        echo "<script>
                alert('El correo ya fue registrado y existe en la base de datos ');
              </script>";
    }
}

// Obtener información del usuario a editar
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $userId = $_GET['id'];
    $select_sql = "SELECT * FROM usuarios WHERE id_usuarios='$userId'";
    $result = $conn->query($select_sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
    } else {
        echo 'Usuario no encontrado';
    }
} else {
    echo 'Solicitud no válida para editar usuarios';
    echo "<script>window.location.href = '?section=usuarios';</script>";
}
?>

<!-- Formulario para editar usuario -->
<div class="container mt-5">
    <h2>Editar Usuario</h2>

    <form action="?section=usuarios&action=edit" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user['id_usuarios']; ?>">
        <div class="form-group">
            <label for="new_name">Nuevo Nombre:</label>
            <input type="text" class="form-control" id="new_name" name="new_name" value="<?php echo $user['nombre']; ?>" required>
        </div>
        <div class="form-group">
            <label for="new_last_name">Nuevo Apellido:</label>
            <input type="text" class="form-control" id="new_last_name" name="new_last_name" value="<?php echo $user['apellido']; ?>" required>
        </div>
        <div class="form-group">
            <label for="new_email">Nuevo Correo:</label>
            <input type="email" class="form-control" id="new_email" name="new_email" value="<?php echo $user['correo']; ?>" required>
        </div>
        <div class="form-group">
            <label for="new_address">Nueva Dirección:</label>
            <input type="text" class="form-control" id="new_address" name="new_address" value="<?php echo $user['direccion']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="update_user">Actualizar Usuario</button>
    </form>
</div>
