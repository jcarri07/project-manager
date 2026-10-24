<?php

require_once __DIR__ . '/../../databases/conexion.php';

header('Content-Type: application/json; charset=utf-8');

$idExcluir = isset($_GET['id_excluir'])
    ? (int) $_GET['id_excluir']
    : 0;

$idProyecto = isset($_GET['id_proyecto'])
    ? (int) $_GET['id_proyecto']
    : 0;


$sql = " SELECT u.id_usuario,u.nombre_user,u.apellido_user,u.especialidad FROM users AS u WHERE u.id_user_type = 2 AND u.id_usuario != ? AND NOT EXISTS ( SELECT 1 FROM users_projects AS up WHERE up.id_projects = ? AND up.id_autor_user = u.id_usuario) ORDER BY u.nombre_user ASC";

$stmt = mysqli_prepare($conn, $sql);

if (!$stmt) {
    http_response_code(500);
    echo json_encode([
        'error' => 'Error al preparar la consulta.'
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

mysqli_stmt_bind_param(
    $stmt,
    "ii",
    $idExcluir,
    $idProyecto
);

mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$usuarios = [];

while ($usuario = mysqli_fetch_assoc($resultado)) {
    $usuarios[] = $usuario;
}

echo json_encode($usuarios, JSON_UNESCAPED_UNICODE);

mysqli_stmt_close($stmt);
