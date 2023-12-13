<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["update_book"])) {
    $bookId = $_POST["book_id"];
    $newTitle = $_POST["new_title"];

    $titulo_unique_min = strtolower($newTitle);
    $NewTituloUniqueMinSpaceless = str_replace(' ', '-', $titulo_unique_min);

    $newAutor = $_POST["new_autor"];
    $newNumEjemplar = $_POST["new_num_ejemplar"];

    try{
        $update_sql = "UPDATE libros SET titulo='$newTitle', titulo_unique= '$NewTituloUniqueMinSpaceless', autor='$newAutor', numero_ejemplar='$newNumEjemplar' WHERE id_libro='$bookId'";
        if ($conn->query($update_sql) === TRUE) {
            echo "<script>
                    alert('Libro actualizado exitosamente');
                    window.location.href = '?section=libros';
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

// Obtener información del usuario a editar
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $bookId = $_GET['id'];
    $select_sql = "SELECT * FROM libros WHERE id_libro='$bookId'";
    $result = $conn->query($select_sql);

    if ($result->num_rows == 1) {
        $book = $result->fetch_assoc();
    } else {
        echo 'Libro no encontrado';
    }
} else {
    echo 'Solicitud no válida para editar libros';
    echo "<script>window.location.href = '?section=libros';</script>";
}
?>

<!-- Formulario para editar usuario -->
<div class="container mt-5">
    <h2>Editar Libro</h2>

    <form action="?section=libros&action=edit" method="post">
        <input type="hidden" name="book_id" value="<?php echo $book['id_libro']; ?>">
        <div class="form-group">
            <label for="new_title">Nuevo Titulo</label>
            <input type="text" class="form-control" id="new_title" name="new_title" value="<?php echo $book['titulo']; ?>" required>
        </div>
        <div class="form-group">
            <label for="new_autor">Nuevo Autor:</label>
            <input type="text" class="form-control" id="new_autor" name="new_autor" value="<?php echo $book['autor']; ?>" required>
        </div>
        <div class="form-group">
            <label for="new_num_ejemplar">Numero de Ejemplares</label>
            <input type="number" class="form-control" id="new_num_ejemplar" name="new_num_ejemplar" value="<?php echo $book['numero_ejemplar']; ?>" required>
        </div>
        <button type="submit" class="btn btn-primary" name="update_book">Actualizar Libro</button>
    </form>
</div>
