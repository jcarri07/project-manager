<?php

require_once __DIR__ . '/../../databases/conexion.php';

header('Content-Type: application/json; charset=utf-8');

$idProyecto = isset($_GET['id_proyecto'])
    ? (int) $_GET['id_proyecto']
    : 0;

if ($idProyecto <= 0) {
    http_response_code(400);

    echo json_encode([
        'error' => 'ID de proyecto inválido.'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

$sql = "SELECT id_usuario, nombre_user, apellido_user, especialidad FROM users_projects, users WHERE users_projects.id_autor_user = users.id_usuario AND users_projects.id_projects=?";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    error_log('Error SQL al preparar consulta: ' . mysqli_error($conn));

    http_response_code(500);

    echo json_encode([
        'error' => 'No se pudo preparar la consulta de coautores.'
    ], JSON_UNESCAPED_UNICODE);

    exit;
}

mysqli_stmt_bind_param($stmt, 'i', $idProyecto);

if (!mysqli_stmt_execute($stmt)) {
    error_log('Error SQL al ejecutar consulta: ' . mysqli_stmt_error($stmt));

    http_response_code(500);

    echo json_encode([
        'error' => 'No se pudieron consultar los coautores.'
    ], JSON_UNESCAPED_UNICODE);

    mysqli_stmt_close($stmt);
    exit;
}

$resultado = mysqli_stmt_get_result($stmt);

$coautores = [];

while ($fila = mysqli_fetch_assoc($resultado)) {
    $coautores[] = $fila;
}

echo json_encode($coautores, JSON_UNESCAPED_UNICODE);

mysqli_stmt_close($stmt);
