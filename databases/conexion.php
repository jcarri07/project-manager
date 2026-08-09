<?php
require_once __DIR__ . '/../config.php';

$host = $_ENV['DB_HOST'];
$user = $_ENV['DB_USER'];
$pass = $_ENV['DB_PASS'];
$dbname = $_ENV['DB_NAME'];

// Crear conexión
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Verificar si hay errores en la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Si la conexión es exitosa, muestra un mensaje por consola
// echo "Conexión exitosa a la base de datos project-manager";

// Cerrar conexión
function closeConection($conn)
{
    mysqli_close($conn);
}
