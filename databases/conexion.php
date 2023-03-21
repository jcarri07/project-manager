<?php

// Datos de la base de datos
$host = "localhost"; // servidor
$user = "root"; // nombre de usuario
$pass = ""; // contraseña
$dbname = "project-manager"; // nombre de la base de datos

// Crear conexión
$conn = mysqli_connect($host, $user, $pass, $dbname);

// Verificar si hay errores en la conexión
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

// Si la conexión es exitosa, muestra un mensaje por consola
// echo "Conexión exitosa a la base de datos project-manager";

// Cerrar conexión
function closeConection($conn) {
    mysqli_close($conn);
}

?>
