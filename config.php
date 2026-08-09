<?php
function loadEnv($path)
{
    if (!file_exists($path)) {
        die('.env no encontrado');
    }
    $lines = file($path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        // Ignorar comentarios
        if (str_starts_with(trim($line), '#')) {
            continue;
        }
        // Separar clave y valor
        [$name, $value] = explode('=', $line, 2);
        $name = trim($name);
        $value = trim($value);
        $_ENV[$name] = $value;
    }
}
// Cargar el .env desde la raíz del proyecto
loadEnv(__DIR__ . '/.env');
