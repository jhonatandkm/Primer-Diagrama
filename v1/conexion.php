<?php

// Datos de conexión a la base de datos
$servername = "localhost";
$username = "dkm";
$password = "dkmrpg";
$database = "biblioteca"; // Nombre de tu base de datos

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

// Configurar el juego de caracteres a UTF-8
// $conn->set_charset("utf8");

// // Puedes usar $conn para realizar consultas a la base de datos

// // Ejemplo de consulta
// $query = "SELECT * FROM usuarios";
// $result = $conn->query($query);

// // Comprobar si la consulta fue exitosa
// if ($result) {
//     while ($row = $result->fetch_assoc()) {
//         // Procesar los resultados
//         echo "ID: " . $row["id_usuarios"] . ", Nombre: " . $row["nombre"] . ", Apellido: " . $row["apellido"] . "<br>";
//     }
// } else {
//     echo "Error en la consulta: " . $conn->error;
// }


?>
