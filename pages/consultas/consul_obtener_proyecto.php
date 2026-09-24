<?php

include_once __DIR__ . ('/../../databases/conexion.php');

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'No se recibió el ID del proyecto.'
    ]);
    exit;
}

$id = (int) $_GET['id'];

$sql = "SELECT * FROM projects WHERE id = $id LIMIT 1";

$resultado = mysqli_query($conn, $sql);

if (!$resultado) {
    echo json_encode([
        'success' => false,
        'message' => 'Error en la consulta: ' . mysqli_error($conn)
    ]);
    exit;
}

if (mysqli_num_rows($resultado) === 0) {
    echo json_encode([
        'success' => false,
        'message' => 'No se encontró el proyecto.'
    ]);
    exit;
}

$proyecto = mysqli_fetch_assoc($resultado);

echo json_encode([
    'success' => true,
    'data' => $proyecto
]);

mysqli_free_result($resultado);
