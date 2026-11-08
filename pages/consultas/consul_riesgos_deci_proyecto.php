<?php

header('Content-Type: application/json; charset=utf-8');

require_once('../../databases/conexion.php');

// Recibir ID del proyecto seleccionado
$id_proyecto = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id_proyecto || $id_proyecto <= 0) {
    echo json_encode([
        'success' => false,
        'message' => 'ID de proyecto inválido.'
    ]);
    exit;
}

$sql = "SELECT risk.id_risk, risk.riesgo, risk.probabilidad, risk.impacto, risk.acciones FROM risk INNER JOIN projects_risk ON projects_risk.id_risk = risk.id_risk WHERE projects_risk.id_proyecto = ?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        'success' => false,
        'message' => 'Error al preparar la consulta.'
    ]);
    exit;
}

mysqli_stmt_bind_param($stmt, "i", $id_proyecto);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$riesgos = [];

while ($fila = mysqli_fetch_assoc($resultado)) {
    $riesgos[] = $fila;
}

echo json_encode([
    'success' => true,
    'data' => $riesgos
]);

mysqli_stmt_close($stmt);
