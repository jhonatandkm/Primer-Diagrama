<?php
include "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["add_book"])) {
    $titulo = $_POST["titulo"];
    $autor = $_POST["autor"];
    $numero_ejemplar = $_POST["numero_ejemplar"];

    $insert_sql = "INSERT INTO libros (titulo, autor, numero_ejemplar) VALUES ('$titulo','$autor','$numero_ejemplar')";
    
    $stmt = $conn->prepare($insert_sql);

    if ($stmt->execute()) {
        echo "<script>
                alert('Libro añadido exitosamente');
                window.location.href = '?section=libros';
              </script>";
    } else {
        echo "<script>
                alert('Error al añadir libro: " . $stmt->error . "');
              </script>";
    }

    $stmt->close();
}
?>

<!-- Formulario para agregar libro -->
<div class="container mt-5">
    <h2>Añadir Libro</h2>

    <form action="?section=libros&action=add" method="post">
        <div class="form-group">
            <label for="titulo">Título:</label>
            <input type="text" class="form-control" id="titulo" name="titulo" required>
        </div>
        <div class="form-group">
            <label for="autor">Autor:</label>
            <input type="text" class="form-control" id="autor" name="autor" required>
        </div>
        <div class="form-group">
            <label for="numero_ejemplar">Número de Ejemplar:</label>
            <input type="number" class="form-control" id="numero_ejemplar" name="numero_ejemplar" required>
        </div>
        <button type="submit" class="btn btn-primary" name="add_book">Añadir Libro</button>
    </form>
</div>
