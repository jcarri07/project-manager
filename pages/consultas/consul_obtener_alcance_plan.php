<?php

include_once __DIR__ . ('/../../databases/conexion.php');

header('Content-Type: application/json; charset=utf-8');

if (!isset($_GET['id']) || trim($_GET['id']) === '') {
    echo json_encode([
        'success' => false,
        'message' => 'No se recibió el ID del plan.'
    ]);
    exit;
}

$id = (int) $_GET['id'];

if ($id <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'ID de plan inválido.'
    ]);
    exit;
}

$sql = "SELECT * FROM project_plans WHERE id_project_plans = ? LIMIT 1";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al preparar la consulta: ' . mysqli_error($conn)
    ]);
    exit;
}

mysqli_stmt_bind_param($stmt, 'i', $id);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

if (!$resultado) {
    echo json_encode([
        'success' => false,
        'message' => 'Error al obtener el resultado: ' . mysqli_error($conn)
    ]);
    exit;
}

if (mysqli_num_rows($resultado) === 0) {
    echo json_encode([
        'success' => false,
        'message' => 'No se encontró el plan de proyecto.'
    ]);
    exit;
}

$proyecto = mysqli_fetch_assoc($resultado);

echo json_encode([
    'success' => true,
    'data'    => $proyecto
]);

mysqli_free_result($resultado);
mysqli_stmt_close($stmt);
