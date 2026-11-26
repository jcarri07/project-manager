<?php

session_start();

header('Content-Type: application/json; charset=utf-8');

include_once __DIR__ . ('/../../databases/conexion.php');


$idPlan = filter_input(
    INPUT_GET,
    'id_project_plans',
    FILTER_VALIDATE_INT
);

if (!$idPlan || $idPlan <= 0) {

    http_response_code(400);

    echo json_encode([
        'success' => false,
        'message' => 'Identificador de planificación inválido.'
    ]);

    exit;
}

$sql = "SELECT * FROM project_plans_assumptions WHERE project_plans_assumptions.id_project_plan = ?";


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

$plan_supuestos = [];

while ($fila = mysqli_fetch_assoc($resultado)) {

    $plan_supuestos[] = $fila;
}


mysqli_stmt_close($stmt);

echo json_encode([
    'success' => true,
    'data' => $plan_supuestos
], JSON_UNESCAPED_UNICODE);

exit;
