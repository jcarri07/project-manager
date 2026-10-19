<?php
require_once('../../databases/conexion.php');

header('Content-Type: application/json; charset=utf-8');

$idExcluir = isset($_GET['id_excluir'])
    ? (int) $_GET['id_excluir']
    : 0;

$sql = "SELECT id_usuario, nombre_user, apellido_user, especialidad FROM users WHERE users.id_user_type !='3' AND id_usuario != ? ORDER BY nombre_user ASC";

$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "i", $idExcluir);
mysqli_stmt_execute($stmt);

$resultado = mysqli_stmt_get_result($stmt);

$usuarios = [];

while ($usuario = mysqli_fetch_assoc($resultado)) {
    $usuarios[] = $usuario;
}

echo json_encode($usuarios, JSON_UNESCAPED_UNICODE);

mysqli_stmt_close($stmt);
