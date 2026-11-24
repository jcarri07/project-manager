<?php

session_start();

header('Content-Type: application/json; charset=utf-8');

include_once __DIR__ . ('/../../databases/conexion.php');

$idProyecto = filter_input(
    INPUT_GET,
    'id_proyecto',
    FILTER_VALIDATE_INT
);

if (!$idProyecto || $idProyecto <= 0) {

    http_response_code(400);

    echo json_encode([
        'success' => false,
        'message' => 'Identificador de planificación inválido.'
    ]);

    exit;
}

$sql = "SELECT * FROM risk, projects_risk WHERE risk.id_risk = projects_risk.id_risk AND projects_risk.id_proyecto = ?";


$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {

    http_response_code(500);

    echo json_encode([
        'success' => false,
        'message' => 'Error al preparar la consulta.'
    ]);

    exit;
}


mysqli_stmt_bind_param($stmt, "i", $idProyecto);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$riesgos_plan = [];

while ($fila = mysqli_fetch_assoc($resultado)) {

    $riesgos_plan[] = $fila;
}


mysqli_stmt_close($stmt);

echo json_encode([
    'success' => true,
    'data' => $riesgos_plan
], JSON_UNESCAPED_UNICODE);

exit;
