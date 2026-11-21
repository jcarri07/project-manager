<?php

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

header('Content-Type: application/json; charset=utf-8');

include_once __DIR__ . '/../../databases/conexion.php';

$idPlan = filter_input(
    INPUT_GET,
    'id_project_plans',
    FILTER_VALIDATE_INT
);

$idProyecto = filter_input(
    INPUT_GET,
    'id_proyecto',
    FILTER_VALIDATE_INT
);

if (!$idPlan || $idPlan <= 0 || !$idProyecto || $idProyecto <= 0) {

    http_response_code(400);

    echo json_encode([
        'success' => false,
        'message' => 'Identificador de planificación o proyecto inválido.'
    ]);

    exit;
}

$sql = "SELECT * FROM project_plan_budgets WHERE id_project_plans = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Error al preparar la consulta de presupuestos.'
    ]);

    exit;
}

mysqli_stmt_bind_param($stmt, "i", $idPlan);

if (!mysqli_stmt_execute($stmt)) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Error al consultar los presupuestos.'
    ]);

    mysqli_stmt_close($stmt);
    exit;
}

$resultado = mysqli_stmt_get_result($stmt);

$presupuesto = [];

while ($fila = mysqli_fetch_assoc($resultado)) {

    $presupuesto[] = $fila;
}

mysqli_stmt_close($stmt);

$sqlTotal = "SELECT presupuesto_est FROM projects WHERE id_proyecto = ? LIMIT 1";

$stmtTotal = mysqli_prepare($conn, $sqlTotal);

if (!$stmtTotal) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Error al preparar la consulta del presupuesto total.'
    ]);

    exit;
}

mysqli_stmt_bind_param($stmtTotal, "i", $idProyecto);

if (!mysqli_stmt_execute($stmtTotal)) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Error al consultar el presupuesto total.'
    ]);

    mysqli_stmt_close($stmtTotal);
    exit;
}

$resultadoTotal = mysqli_stmt_get_result($stmtTotal);

$filaTotal = mysqli_fetch_assoc($resultadoTotal);

if (!$filaTotal) {

    http_response_code(404);

    echo json_encode([
        'success' => false,
        'message' => 'No se encontró el proyecto seleccionado.'
    ]);

    mysqli_stmt_close($stmtTotal);
    exit;
}

$presupuestoEst = $filaTotal['presupuesto_est'] !== null
    ? (float) $filaTotal['presupuesto_est']
    : null;

mysqli_stmt_close($stmtTotal);

echo json_encode([
    'success' => true,
    'data' => $presupuesto,
    'presupuesto_est' => $presupuestoEst
], JSON_UNESCAPED_UNICODE);

exit;
