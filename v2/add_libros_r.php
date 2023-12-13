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
// Conexión a la base de datos (reemplaza con tus detalles de conexión)
include "conexion.php";

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

if (isset($_SESSION['id_usuario'])) {
    // Lógica para añadir usuario si se envió el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_book"])) {
    $titulo = $_POST["titulo"];
    $titulo_unique = $_POST["titulo"];
    $autor = $_POST["autor"];
    $num_ejemplar = $_POST["num_ejemplar"];
    $bibliotecario =$_SESSION['id_usuario'];

    //sintaxis para convertir el titulo en minusculas
    $titulo_unique_min = strtolower($titulo_unique);
    $titulo_unique_min_spaceless = str_replace(' ', '-', $titulo_unique_min);

    // Insertar nuevo libro en la base de datos
    try {
        $sql = "INSERT INTO libros (titulo, titulo_unique, autor, numero_ejemplar,bibliotecario_id) VALUES ('$titulo', '$titulo_unique_min_spaceless' , '$autor', '$num_ejemplar', '$bibliotecario')";
        if ($conn->query($sql) === TRUE) {
            echo "<script>
                alert('Libro añadido Exitosamente');
                setTimeout(function() {
                    window.location.href = '?section=libros';
                }, 2000); // Espera 2 segundos antes de redirigir
              </script>";
        } else {
            throw new Exception($conn->error);
        }
    } catch (Exception $e) {
        // Manejar la excepción, puedes imprimir el mensaje de error o realizar otra acción
        echo "<script>
                alert('El Libro ya fue registrado y existe en la base de datos ');
              </script>";
    }
}

// Cerrar la conexión
$conn->close();
//ob_clean(); // Limpiar el búfer de salida
} else {
    echo "Solicitud prohibida";
}

?>

<div class="container mt-5">
    <h2>Añadir Libro</h2>

    <!-- Formulario para añadir usuario -->
    <form action="" method="post">
        <div class="form-group">
            <label for="titulo">Titulo:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="apellido">Autor:</label>
            <input type="text" class="form-control" id="autor" name="autor" required>
        </div>
        <div class="form-group">
            <label for="correo">Numero de ejemplares:</label>
            <input type="number" class="form-control" id="num_emeplar" name="num_ejemplar" required>
        </div>
        <button type="submit" class="btn btn-primary" name="add_book">Añadir Libro</button>
    </form>
</div>
