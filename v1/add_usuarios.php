<?php
// Conexión a la base de datos (reemplaza con tus detalles de conexión)
include "conexion.php";

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Lógica para añadir usuario si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_user"])) {
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $correo = $_POST["correo"];
    $direccion = $_POST["direccion"];

    // Insertar nuevo usuario en la base de datos
    try {
        $sql = "INSERT INTO usuarios (nombre, apellido, correo, direccion) VALUES ('$nombre', '$apellido', '$correo', '$direccion')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert('Usuario añadido Exitosamente');
                setTimeout(function() {
                    window.location.href = '?section=usuarios';
                }, 2000); // Espera 2 segundos antes de redirigir
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

// Cerrar la conexión
$conn->close();
//ob_clean(); // Limpiar el búfer de salida
?>

<div class="container mt-5">
    <h2>Añadir Usuario</h2>

    <!-- Formulario para añadir usuario -->
    <form action="" method="post">
        <div class="form-group">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" name="nombre" required>
        </div>
        <div class="form-group">
            <label for="apellido">Apellido:</label>
            <input type="text" class="form-control" id="apellido" name="apellido" required>
        </div>
        <div class="form-group">
            <label for="correo">Correo:</label>
            <input type="email" class="form-control" id="correo" name="correo" required>
        </div>
        <div class="form-group">
            <label for="direccion">Dirección:</label>
            <input type="text" class="form-control" id="direccion" name="direccion" required>
        </div>
        <button type="submit" class="btn btn-primary" name="add_user">Añadir Usuario</button>
    </form>
</div>




