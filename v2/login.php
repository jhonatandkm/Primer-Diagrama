<?php


include 'conexion.php';

// Obtener datos del formulario
$email = $_POST['email'];
$password = $_POST['password'];

// Consultar la base de datos para encontrar al usuario
$query = "SELECT * FROM administrador WHERE email_administrador='$email' AND contrasenia_administrador='$password'";
$result = $conn->query($query);

if ($result->num_rows == 1) {
    // Iniciar sesión para el administrador
    $usuario = $result->fetch_assoc();
    session_start();
    $_SESSION['usuario'] = 'administrador';
    $_SESSION['id_usuario'] = $usuario['id_administrador']; // Asegúrate de tener una columna 'id_administrador' en tu tabla administrador
    $_SESSION['nombre_usuario'] = $usuario['nombre'];
    header("Location: crud_admin.php");
} else {
    // Verificar si es un bibliotecario
    $query = "SELECT * FROM bibliotecarios WHERE email_bibliotecario='$email' AND contrasenia_bibliotecario='$password'";
    $result = $conn->query($query);

    if ($result->num_rows == 1) {
        session_start();
        // Iniciar sesión para el bibliotecario
        $usuario = $result->fetch_assoc();
        $_SESSION['usuario'] = 'bibliotecario';
        $_SESSION['id_usuario'] = $usuario['id_bibliotecario']; // Asegúrate de tener una columna 'id_bibliotecario' en tu tabla bibliotecarios
        $_SESSION['nombre_usuario'] = $usuario['nombre'];
        header("Location: index.php");
        exit();
    } else {
        // Usuario no válido
        echo "<script>
                alert('Usuario y/o Contraseña Incorrectos');
                setTimeout(function() {
                    window.location.href = 'login.html';
                }, 500); // Espera 2 segundos antes de redirigir
              </script>";
    }
}

// $conn->close();
?>
