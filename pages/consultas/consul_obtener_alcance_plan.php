<?php

session_start();

header('Content-Type: application/json; charset=utf-8');

include_once __DIR__ . '/../../databases/conexion_crud.php';

// ==========================================
// VALIDAR SESIÓN
// ==========================================

if (!isset($_SESSION['id_usuario'])) {

    http_response_code(401);

    echo json_encode([
        'success' => false,
        'message' => 'Sesión no válida.'
    ]);

    exit;
}


// ==========================================
// RECIBIR ID DE LA PLANIFICACIÓN
// ==========================================

$idPlan = filter_input(INPUT_GET, 'id_project_plans', FILTER_VALIDATE_INT);

if (!$idPlan || $idPlan <= 0) {

    http_response_code(400);

    echo json_encode([
        'success' => false,
        'message' => 'Identificador de planificación inválido.'
    ]);

    exit;
}


// ==========================================
// CONSULTAR INFORMACIÓN DEL ALCANCE
// ==========================================

$sql = "SELECT * FROM project_plans WHERE id_project_plans = ? LIMIT 1";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Error al preparar la consulta.'
    ]);

    exit;
}


mysqli_stmt_bind_param($stmt, "i", $idPlan);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$plan = mysqli_fetch_assoc($resultado);

mysqli_stmt_close($stmt);

if (!$plan) {

    echo json_encode([
        'success' => false,
        'message' => 'No se encontró la planificación seleccionada.'
    ]);

    exit;
}

echo json_encode([
    'success' => true,
    'data' => $plan
], JSON_UNESCAPED_UNICODE);

exit;
